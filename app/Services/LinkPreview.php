<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LinkPreview
{
    protected const UA = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120 Safari/537.36';

    /** @return array{title:?string,description:?string,image:?string} */
    public static function fetch(string $url): array
    {
        $out = ['title' => null, 'description' => null, 'image' => null];

        $p = parse_url($url);
        if (empty($p['host']) || !in_array($p['scheme'] ?? '', ['http', 'https'], true)) return $out;

        // don't let the server be pointed at internal addresses
        if (!filter_var(gethostbyname($p['host']), FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) return $out;

        try {
            $res = Http::timeout(8)->withHeaders(['User-Agent' => self::UA, 'Accept-Language' => 'en'])->get($url);
        } catch (\Throwable $e) {
            return $out;
        }
        if (!$res->successful()) return $out;

        libxml_use_internal_errors(true);
        $dom = new \DOMDocument();
        $dom->loadHTML('<?xml encoding="utf-8" ?>' . substr($res->body(), 0, 600000));
        libxml_clear_errors();

        $meta = [];
        foreach ($dom->getElementsByTagName('meta') as $m) {
            $key = strtolower($m->getAttribute('property') ?: $m->getAttribute('name'));
            if ($key && !isset($meta[$key])) $meta[$key] = trim($m->getAttribute('content'));
        }

        $title = $meta['og:title'] ?? $meta['twitter:title'] ?? null;
        if (!$title && ($t = $dom->getElementsByTagName('title')->item(0))) $title = trim($t->textContent);

        $img = $meta['og:image'] ?? $meta['twitter:image'] ?? null;
        if ($img && str_starts_with($img, '//')) $img = $p['scheme'] . ':' . $img;
        elseif ($img && str_starts_with($img, '/')) $img = $p['scheme'] . '://' . $p['host'] . $img;
        if ($img && !preg_match('#^https?://#i', $img)) $img = null;

        return [
            'title'       => $title ? Str::limit($title, 250, '') : null,
            'description' => Str::limit($meta['og:description'] ?? $meta['twitter:description'] ?? $meta['description'] ?? '', 900, '') ?: null,
            'image'       => $img,
        ];
    }

    /** Downloads the image into storage; returns the path, or null on failure. */
    public static function downloadImage(string $imgUrl): ?string
    {
        try {
            $res = Http::timeout(10)->withHeaders(['User-Agent' => self::UA])->get($imgUrl);
        } catch (\Throwable $e) {
            return null;
        }

        $type = strtolower(strtok($res->header('Content-Type') ?? '', ';'));
        $ext  = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/webp' => 'webp', 'image/gif' => 'gif'][$type] ?? null;

        if (!$res->successful() || !$ext || strlen($res->body()) > 3 * 1024 * 1024) return null;

        $path = 'affiliate-links/' . Str::uuid() . '.' . $ext;
        Storage::disk('public')->put($path, $res->body());

        return $path;
    }
}
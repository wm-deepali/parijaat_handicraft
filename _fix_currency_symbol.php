<?php

$dir = __DIR__ . '/resources/views/admin';
$rupee = "\u{20B9}";
$call = 'app(\\App\\Support\\Region::class)->defaultSymbol()';
$updated = [];

$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));

foreach ($iterator as $file) {
    if (!$file->isFile() || !str_ends_with($file->getFilename(), '.blade.php')) {
        continue;
    }

    $path = $file->getPathname();
    $src = file_get_contents($path);

    if (
        !str_contains($src, $rupee)
        && !str_contains($src, '&#8377;')
        && !str_contains($src, 'Rs. ')
        && !str_contains($src, 'fa-rupee-sign')
    ) {
        continue;
    }

    $out = transformCurrencySymbols($src, $rupee, $call);

    if ($out !== $src) {
        file_put_contents($path, $out);
        $updated[] = str_replace('\\', '/', substr($path, strlen(__DIR__) + 1));
    }
}

echo implode(PHP_EOL, $updated), PHP_EOL, 'files: ', count($updated), PHP_EOL;

$w = file_get_contents(__DIR__ . '/resources/views/admin/customers/customer-wishlist.blade.php');
$p = strpos($w, 'rupee');
echo "wishlist pos=$p\n";
echo substr($w, $p - 8, 30), "\n";
echo bin2hex(substr($w, $p - 3, 24)), "\n";

$c = file_get_contents(__DIR__ . '/resources/views/admin/orders/credit-note.blade.php');
$q = strpos($c, '8377');
echo "credit pos=$q containsEntity=" . (str_contains($c, '&#8377;') ? 'yes' : 'no') . "\n";
echo substr($c, $q - 8, 24), "\n";
echo bin2hex(substr($c, $q - 6, 16)), "\n";
debugState($w, "\u{20B9}", strpos($w, 'fa-rupee-sign'), 'wishlist-icon');
debugState($c, "\u{20B9}", strpos($c, '&#8377;'), 'credit-entity');

function debugState(string $src, string $rupee, int $target, string $label): void
{
    $len = strlen($src);
    $i = 0;
    $state = 'html';
    $lastOpen = 0;

    while ($i < $len) {
        if ($i === $target) {
            echo "$label state=$state i=$i lastOpen=$lastOpen context=" . json_encode(substr($src, max(0, $lastOpen - 40), 80)) . "\n";
            return;
        }

        if ($state === 'html') {
            if (substr($src, $i, 4) === '{{--') {
                $state = 'comment';
                $lastOpen = $i;
                $i += 4;
                continue;
            }
            if (substr($src, $i, 2) === '{{' && ($i === 0 || $src[$i - 1] !== '@')) {
                $state = 'echo';
                $lastOpen = $i;
                $i += 2;
                continue;
            }
            if (substr($src, $i, 3) === '{!!') {
                $state = 'raw';
                $lastOpen = $i;
                $i += 3;
                continue;
            }
            $i++;
            continue;
        }

        if ($state === 'comment') {
            if (substr($src, $i, 4) === '--}}') {
                $state = 'html';
                $i += 4;
                continue;
            }
            $i++;
            continue;
        }

        $end = $state === 'echo' ? '}}' : '!!}';
        if (substr($src, $i, strlen($end)) === $end) {
            $state = 'html';
            $i += strlen($end);
            continue;
        }
        $i++;
    }

    echo "$label never reached target=$target len=$len finalState=$state lastOpen=$lastOpen\n";
}

function transformCurrencySymbols(string $src, string $rupee, string $call): string
{
    $len = strlen($src);
    $i = 0;
    $out = '';
    $state = 'html';

    while ($i < $len) {
        if ($state === 'html') {
            if (substr($src, $i, 4) === '{{--') {
                $out .= '{{--';
                $i += 4;
                $state = 'comment';
                continue;
            }

            if (substr($src, $i, 2) === '{{' && ($i === 0 || $src[$i - 1] !== '@')) {
                $out .= '{{';
                $i += 2;
                $state = 'echo';
                continue;
            }

            if (substr($src, $i, 3) === '{!!') {
                $out .= '{!!';
                $i += 3;
                $state = 'raw';
                continue;
            }

            if (substr($src, $i, 4) === 'Rs. ') {
                $out .= '@defaultSymbol()';
                $i += 4;
                continue;
            }

            if (substr($src, $i, 6) === '&#8377;') {
                $out .= '@defaultSymbol()';
                $i += 6;
                continue;
            }

            if (substr($src, $i, 3) === $rupee) {
                $out .= '@defaultSymbol()';
                $i += 3;
                continue;
            }

            if (substr($src, $i, 14) === 'fa-rupee-sign') {
                $out .= 'fa-coins';
                $i += 14;
                continue;
            }

            $out .= $src[$i];
            $i++;
            continue;
        }

        if ($state === 'comment') {
            if (substr($src, $i, 4) === '--}}') {
                $out .= '--}}';
                $i += 4;
                $state = 'html';
                continue;
            }

            $out .= $src[$i];
            $i++;
            continue;
        }

        $end = $state === 'echo' ? '}}' : '!!}';
        $endLen = strlen($end);

        if (substr($src, $i, $endLen) === $end) {
            $out .= $end;
            $i += $endLen;
            $state = 'html';
            continue;
        }

        $quoted = $src[$i] === "'" || $src[$i] === '"';
        if ($quoted && substr($src, $i + 1, 3) === $rupee && ($src[$i + 4] ?? '') === $src[$i]) {
            $out .= $call;
            $i += 5;
            continue;
        }

        $out .= $src[$i];
        $i++;
    }

    return $out;
}

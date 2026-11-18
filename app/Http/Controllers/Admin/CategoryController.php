<?php

namespace App\Http\Controllers\Admin;

use ZipArchive;
use App\Models\TaxClass;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Format;
use App\Imports\CategoryImport;
use Illuminate\Http\UploadedFile;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManager;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Symfony\Component\HttpFoundation\StreamedResponse;

class CategoryController extends Controller
{
    // ✅ List Page
    public function index(Request $request)
    {
        $query = Category::with('parent', 'children');

        // Parent categories dropdown
        $parentCategories = Category::whereNull('parent_id')
            ->orderBy('name')
            ->get();

        // Search
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Type filter
        if ($request->type == 'category') {

            $query->whereNull('parent_id');

        } elseif ($request->type == 'subcategory') {

            $query->whereNotNull('parent_id');

            if ($request->filled('category_id')) {
                $query->where('parent_id', $request->category_id);
            }
        }

        // Sorting
        $sortBy = $request->get('sort_by', 'id');
        $sortOrder = $request->get('sort_order', 'desc');

        $allowedColumns = [
            'id',
            'name',
            'sort_order',
            'status',
            'is_popular'
        ];

        if (in_array($sortBy, $allowedColumns)) {
            $query->orderBy($sortBy, $sortOrder);
        }

        $categories = $query
            ->paginate(10)
            ->appends($request->all());

        return view('admin.categories.index', compact(
            'categories',
            'parentCategories'
        ));
    }

    // ✅ Create
    public function create()
    {
        $parents = Category::whereNull('parent_id')->get();
        $taxClasses = TaxClass::orderBy('name')->get();

        return view('admin.categories.create', compact('parents', 'taxClasses'));
    }

    /**
     * ✅ Compress & store an uploaded image as WebP.
     * Resizes down to max width (keeps aspect ratio, never upscales)
     * and re-encodes as WebP at given quality to shrink file size.
     * Same pattern used for La Pavone product image optimization.
     */
    private function compressAndStore(
        UploadedFile $file,
        string $folder,
        int $maxWidth = 1200,
        int $quality = 80
    ): string {
        $manager = ImageManager::usingDriver(Driver::class);

        $image = $manager->decode($file);

        // Only downscale, never upscale
        if ($image->width() > $maxWidth) {
            $image->scale(width: $maxWidth);
        }

        $encoded = $image->encodeUsingFormat(Format::WEBP, quality: $quality);

        $filename = Str::uuid() . '.webp';
        $path = trim($folder, '/') . '/' . $filename;

        Storage::disk('public')->put($path, (string) $encoded);

        return $path;
    }

    /**
     * Editor-empty check: "<p><br></p>" and similar count as empty,
     * but a table with no text is still kept.
     */
    private function cleanRichText(?string $html): ?string
    {
        $html = trim((string) $html);

        if ($html === '') {
            return null;
        }

        $text = trim(str_replace('&nbsp;', ' ', strip_tags($html)));

        if ($text === '' && !preg_match('/<(table|img)\b/i', $html)) {
            return null;
        }

        return $html;
    }

    private function contentRules(): array
    {
        return [
            'collection_eyebrow' => 'nullable|string|max:100',
            'collection_title' => 'nullable|string|max:150',
            'collection_text' => 'nullable|string|max:500',
            'art_eyebrow' => 'nullable|string|max:100',
            'art_title' => 'nullable|string|max:150',
            'art_text' => 'nullable|string|max:1000',
            'art_caption' => 'nullable|string|max:100',
            'art_image' => 'nullable|image|max:2048',
            'art_points' => 'nullable|array|max:6',
            'art_points.*.title' => 'nullable|string|max:100',
            'art_points.*.text' => 'nullable|string|max:300',
            'tax_class_id' => 'nullable|exists:tax_classes,id',
        ];
    }

    private function contentFields(Request $request): array
    {
        $points = collect((array) $request->art_points)
            ->map(fn($p) => [
                'title' => trim($p['title'] ?? ''),
                'text' => trim($p['text'] ?? ''),
            ])
            ->filter(fn($p) => $p['title'] !== '' || $p['text'] !== '')
            ->values()
            ->all();

        return [
            'collection_eyebrow' => $request->collection_eyebrow ?: null,
            'collection_title' => $request->collection_title ?: null,
            'collection_text' => $request->collection_text ?: null,
            'art_eyebrow' => $request->art_eyebrow ?: null,
            'art_title' => $request->art_title ?: null,
            'art_text' => $request->art_text ?: null,
            'art_caption' => $request->art_caption ?: null,
            'art_points' => $points ?: null,
        ];
    }

    // ✅ Store
    public function store(Request $request)
    {
        $request->validate(array_merge([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'size_chart' => 'nullable|string',
        ], $this->contentRules()));

        $image = null;
        if ($request->hasFile('image')) {
            $image = $this->compressAndStore($request->file('image'), 'categories', 400, 80);
        }

        $artImage = null;
        if ($request->hasFile('art_image')) {
            $artImage = $this->compressAndStore($request->file('art_image'), 'categories/art', 900, 80);
        }

        Category::create(array_merge([
            'name' => $request->name,
            'sub_title' => $request->sub_title,
            'description' => $request->description,

            'slug' => $request->slug
                ? Str::slug($request->slug)
                : Str::slug($request->name),

            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'image' => $image,
            'art_image' => $artImage,
            'size_chart' => $this->cleanRichText($request->size_chart),

            'parent_id' => $request->parent_id ?: null,
            'tax_class_id' => $request->tax_class_id ?: null,

            'is_popular' => $request->is_popular ?? 0,
            'is_featured' => $request->is_featured ?? 0,
            'show_in_navbar' => $request->show_in_navbar ?? 0,

            'added_by' => 'admin',
            'status' => $request->status ?? 1,
            'sort_order' => $request->sort_order ?? 0,
        ], $this->contentFields($request)));

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category Added Successfully');
    }

    // ✅ Edit
    public function edit(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $parents = Category::whereNull('parent_id')
            ->where('id', '!=', $id)
            ->get();

        $taxClasses = TaxClass::orderBy('name')->get();

        $redirect = $request->redirect;

        return view('admin.categories.edit', compact(
            'category',
            'parents',
            'taxClasses',
            'redirect'
        ));
    }


    // ✅ Update
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate(array_merge([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'size_chart' => 'nullable|string',
        ], $this->contentRules()));

        $image = $category->image;
        if ($request->hasFile('image')) {
            if ($category->image && Storage::disk('public')->exists($category->image)) {
                Storage::disk('public')->delete($category->image);
            }
            $image = $this->compressAndStore($request->file('image'), 'categories', 400, 80);
        }

        $artImage = $category->art_image;
        if ($request->hasFile('art_image')) {
            if ($artImage && Storage::disk('public')->exists($artImage)) {
                Storage::disk('public')->delete($artImage);
            }
            $artImage = $this->compressAndStore($request->file('art_image'), 'categories/art', 900, 80);
        } elseif ($request->boolean('remove_art_image')) {
            if ($artImage && Storage::disk('public')->exists($artImage)) {
                Storage::disk('public')->delete($artImage);
            }
            $artImage = null;
        }

        $category->update(array_merge([
            'name' => $request->name,
            'sub_title' => $request->sub_title,
            'description' => $request->description,

            'slug' => $request->slug
                ? Str::slug($request->slug)
                : $category->slug,

            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'image' => $image,
            'art_image' => $artImage,
            'size_chart' => $this->cleanRichText($request->size_chart),

            'parent_id' => $request->parent_id ?: null,
            'tax_class_id' => $request->tax_class_id ?: null,

            'is_popular' => $request->is_popular ?? 0,
            'is_featured' => $request->is_featured ?? 0,
            'show_in_navbar' => $request->show_in_navbar ?? 0,

            'status' => $request->status ?? 1,
            'sort_order' => $request->sort_order ?? 0,
        ], $this->contentFields($request)));

        return redirect($request->redirect ?? route('admin.categories.index'))
            ->with('success', 'Category Updated Successfully');
    }

    // ✅ Delete
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        foreach ([$category->image, $category->art_image] as $file) {
            if ($file && Storage::disk('public')->exists($file)) {
                Storage::disk('public')->delete($file);
            }
        }

        $category->delete();

        return response()->json([
            'message' => 'Category Deleted Successfully'
        ]);
    }

    public function import()
    {
        return view('admin.categories.import');
    }

    public function importStore(Request $request)
    {
        $request->validate([
            'file' => 'required|mimetypes:text/plain,text/csv,application/vnd.ms-excel'
        ]);

        try {

            Excel::import(
                new CategoryImport,
                $request->file('file')
            );

            return redirect()
                ->route('admin.categories.index')
                ->with('success', 'Categories imported successfully.');

        } catch (\Exception $e) {

            return back()->with(
                'error',
                $e->getMessage()
            );
        }
    }

    public function downloadSample()
    {
        $headers = [
            'name',
            'sub_title',
            'image_name',
            'parent_category',
            'meta_title',
            'meta_description',
            'is_popular',
            'is_featured',
            'status',
            'sort_order'
        ];

        $sampleRow = [
            'Corporate Gifts',
            'Premium Corporate Gifts',
            'corporate-gifts.jpg',
            '',
            'Corporate Gifts',
            'Corporate Gifts Category',
            '1',
            '1',
            '1',
            '1'
        ];

        $response = new StreamedResponse(function () use ($headers, $sampleRow) {

            $handle = fopen('php://output', 'w');

            fputcsv($handle, $headers);
            fputcsv($handle, $sampleRow);

            fclose($handle);
        });

        $response->headers->set(
            'Content-Type',
            'text/csv'
        );

        $response->headers->set(
            'Content-Disposition',
            'attachment; filename=category_import_sample.csv'
        );

        return $response;
    }

    public function uploadImagesZip(Request $request)
    {
        $request->validate([
            'zip_file' => 'required|mimes:zip'
        ]);

        try {

            $zip = new ZipArchive();

            if ($zip->open($request->file('zip_file')->getRealPath()) === true) {

                $extractPath = storage_path(
                    'app/public/categories'
                );

                if (!file_exists($extractPath)) {
                    mkdir($extractPath, 0777, true);
                }

                $zip->extractTo($extractPath);

                $zip->close();

                return back()->with(
                    'success',
                    'Category images uploaded successfully.'
                );
            }

            return back()->with(
                'error',
                'Unable to extract ZIP file.'
            );

        } catch (\Exception $e) {

            return back()->with(
                'error',
                $e->getMessage()
            );
        }
    }

    public function downloadParentCategoryReference()
    {
        $categories = Category::whereNull('parent_id')
            ->orWhere('parent_id', 0)
            ->orderBy('id')
            ->get([
                'id',
                'name'
            ]);

        $response = new StreamedResponse(function () use ($categories) {

            $handle = fopen('php://output', 'w');

            fputcsv($handle, [
                'id',
                'category_name'
            ]);

            foreach ($categories as $category) {

                fputcsv($handle, [
                    $category->id,
                    $category->name
                ]);
            }

            fclose($handle);
        });

        $response->headers->set(
            'Content-Type',
            'text/csv'
        );

        $response->headers->set(
            'Content-Disposition',
            'attachment; filename=parent_category_reference.csv'
        );

        return $response;
    }

}
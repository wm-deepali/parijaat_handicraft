<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TaxClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaxClassController extends Controller
{
    public function index()
    {
        $classes = TaxClass::withCount(['categories', 'products'])->orderBy('name')->get();

        return view('admin.tax-classes.index', compact('classes'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'default_class'        => 'nullable|exists:tax_classes,id',
            'classes'              => 'nullable|array',
            'classes.*.name'       => 'required|string|max:100',
            'classes.*.gst_rate'   => 'required|numeric|min:0|max:100',
            'new.name'             => 'nullable|string|max:100|unique:tax_classes,name',
            'new.gst_rate'         => 'nullable|numeric|min:0|max:100',
        ]);

        // same name do rows me nahi hona chahiye
        $names = collect($data['classes'] ?? [])->pluck('name')->map(fn ($n) => mb_strtolower(trim($n)));
        if ($names->count() !== $names->unique()->count()) {
            return back()->withInput()->withErrors(['Tax class names must be unique.']);
        }

        DB::transaction(function () use ($data) {
            foreach ($data['classes'] ?? [] as $id => $row) {
                TaxClass::whereKey($id)->update([
                    'name'       => trim($row['name']),
                    'gst_rate'   => $row['gst_rate'],
                    'is_default' => (int) $id === (int) ($data['default_class'] ?? 0),
                ]);
            }

            if (filled($data['new']['name'] ?? null)) {
                TaxClass::create([
                    'name'       => trim($data['new']['name']),
                    'gst_rate'   => $data['new']['gst_rate'] ?? 0,
                    'is_default' => false,
                ]);
            }
        });

        return back()->with('success', 'Tax classes saved.');
    }

    public function destroy(TaxClass $taxClass)
    {
        if ($taxClass->is_default) {
            return back()->withErrors(['Default tax class cannot be deleted. Choose another default first.']);
        }

        if ($taxClass->categories()->exists() || $taxClass->products()->exists()) {
            return back()->withErrors(["'{$taxClass->name}' is used by categories/products. Change them first."]);
        }

        $taxClass->delete();

        return back()->with('success', 'Tax class deleted.');
    }
}
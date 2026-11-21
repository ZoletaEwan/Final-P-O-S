<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Intervention\Image\Laravel\Facades\Image;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::orderBy('name')->get();

        return view('products.index', compact('products'));
    }

    public function create(): View
    {
        return view('products.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateProduct($request);

        if ($request->hasFile('image')) {
            $data['image'] = $this->storeImage(
                $request->file('image')
            );
        }

        Product::create($data);

        return redirect()
            ->route('products.index')
            ->with('success', 'Product created successfully.');
    }

    public function edit(Product $product): View
    {
        return view('products.edit', compact('product'));
    }

    public function update(
        Request $request,
        Product $product
    ): RedirectResponse {
        $data = $this->validateProduct($request);

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            $data['image'] = $this->storeImage(
                $request->file('image')
            );
        }

        $product->update($data);

        return redirect()
            ->route('products.index')
            ->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        if ($product->sales()->exists()) {
            return redirect()
                ->route('products.index')
                ->with(
                    'error',
                    'This product cannot be deleted because it has sales records.'
                );
        }

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('success', 'Product deleted successfully.');
    }

    private function validateProduct(Request $request): array
    {
        return $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',
            ],
            'price' => [
                'required',
                'numeric',
                'min:0',
            ],
            'stock_quantity' => [
                'required',
                'integer',
                'min:0',
            ],
            'image' => [
                'nullable',
                'image',
                'mimes:jpeg,jpg,png,webp',
                'max:2048',
            ],
        ]);
    }

    private function storeImage(UploadedFile $file): string
    {
        $filename = Str::uuid().'.jpg';
        $path = 'products/'.$filename;

        $image = Image::read($file)
            ->cover(600, 600)
            ->toJpeg(85);

        Storage::disk('public')->put(
            $path,
            (string) $image
        );

        return $path;
    }
}
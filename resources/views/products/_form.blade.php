<div class="space-y-6">
    <div>
        <label
            for="name"
            class="block text-sm font-medium text-gray-700"
        >
            Product Name
        </label>

        <input
            type="text"
            id="name"
            name="name"
            value="{{ old('name', $product->name ?? '') }}"
            class="mt-1 w-full rounded border-gray-300 shadow-sm"
            required
        >

        @error('name')
            <p class="mt-1 text-sm text-red-600">
                {{ $message }}
            </p>
        @enderror
    </div>

    <div>
        <label
            for="price"
            class="block text-sm font-medium text-gray-700"
        >
            Price
        </label>

        <input
            type="number"
            id="price"
            name="price"
            step="0.01"
            min="0"
            value="{{ old('price', $product->price ?? '') }}"
            class="mt-1 w-full rounded border-gray-300 shadow-sm"
            required
        >

        @error('price')
            <p class="mt-1 text-sm text-red-600">
                {{ $message }}
            </p>
        @enderror
    </div>

    <div>
        <label
            for="stock_quantity"
            class="block text-sm font-medium text-gray-700"
        >
            Stock Quantity
        </label>

        <input
            type="number"
            id="stock_quantity"
            name="stock_quantity"
            min="0"
            value="{{ old('stock_quantity', $product->stock_quantity ?? 0) }}"
            class="mt-1 w-full rounded border-gray-300 shadow-sm"
            required
        >

        @error('stock_quantity')
            <p class="mt-1 text-sm text-red-600">
                {{ $message }}
            </p>
        @enderror
    </div>

    <div>
        <label
            for="image"
            class="block text-sm font-medium text-gray-700"
        >
            Product Image
        </label>

        <input
            type="file"
            id="image"
            name="image"
            accept=".jpg,.jpeg,.png,.webp"
            class="mt-1 block w-full text-sm"
        >

        <p class="mt-1 text-sm text-gray-500">
            JPG, PNG, or WebP. Maximum file size: 2 MB.
        </p>

        @error('image')
            <p class="mt-1 text-sm text-red-600">
                {{ $message }}
            </p>
        @enderror

        @isset($product)
            @if ($product->image)
                <img
                    src="{{ asset('storage/'.$product->image) }}"
                    alt="{{ $product->name }}"
                    class="mt-4 h-32 w-32 rounded object-cover"
                >
            @endif
        @endisset
    </div>
</div>
@extends('layouts.pos')

@section('title', 'Record Sale')

@section('content')
    <div class="mx-auto max-w-2xl">
        <div class="mb-6">
            <h1 class="text-3xl font-bold">
                Record Sale
            </h1>

            <p class="mt-1 text-gray-600">
                Select a product, optional customer, and quantity.
            </p>
        </div>

        <form
            method="POST"
            action="{{ route('sales.store') }}"
            class="rounded-lg bg-white p-6 shadow"
        >
            @csrf

            <div class="space-y-6">
                <div>
                    <label
                        for="product_id"
                        class="block text-sm font-medium text-gray-700"
                    >
                        Product
                    </label>

                    <select
                        id="product_id"
                        name="product_id"
                        class="mt-1 w-full rounded border-gray-300 shadow-sm"
                        required
                    >
                        <option value="">Select a product</option>

                        @foreach ($products as $product)
                            <option
                                value="{{ $product->id }}"
                                @selected(old('product_id') == $product->id)
                            >
                                {{ $product->name }}
                                — ₱{{ number_format($product->price, 2) }}
                                — Stock: {{ $product->stock_quantity }}
                            </option>
                        @endforeach
                    </select>

                    @error('product_id')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label
                        for="customer_id"
                        class="block text-sm font-medium text-gray-700"
                    >
                        Customer
                    </label>

                    <select
                        id="customer_id"
                        name="customer_id"
                        class="mt-1 w-full rounded border-gray-300 shadow-sm"
                    >
                        <option value="">Walk-in Customer</option>

                        @foreach ($customers as $customer)
                            <option
                                value="{{ $customer->id }}"
                                @selected(old('customer_id') == $customer->id)
                            >
                                {{ $customer->full_name }}
                            </option>
                        @endforeach
                    </select>

                    @error('customer_id')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label
                        for="quantity"
                        class="block text-sm font-medium text-gray-700"
                    >
                        Quantity
                    </label>

                    <input
                        type="number"
                        id="quantity"
                        name="quantity"
                        min="1"
                        value="{{ old('quantity', 1) }}"
                        class="mt-1 w-full rounded border-gray-300 shadow-sm"
                        required
                    >

                    @error('quantity')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>

            <div class="mt-8 flex gap-3">
                <button
                    type="submit"
                    class="rounded bg-green-600 px-4 py-2 text-white hover:bg-green-700"
                >
                    Record Sale
                </button>

                <a
                    href="{{ route('sales.index') }}"
                    class="rounded bg-gray-200 px-4 py-2 hover:bg-gray-300"
                >
                    Cancel
                </a>
            </div>
        </form>
    </div>
@endsection
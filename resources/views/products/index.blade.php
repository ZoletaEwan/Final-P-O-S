@extends('layouts.pos')

@section('title', 'Products')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold">
                Products
            </h1>

            <p class="mt-1 text-gray-600">
                Manage product prices, stock, and images.
            </p>
        </div>

        <a
            href="{{ route('products.create') }}"
            class="rounded bg-blue-600 px-4 py-2 text-white hover:bg-blue-700"
        >
            Add Product
        </a>
    </div>

    <div class="overflow-hidden rounded-lg bg-white shadow">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold">
                            Image
                        </th>

                        <th class="px-6 py-3 text-left text-sm font-semibold">
                            Name
                        </th>

                        <th class="px-6 py-3 text-left text-sm font-semibold">
                            Price
                        </th>

                        <th class="px-6 py-3 text-left text-sm font-semibold">
                            Stock
                        </th>

                        <th class="px-6 py-3 text-left text-sm font-semibold">
                            Actions
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                    @forelse ($products as $product)
                        <tr>
                            <td class="px-6 py-4">
                                @if ($product->image)
                                    <img
                                        src="{{ asset('storage/'.$product->image) }}"
                                        alt="{{ $product->name }}"
                                        class="h-16 w-16 rounded object-cover"
                                    >
                                @else
                                    <div class="flex h-16 w-16 items-center justify-center rounded bg-gray-200 text-xs text-gray-500">
                                        No image
                                    </div>
                                @endif
                            </td>

                            <td class="px-6 py-4 font-medium">
                                {{ $product->name }}
                            </td>

                            <td class="px-6 py-4">
                                ₱{{ number_format($product->price, 2) }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $product->stock_quantity }}
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex gap-3">
                                    <a
                                        href="{{ route('products.edit', $product) }}"
                                        class="text-blue-600 hover:underline"
                                    >
                                        Edit
                                    </a>

                                    <form
                                        method="POST"
                                        action="{{ route('products.destroy', $product) }}"
                                        onsubmit="return confirm('Delete this product?')"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="text-red-600 hover:underline"
                                        >
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td
                                colspan="5"
                                class="px-6 py-8 text-center text-gray-500"
                            >
                                No products found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
@extends('layouts.pos')

@section('title', 'Sales History')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold">
                Sales History
            </h1>

            <p class="mt-1 text-gray-600">
                View all recorded POS transactions.
            </p>
        </div>

        <a
            href="{{ route('sales.create') }}"
            class="rounded bg-green-600 px-4 py-2 text-white hover:bg-green-700"
        >
            Record Sale
        </a>
    </div>

    <div class="overflow-hidden rounded-lg bg-white shadow">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold">
                            Product
                        </th>

                        <th class="px-6 py-3 text-left text-sm font-semibold">
                            Customer
                        </th>

                        <th class="px-6 py-3 text-left text-sm font-semibold">
                            Staff
                        </th>

                        <th class="px-6 py-3 text-left text-sm font-semibold">
                            Quantity
                        </th>

                        <th class="px-6 py-3 text-left text-sm font-semibold">
                            Total
                        </th>

                        <th class="px-6 py-3 text-left text-sm font-semibold">
                            Date
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                    @forelse ($sales as $sale)
                        <tr>
                            <td class="px-6 py-4 font-medium">
                                {{ $sale->product->name }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $sale->customer?->full_name ?? 'Walk-in Customer' }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $sale->staff->full_name }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $sale->quantity }}
                            </td>

                            <td class="px-6 py-4">
                                ₱{{ number_format($sale->total_price, 2) }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $sale->created_at->format('M d, Y h:i A') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td
                                colspan="6"
                                class="px-6 py-8 text-center text-gray-500"
                            >
                                No sales have been recorded.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">
        {{ $sales->links() }}
    </div>
@endsection
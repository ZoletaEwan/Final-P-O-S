@extends('layouts.pos')

@section('title', 'Dashboard')

@section('content')
    <div class="mb-8">
        <h1 class="text-3xl font-bold">
            POS Dashboard
        </h1>

        <p class="mt-2 text-gray-600">
            Welcome, {{ auth()->user()->full_name }}.
        </p>
    </div>

    @php
        $modules = [
            [
                'title' => 'Products',
                'description' => 'Manage prices, stock, and product images.',
                'route' => 'products.index',
            ],
            [
                'title' => 'Customers',
                'description' => 'Manage customer contact information.',
                'route' => 'customers.index',
            ],
            [
                'title' => 'Staff',
                'description' => 'Manage staff accounts and avatars.',
                'route' => 'staff.index',
            ],
            [
                'title' => 'Record Sale',
                'description' => 'Create a new POS transaction.',
                'route' => 'sales.create',
            ],
            [
                'title' => 'Sales History',
                'description' => 'Review all recorded transactions.',
                'route' => 'sales.index',
            ],
        ];
    @endphp

    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
        @foreach ($modules as $module)
            <a
                href="{{ route($module['route']) }}"
                class="rounded-lg bg-white p-6 shadow transition hover:-translate-y-1 hover:shadow-lg"
            >
                <h2 class="text-xl font-semibold">
                    {{ $module['title'] }}
                </h2>

                <p class="mt-2 text-gray-600">
                    {{ $module['description'] }}
                </p>
            </a>
        @endforeach
    </div>
@endsection
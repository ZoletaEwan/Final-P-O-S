<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>@yield('title', 'POS System')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-gray-100 text-gray-900">
    <nav class="bg-slate-800 text-white shadow">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4">
            <div class="flex items-center gap-6">
                <a
                    href="{{ route('dashboard') }}"
                    class="text-xl font-bold"
                >
                    P-O-S
                </a>

                <a
                    href="{{ route('dashboard') }}"
                    class="hover:text-blue-300"
                >
                    Dashboard
                </a>

                <a
                    href="{{ route('products.index') }}"
                    class="hover:text-blue-300"
                >
                    Products
                </a>

                <a
                    href="{{ route('customers.index') }}"
                    class="hover:text-blue-300"
                >
                    Customers
                </a>

                <a
                    href="{{ route('staff.index') }}"
                    class="hover:text-blue-300"
                >
                    Staff
                </a>

                <a
                    href="{{ route('sales.create') }}"
                    class="hover:text-blue-300"
                >
                    Record Sale
                </a>

                <a
                    href="{{ route('sales.index') }}"
                    class="hover:text-blue-300"
                >
                    Sales History
                </a>
            </div>

            <div class="flex items-center gap-4">
                <span class="text-sm">
                    {{ auth()->user()->full_name }}
                </span>

                <form
                    method="POST"
                    action="{{ route('logout') }}"
                >
                    @csrf

                    <button
                        type="submit"
                        class="rounded bg-red-600 px-3 py-2 text-sm hover:bg-red-700"
                    >
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <main class="mx-auto max-w-7xl px-6 py-8">
        @if (session('success'))
            <div class="mb-6 rounded border border-green-300 bg-green-100 px-4 py-3 text-green-800">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mb-6 rounded border border-red-300 bg-red-100 px-4 py-3 text-red-800">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>
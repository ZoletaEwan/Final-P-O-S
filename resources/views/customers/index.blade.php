@extends('layouts.pos')

@section('title', 'Customers')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold">
                Customers
            </h1>

            <p class="mt-1 text-gray-600">
                Manage customer contact information.
            </p>
        </div>

        <a
            href="{{ route('customers.create') }}"
            class="rounded bg-blue-600 px-4 py-2 text-white hover:bg-blue-700"
        >
            Add Customer
        </a>
    </div>

    <div class="overflow-hidden rounded-lg bg-white shadow">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold">
                            Full Name
                        </th>

                        <th class="px-6 py-3 text-left text-sm font-semibold">
                            Email
                        </th>

                        <th class="px-6 py-3 text-left text-sm font-semibold">
                            Phone
                        </th>

                        <th class="px-6 py-3 text-left text-sm font-semibold">
                            Actions
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                    @forelse ($customers as $customer)
                        <tr>
                            <td class="px-6 py-4 font-medium">
                                {{ $customer->full_name }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $customer->email }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $customer->phone ?: '—' }}
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex gap-3">
                                    <a
                                        href="{{ route('customers.edit', $customer) }}"
                                        class="text-blue-600 hover:underline"
                                    >
                                        Edit
                                    </a>

                                    <form
                                        method="POST"
                                        action="{{ route('customers.destroy', $customer) }}"
                                        onsubmit="return confirm('Delete this customer?')"
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
                                colspan="4"
                                class="px-6 py-8 text-center text-gray-500"
                            >
                                No customers found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
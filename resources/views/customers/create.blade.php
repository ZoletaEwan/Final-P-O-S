@extends('layouts.pos')

@section('title', 'Add Customer')

@section('content')
    <div class="mx-auto max-w-2xl">
        <div class="mb-6">
            <h1 class="text-3xl font-bold">
                Add Customer
            </h1>

            <p class="mt-1 text-gray-600">
                Enter the customer information below.
            </p>
        </div>

        <form
            method="POST"
            action="{{ route('customers.store') }}"
            class="rounded-lg bg-white p-6 shadow"
        >
            @csrf

            @include('customers._form')

            <div class="mt-8 flex gap-3">
                <button
                    type="submit"
                    class="rounded bg-blue-600 px-4 py-2 text-white hover:bg-blue-700"
                >
                    Save Customer
                </button>

                <a
                    href="{{ route('customers.index') }}"
                    class="rounded bg-gray-200 px-4 py-2 hover:bg-gray-300"
                >
                    Cancel
                </a>
            </div>
        </form>
    </div>
@endsection
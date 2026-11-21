@extends('layouts.pos')

@section('title', 'Add Staff')

@section('content')
    <div class="mx-auto max-w-2xl">
        <div class="mb-6">
            <h1 class="text-3xl font-bold">
                Add Staff Account
            </h1>

            <p class="mt-1 text-gray-600">
                Create a new staff login account.
            </p>
        </div>

        <form
            method="POST"
            action="{{ route('staff.store') }}"
            enctype="multipart/form-data"
            class="rounded-lg bg-white p-6 shadow"
        >
            @csrf

            @include('staff._form')

            <div class="mt-8 flex gap-3">
                <button
                    type="submit"
                    class="rounded bg-blue-600 px-4 py-2 text-white hover:bg-blue-700"
                >
                    Save Staff
                </button>

                <a
                    href="{{ route('staff.index') }}"
                    class="rounded bg-gray-200 px-4 py-2 hover:bg-gray-300"
                >
                    Cancel
                </a>
            </div>
        </form>
    </div>
@endsection
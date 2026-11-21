@extends('layouts.pos')

@section('title', 'Edit Staff')

@section('content')
    <div class="mx-auto max-w-2xl">
        <div class="mb-6">
            <h1 class="text-3xl font-bold">
                Edit Staff Account
            </h1>

            <p class="mt-1 text-gray-600">
                Update the staff information below.
            </p>
        </div>

        <form
            method="POST"
            action="{{ route('staff.update', $user) }}"
            enctype="multipart/form-data"
            class="rounded-lg bg-white p-6 shadow"
        >
            @csrf
            @method('PUT')

            @include('staff._form')

            <div class="mt-8 flex gap-3">
                <button
                    type="submit"
                    class="rounded bg-blue-600 px-4 py-2 text-white hover:bg-blue-700"
                >
                    Update Staff
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
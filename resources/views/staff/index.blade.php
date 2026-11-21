@extends('layouts.pos')

@section('title', 'Staff')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold">
                Staff Accounts
            </h1>

            <p class="mt-1 text-gray-600">
                Manage staff login accounts and avatars.
            </p>
        </div>

        <a
            href="{{ route('staff.create') }}"
            class="rounded bg-blue-600 px-4 py-2 text-white hover:bg-blue-700"
        >
            Add Staff
        </a>
    </div>

    <div class="overflow-hidden rounded-lg bg-white shadow">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold">
                            Avatar
                        </th>

                        <th class="px-6 py-3 text-left text-sm font-semibold">
                            Username
                        </th>

                        <th class="px-6 py-3 text-left text-sm font-semibold">
                            Full Name
                        </th>

                        <th class="px-6 py-3 text-left text-sm font-semibold">
                            Actions
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                    @forelse ($users as $user)
                        <tr>
                            <td class="px-6 py-4">
                                @if ($user->avatar)
                                    <img
                                        src="{{ asset('storage/'.$user->avatar) }}"
                                        alt="{{ $user->full_name }}"
                                        class="h-16 w-16 rounded-full object-cover"
                                    >
                                @else
                                    <div class="flex h-16 w-16 items-center justify-center rounded-full bg-slate-200 text-xl font-bold text-slate-600">
                                        {{ strtoupper(substr($user->full_name, 0, 1)) }}
                                    </div>
                                @endif
                            </td>

                            <td class="px-6 py-4 font-medium">
                                {{ $user->username }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $user->full_name }}
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <a
                                        href="{{ route('staff.edit', $user) }}"
                                        class="text-blue-600 hover:underline"
                                    >
                                        Edit
                                    </a>

                                    @if (auth()->id() !== $user->id)
                                        <form
                                            method="POST"
                                            action="{{ route('staff.destroy', $user) }}"
                                            onsubmit="return confirm('Delete this staff account?')"
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
                                    @else
                                        <span class="text-sm text-gray-500">
                                            Current account
                                        </span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td
                                colspan="4"
                                class="px-6 py-8 text-center text-gray-500"
                            >
                                No staff accounts found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
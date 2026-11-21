<div class="space-y-6">
    <div>
        <label
            for="username"
            class="block text-sm font-medium text-gray-700"
        >
            Username
        </label>

        <input
            type="text"
            id="username"
            name="username"
            value="{{ old('username', $user->username ?? '') }}"
            class="mt-1 w-full rounded border-gray-300 shadow-sm"
            required
        >

        @error('username')
            <p class="mt-1 text-sm text-red-600">
                {{ $message }}
            </p>
        @enderror
    </div>

    <div>
        <label
            for="full_name"
            class="block text-sm font-medium text-gray-700"
        >
            Full Name
        </label>

        <input
            type="text"
            id="full_name"
            name="full_name"
            value="{{ old('full_name', $user->full_name ?? '') }}"
            class="mt-1 w-full rounded border-gray-300 shadow-sm"
            required
        >

        @error('full_name')
            <p class="mt-1 text-sm text-red-600">
                {{ $message }}
            </p>
        @enderror
    </div>

    <div>
        <label
            for="password"
            class="block text-sm font-medium text-gray-700"
        >
            Password
        </label>

        <input
            type="password"
            id="password"
            name="password"
            class="mt-1 w-full rounded border-gray-300 shadow-sm"
            @empty($user) required @endempty
        >

        @isset($user)
            <p class="mt-1 text-sm text-gray-500">
                Leave blank to keep the current password.
            </p>
        @endisset

        @error('password')
            <p class="mt-1 text-sm text-red-600">
                {{ $message }}
            </p>
        @enderror
    </div>

    <div>
        <label
            for="password_confirmation"
            class="block text-sm font-medium text-gray-700"
        >
            Confirm Password
        </label>

        <input
            type="password"
            id="password_confirmation"
            name="password_confirmation"
            class="mt-1 w-full rounded border-gray-300 shadow-sm"
            @empty($user) required @endempty
        >
    </div>

    <div>
        <label
            for="avatar"
            class="block text-sm font-medium text-gray-700"
        >
            Avatar
        </label>

        <input
            type="file"
            id="avatar"
            name="avatar"
            accept=".jpg,.jpeg,.png,.webp"
            class="mt-1 block w-full text-sm"
        >

        <p class="mt-1 text-sm text-gray-500">
            JPG, PNG, or WebP. Maximum file size: 2 MB.
        </p>

        @error('avatar')
            <p class="mt-1 text-sm text-red-600">
                {{ $message }}
            </p>
        @enderror

        @isset($user)
            @if ($user->avatar)
                <img
                    src="{{ asset('storage/'.$user->avatar) }}"
                    alt="{{ $user->full_name }}"
                    class="mt-4 h-32 w-32 rounded-full object-cover"
                >
            @endif
        @endisset
    </div>
</div>
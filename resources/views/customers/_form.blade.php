<div class="space-y-6">
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
            value="{{ old('full_name', $customer->full_name ?? '') }}"
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
            for="email"
            class="block text-sm font-medium text-gray-700"
        >
            Email
        </label>

        <input
            type="email"
            id="email"
            name="email"
            value="{{ old('email', $customer->email ?? '') }}"
            class="mt-1 w-full rounded border-gray-300 shadow-sm"
            required
        >

        @error('email')
            <p class="mt-1 text-sm text-red-600">
                {{ $message }}
            </p>
        @enderror
    </div>

    <div>
        <label
            for="phone"
            class="block text-sm font-medium text-gray-700"
        >
            Phone
        </label>

        <input
            type="text"
            id="phone"
            name="phone"
            value="{{ old('phone', $customer->phone ?? '') }}"
            class="mt-1 w-full rounded border-gray-300 shadow-sm"
        >

        @error('phone')
            <p class="mt-1 text-sm text-red-600">
                {{ $message }}
            </p>
        @enderror
    </div>
</div>
<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;
use Intervention\Image\Laravel\Facades\Image;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::orderBy('full_name')->get();

        return view('staff.index', compact('users'));
    }

    public function create(): View
    {
        return view('staff.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateUser($request);

        if ($request->hasFile('avatar')) {
            $data['avatar'] = $this->storeAvatar(
                $request->file('avatar')
            );
        }

        User::create($data);

        return redirect()
            ->route('staff.index')
            ->with('success', 'Staff account created successfully.');
    }

    public function edit(User $user): View
    {
        return view('staff.edit', compact('user'));
    }

    public function update(
        Request $request,
        User $user
    ): RedirectResponse {
        $data = $this->validateUser($request, $user);

        if (! $request->filled('password')) {
            unset($data['password']);
        }

        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }

            $data['avatar'] = $this->storeAvatar(
                $request->file('avatar')
            );
        }

        $user->update($data);

        return redirect()
            ->route('staff.index')
            ->with('success', 'Staff account updated successfully.');
    }

    public function destroy(User $user): RedirectResponse
    {
        if (auth()->id() === $user->id) {
            return redirect()
                ->route('staff.index')
                ->with('error', 'You cannot delete your own account.');
        }

        if ($user->sales()->exists()) {
            return redirect()
                ->route('staff.index')
                ->with(
                    'error',
                    'This staff account cannot be deleted because it has sales records.'
                );
        }

        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }

        $user->delete();

        return redirect()
            ->route('staff.index')
            ->with('success', 'Staff account deleted successfully.');
    }

    private function validateUser(
        Request $request,
        ?User $user = null
    ): array {
        $creating = $user === null;

        return $request->validate([
            'username' => [
                'required',
                'string',
                'max:50',
                Rule::unique('users', 'username')
                    ->ignore($user),
            ],
            'full_name' => [
                'required',
                'string',
                'max:100',
            ],
            'password' => [
                $creating ? 'required' : 'nullable',
                'confirmed',
                Password::min(8),
            ],
            'avatar' => [
                'nullable',
                'image',
                'mimes:jpeg,jpg,png,webp',
                'max:2048',
            ],
        ]);
    }

    private function storeAvatar(UploadedFile $file): string
    {
        $filename = Str::uuid().'.jpg';
        $path = 'avatars/'.$filename;

        $image = Image::read($file)
            ->cover(300, 300)
            ->toJpeg(85);

        Storage::disk('public')->put(
            $path,
            (string) $image
        );

        return $path;
    }
}
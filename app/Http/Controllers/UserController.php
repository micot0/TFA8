<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Intervention\Image\ImageManager;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id')->get();

        return view('users', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'username' => [
                'required', 'string', 'max:255',
                Rule::unique('users', 'username'),
            ],
            'full_name' => ['required', 'string', 'max:255'],
            'email' => [
                'required', 'email', 'max:255',
                Rule::unique('users', 'email'),
            ],
            'password' => ['required', 'string', 'min:8', 'max:72'],
            'role' => [
                'required',
                Rule::in(['Administrator', 'Manager', 'Cashier', 'Staff']),
            ],
        ]);

        // The User model's hashed cast encrypts the password as a hash.
        User::create($data);

        return redirect()->route('users.index')
            ->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'username' => [
                'required', 'string', 'max:255',
                Rule::unique('users', 'username')->ignore($user),
            ],
            'full_name' => ['required', 'string', 'max:255'],
            'email' => [
                'required', 'email', 'max:255',
                Rule::unique('users', 'email')->ignore($user),
            ],
            'password' => ['nullable', 'string', 'min:8', 'max:72'],
            'role' => [
                'required',
                Rule::in(['Administrator', 'Manager', 'Cashier', 'Staff']),
            ],
            'avatar' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
                'dimensions:max_width=4096,max_height=4096',
            ],
        ]);

        // Keep the existing password when the field is blank.
        if (empty($data['password'])) {
            unset($data['password']);
        }

        unset($data['avatar']);

        $oldAvatar = $user->avatar;
        $newAvatar = null;

        if ($request->hasFile('avatar')) {
            try {
                $image = ImageManager::gd()
                    ->read($request->file('avatar')->getRealPath())
                    ->cover(200, 200)
                    ->toJpeg(85);
            } catch (\Intervention\Image\Exceptions\DecoderException $e) {
                throw ValidationException::withMessages([
                    'avatar' => 'This image could not be read. Try another image.',
                ]);
            }

            $newAvatar = 'avatars/' . Str::uuid() . '.jpg';

            $saved = Storage::disk('public')->put(
                $newAvatar,
                (string) $image
            );

            if (! $saved) {
                throw ValidationException::withMessages([
                    'avatar' => 'The image could not be saved. Please try again.',
                ]);
            }

            $data['avatar'] = $newAvatar;
        }

        try {
            $user->update($data);
        } catch (\Throwable $e) {
            if ($newAvatar) {
                Storage::disk('public')->delete($newAvatar);
            }

            throw $e;
        }

        // Remove the previous avatar only after the update succeeds.
        if ($newAvatar && $oldAvatar) {
            Storage::disk('public')->delete($oldAvatar);
        }

        return redirect()->route('users.index')
            ->with('success', 'User updated successfully.');
    }
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function destroy(User $user)
    {
        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }

        $user->delete();

        return redirect()->route('users.index')
           ->with('success', 'User deleted successfully.');
    }
}
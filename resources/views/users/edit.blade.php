<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel POS - Edit User</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <nav>
        <a href="{{ url('/') }}">Laravel POS</a>
        <a href="{{ url('/about') }}">About</a>
        <a href="{{ route('customers.index') }}">Customer Accounts</a>
        <a href="{{ route('users.index') }}">User Accounts</a>
    </nav>

    <main class="container">
        <h1>Edit User</h1>

        <div class="card">
            @if ($errors->any())
                <div role="alert" style="color: #b91c1c;">
                    <strong>Please correct the following:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form
                action="{{ route('users.update', $user) }}"
                method="POST"
                enctype="multipart/form-data"
            >
                @csrf
                @method('PUT')

                <p>
                    <label for="username">Username *</label><br>
                    <input
                        id="username"
                        type="text"
                        name="username"
                        value="{{ old('username', $user->username) }}"
                        maxlength="255"
                        required
                    >
                </p>

                <p>
                    <label for="full_name">Full Name *</label><br>
                    <input
                        id="full_name"
                        type="text"
                        name="full_name"
                        value="{{ old('full_name', $user->full_name) }}"
                        maxlength="255"
                        required
                    >
                </p>

                <p>
                    <label for="email">Email *</label><br>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email', $user->email) }}"
                        maxlength="255"
                        required
                    >
                </p>

                <p>
                    <label for="password">New Password</label><br>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        minlength="8"
                        maxlength="72"
                        autocomplete="new-password"
                    >
                    <br>
                    <small>Leave blank to keep the current password.</small>
                </p>

                <p>
                    <label for="role">Role *</label><br>
                    <select id="role" name="role" required>
                        @foreach (['Staff', 'Cashier', 'Manager', 'Administrator'] as $role)
                            <option
                                value="{{ $role }}"
                                @selected(old('role', $user->role) === $role)
                            >
                                {{ $role }}
                            </option>
                        @endforeach
                    </select>
                </p>

                @if ($user->avatar)
                    <p>
                        <img
                            src="{{ asset('storage/' . $user->avatar) }}"
                            alt="Current avatar"
                            width="100"
                            height="100"
                            style="border-radius: 50%; object-fit: cover;"
                        >
                    </p>
                @endif

                <p>
                    <label for="avatar">Profile Picture</label><br>
                    <input
                        id="avatar"
                        type="file"
                        name="avatar"
                        accept="image/jpeg,image/png,image/webp"
                    >
                    <br>
                    <small>
                        JPG, PNG, or WebP. Maximum 2 MB and
                        4096 × 4096 pixels. Leave empty to keep
                        the current picture.
                    </small>
                </p>

                <button type="submit">Update User</button>
                <a href="{{ route('users.index') }}">Cancel</a>
            </form>
        </div>
    </main>
</body>
</html>
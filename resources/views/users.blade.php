
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel POS - Users</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <nav>
        <a href="{{ url('/') }}">Laravel POS</a>
        <a href="{{ url('/about') }}">About</a>
        <a href="{{ route('customers.index') }}">Customer Accounts</a>
        <a href="{{ route('users.index') }}">User Accounts</a>

        @auth
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit"
                    style="background: none; border: none; color: white; cursor: pointer; font: inherit;">
                    Logout
                </button>
            </form>
        @endauth
    </nav>

    <main class="container">
        <h1>User Accounts</h1>
        <p>View and manage user account information.</p>

        @if (session('success'))
            <div role="status" style="color: #166534;">
                {{ session('success') }}
            </div>
        @endif

        <div class="card">
            <h2>User List</h2>

            <a href="{{ route('users.create') }}">+ Create User</a>

            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Avatar</th>
                            <th>Username</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>
                                    <img
                                        src="{{ $user->avatar
                                            ? asset('storage/' . $user->avatar)
                                            : asset('images/avatar-placeholder.svg') }}"
                                        alt="Avatar for {{ $user->full_name }}"
                                        width="60"
                                        height="60"
                                        style="border-radius: 50%; object-fit: cover;"
                                    >
                                </td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->full_name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <span class="badge">
                                        {{ $user->role }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('users.edit', $user) }}">
                                        Edit
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">No users found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>
</html>

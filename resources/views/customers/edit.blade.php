<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel POS - Edit Customer</title>
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
        <h1>Edit Customer</h1>

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
                action="{{ route('customers.update', $customer) }}"
                method="POST"
            >
                @csrf
                @method('PUT')

                <p>
                    <label for="full_name">Full Name *</label><br>
                    <input
                        id="full_name"
                        type="text"
                        name="full_name"
                        value="{{ old('full_name', $customer->full_name) }}"
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
                        value="{{ old('email', $customer->email) }}"
                        maxlength="255"
                        required
                    >
                </p>

                <p>
                    <label for="phone">Phone</label><br>
                    <input
                        id="phone"
                        type="tel"
                        name="phone"
                        value="{{ old('phone', $customer->phone) }}"
                        maxlength="255"
                    >
                </p>

                <button type="submit">Update Customer</button>
                <a href="{{ route('customers.index') }}">Cancel</a>
            </form>
        </div>
    </main>
</body>
</html>
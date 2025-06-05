<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/css/app.css', 'resources/js/app.js']) {{-- If using Vite --}}
</head>
<body class="min-h-screen flex items-center justify-center bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-white">

    <div class="w-full max-w-md p-8 bg-white dark:bg-gray-800 rounded shadow">
        <h1 class="text-2xl font-bold text-center mb-6">Login</h1>

        <form method="POST" action="{{ route('postlogin') }}">
            @csrf

            {{-- Email --}}
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium mb-1">Email</label>
                <input type="email" id="email" name="email" required autofocus
                    class="w-full px-4 py-2 rounded border border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-yellow-500">
                @error('email')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>

            {{-- Password --}}
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium mb-1">Password</label>
                <input type="password" id="password" name="password" required
                    class="w-full px-4 py-2 rounded border border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-yellow-500">
                @error('password')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>

            {{-- Remember Me --}}
            <div class="flex items-center mb-6">
                <input type="checkbox" id="remember" name="remember" class="mr-2">
                <label for="remember" class="text-sm">Remember me</label>
            </div>

            {{-- Submit --}}
            <button type="submit"
                class="w-full bg-yellow-600 hover:bg-yellow-500 text-white font-semibold py-2 px-4 rounded transition">
                Sign in
            </button>
        </form>
    </div>

</body>
</html>

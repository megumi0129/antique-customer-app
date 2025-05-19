<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>antique customer manage</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 text-gray-800">

    <header class="bg-white shadow p-4 mb-6">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-lg font-bold">
                <a href="{{ route('customers.search') }}" class="hover:text-blue-500">
                     Customer Info
                </a>
            </h1>
            @auth
                <div class="flex items-center space-x-4">
                    <span>{{ Auth::user()->name }}さん</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-sm bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                            ログアウト
                        </button>
                    </form>
                </div>
            @endauth
        </div>
    </header>

    <main class="container mx-auto px-4">
        @yield('content')
    </main>

    <footer class="mt-10 text-center text-sm text-gray-500">
        &copy; {{ date('Y') }} Antique Studio
    </footer>

</body>
</html>

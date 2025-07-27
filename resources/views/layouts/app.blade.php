<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Bioskopin')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    @stack('styles')
</head>
<body class="bg-gray-900 text-white min-h-screen">
    <!-- Navigation -->
    <nav class="bg-gray-800 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="text-2xl font-bold text-blue-400">
                        <i class="fas fa-film mr-2"></i>Bioskopin
                    </a>
                </div>
                <div class="flex items-center space-x-4">
                    <form action="{{ route('search') }}" method="GET" class="flex">
                        <input type="text" name="q" placeholder="Cari Film..." 
                               value="{{ request('q') }}"
                               class="px-4 py-2 bg-gray-700 text-white rounded-l-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 rounded-r-lg">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-center py-8 mt-16">
        <div class="max-w-7xl mx-auto px-4">
            <p class="text-gray-400">&copy; 2025 Bioskopin. All rights reserved.</p>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
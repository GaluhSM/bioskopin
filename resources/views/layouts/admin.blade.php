<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard - CinemaTicket')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @stack('styles')
</head>
<body class="bg-gray-100">
    <!-- Sidebar -->
    <div class="fixed inset-y-0 left-0 z-50 w-64 bg-gray-900 transform -translate-x-full lg:translate-x-0 lg:static lg:inset-0 transition-transform duration-300" id="sidebar">
        <div class="flex items-center justify-center h-16 bg-gray-800">
            <h1 class="text-white text-xl font-bold">
                <i class="fas fa-cog mr-2"></i>Admin Panel
            </h1>
        </div>
        
        <nav class="mt-8">
            <a href="{{ route('admin.dashboard') }}" 
               class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-700 hover:text-white {{ request()->routeIs('admin.dashboard') ? 'bg-gray-700 text-white' : '' }}">
                <i class="fas fa-chart-bar mr-3"></i>Dashboard
            </a>
            <a href="{{ route('admin.qr-scanner') }}" 
               class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-700 hover:text-white {{ request()->routeIs('admin.qr-scanner') ? 'bg-gray-700 text-white' : '' }}">
                <i class="fas fa-qrcode mr-3"></i>QR Scanner
            </a>
            
            <div class="px-6 py-3 text-gray-500 text-xs uppercase tracking-wide">Management</div>
            
            <a href="#" class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-700 hover:text-white">
                <i class="fas fa-film mr-3"></i>Movies
            </a>
            <a href="#" class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-700 hover:text-white">
                <i class="fas fa-building mr-3"></i>Cinemas
            </a>
            <a href="#" class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-700 hover:text-white">
                <i class="fas fa-door-open mr-3"></i>Studios
            </a>
            <a href="#" class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-700 hover:text-white">
                <i class="fas fa-calendar mr-3"></i>Schedules
            </a>
            <a href="#" class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-700 hover:text-white">
                <i class="fas fa-ticket-alt mr-3"></i>Bookings
            </a>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="lg:ml-64">
        <!-- Top Navigation -->
        <header class="bg-white shadow-sm border-b">
            <div class="flex items-center justify-between px-6 py-4">
                <button class="lg:hidden text-gray-600" onclick="toggleSidebar()">
                    <i class="fas fa-bars text-xl"></i>
                </button>
                
                <div class="flex items-center space-x-4">
                    <span class="text-gray-700">Welcome, {{ Auth::user()->name }}</span>
                    <form action="{{ route('admin.logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm transition-colors">
                            <i class="fas fa-sign-out-alt mr-2"></i>Logout
                        </button>
                    </form>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <main class="p-6">
            @yield('content')
        </main>
    </div>

    <!-- Mobile sidebar overlay -->
    <div class="fixed inset-0 z-40 bg-black bg-opacity-50 lg:hidden hidden" id="sidebar-overlay" onclick="toggleSidebar()"></div>

    @stack('scripts')
    
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }
    </script>
</body>
</html>
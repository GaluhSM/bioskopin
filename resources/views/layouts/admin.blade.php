<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard - CinemaTicket')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        /* Custom gradient and animations */
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .hover-lift {
            transition: transform 0.2s ease-in-out;
        }
        .hover-lift:hover {
            transform: translateY(-2px);
        }
        .nav-item {
            position: relative;
            overflow: hidden;
        }
        .nav-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            width: 4px;
            height: 100%;
            background: linear-gradient(180deg, #3b82f6, #1d4ed8);
            transform: scaleY(0);
            transition: transform 0.3s ease;
        }
        .nav-item.active::before {
            transform: scaleY(1);
        }
        .sidebar {
            background: linear-gradient(180deg, #1f2937 0%, #111827 100%);
        }
        .card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            border: 1px solid rgba(229, 231, 235, 0.8);
        }
        .status-badge {
            background: linear-gradient(45deg, var(--from), var(--to));
        }
        .primary-button {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            transition: all 0.3s ease;
        }
        .primary-button:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 20px rgba(59, 130, 246, 0.3);
        }
    </style>
    @stack('styles')
</head>
<body class="bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
    <!-- Sidebar -->
    <div class="fixed inset-y-0 left-0 z-50 w-64 sidebar transform -translate-x-full lg:translate-x-0 lg:static lg:inset-0 transition-transform duration-300" id="sidebar">
        <!-- Logo Section -->
        <div class="flex items-center justify-center h-20 glass-effect border-b border-gray-700">
            <div class="text-center">
                <h1 class="text-white text-xl font-bold flex items-center">
                    <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-crown text-white text-lg"></i>
                    </div>
                    Admin Panel
                </h1>
                <p class="text-gray-400 text-xs mt-1">Cinema Management</p>
            </div>
        </div>
        
        <!-- Navigation -->
        <nav class="mt-8 px-4">
            <!-- Main Menu -->
            <div class="mb-6">
                <p class="text-gray-400 text-xs uppercase tracking-wide font-semibold mb-4 px-4">Overview</p>
                <a href="{{ route('admin.dashboard') }}" 
                   class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }} flex items-center px-4 py-3 text-gray-300 hover:bg-gray-700/50 hover:text-white rounded-xl mb-2 transition-all duration-200 hover-lift">
                    <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-chart-bar text-white"></i>
                    </div>
                    <span class="font-medium">Dashboard</span>
                </a>
                <a href="{{ route('admin.qr-scanner') }}" 
                   class="nav-item {{ request()->routeIs('admin.qr-scanner') ? 'active' : '' }} flex items-center px-4 py-3 text-gray-300 hover:bg-gray-700/50 hover:text-white rounded-xl mb-2 transition-all duration-200 hover-lift">
                    <div class="w-10 h-10 bg-gradient-to-r from-green-500 to-green-600 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-qrcode text-white"></i>
                    </div>
                    <span class="font-medium">QR Scanner</span>
                </a>
            </div>
            
            <!-- Management Section -->
            <div>
                <p class="text-gray-400 text-xs uppercase tracking-wide font-semibold mb-4 px-4">Management</p>
                
                <a href="{{ route('admin.movies.index') }}" 
                   class="nav-item {{ request()->routeIs('admin.movies.*') ? 'active' : '' }} flex items-center px-4 py-3 text-gray-300 hover:bg-gray-700/50 hover:text-white rounded-xl mb-2 transition-all duration-200 hover-lift">
                    <div class="w-10 h-10 bg-gradient-to-r from-red-500 to-red-600 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-film text-white"></i>
                    </div>
                    <span class="font-medium">Movies</span>
                </a>
                
                <a href="{{ route('admin.cinemas.index') }}" 
                   class="nav-item {{ request()->routeIs('admin.cinemas.*') ? 'active' : '' }} flex items-center px-4 py-3 text-gray-300 hover:bg-gray-700/50 hover:text-white rounded-xl mb-2 transition-all duration-200 hover-lift">
                    <div class="w-10 h-10 bg-gradient-to-r from-purple-500 to-purple-600 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-building text-white"></i>
                    </div>
                    <span class="font-medium">Cinemas</span>
                </a>
                
                <a href="{{ route('admin.studios.index') }}" 
                   class="nav-item {{ request()->routeIs('admin.studios.*') ? 'active' : '' }} flex items-center px-4 py-3 text-gray-300 hover:bg-gray-700/50 hover:text-white rounded-xl mb-2 transition-all duration-200 hover-lift">
                    <div class="w-10 h-10 bg-gradient-to-r from-indigo-500 to-indigo-600 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-door-open text-white"></i>
                    </div>
                    <span class="font-medium">Studios</span>
                </a>
                
                <a href="{{ route('admin.schedules.index') }}" 
                   class="nav-item {{ request()->routeIs('admin.schedules.*') ? 'active' : '' }} flex items-center px-4 py-3 text-gray-300 hover:bg-gray-700/50 hover:text-white rounded-xl mb-2 transition-all duration-200 hover-lift">
                    <div class="w-10 h-10 bg-gradient-to-r from-yellow-500 to-yellow-600 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-calendar text-white"></i>
                    </div>
                    <span class="font-medium">Schedules</span>
                </a>
                
                <a href="{{ route('admin.bookings.index') }}" 
                   class="nav-item {{ request()->routeIs('admin.bookings.*') ? 'active' : '' }} flex items-center px-4 py-3 text-gray-300 hover:bg-gray-700/50 hover:text-white rounded-xl mb-2 transition-all duration-200 hover-lift">
                    <div class="w-10 h-10 bg-gradient-to-r from-pink-500 to-pink-600 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-ticket-alt text-white"></i>
                    </div>
                    <span class="font-medium">Bookings</span>
                </a>
            </div>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="lg:ml-64">
        <!-- Top Navigation -->
        <header class="bg-white/80 backdrop-blur-md shadow-sm border-b border-gray-200/50 sticky top-0 z-40">
            <div class="flex items-center justify-between px-6 py-4">
                <div class="flex items-center space-x-4">
                    <button class="lg:hidden text-gray-600 hover:text-gray-900 p-2 rounded-lg hover:bg-gray-100 transition-colors" onclick="toggleSidebar()">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    
                    <!-- Breadcrumb -->
                    <nav class="hidden md:flex items-center space-x-2 text-sm">
                        <i class="fas fa-home text-gray-400"></i>
                        <span class="text-gray-500">Admin</span>
                        <i class="fas fa-chevron-right text-gray-300 text-xs"></i>
                        <span class="text-gray-700 font-medium">@yield('page-title', 'Dashboard')</span>
                    </nav>
                </div>
                
                <div class="flex items-center space-x-4">
                    <!-- User Info -->
                    <div class="hidden md:flex items-center space-x-3">
                        <div class="text-right">
                            <p class="text-sm font-medium text-gray-700">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500">Administrator</p>
                        </div>
                        <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-white text-sm"></i>
                        </div>
                    </div>
                    
                    <!-- Logout Button -->
                    <form action="{{ route('admin.logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white px-4 py-2 rounded-lg text-sm transition-all duration-200 hover-lift flex items-center space-x-2">
                            <i class="fas fa-sign-out-alt"></i>
                            <span class="hidden sm:inline">Logout</span>
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
    <div class="fixed inset-0 z-40 bg-black/50 backdrop-blur-sm lg:hidden hidden transition-opacity duration-300" id="sidebar-overlay" onclick="toggleSidebar()"></div>

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
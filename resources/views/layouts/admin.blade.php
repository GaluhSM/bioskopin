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
        body {
            background: #0f172a;
            color: #e2e8f0;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        }
        
        .sidebar {
            background: linear-gradient(180deg, #1e293b 0%, #0f172a 100%);
            border-right: 1px solid #334155;
        }
        
        .nav-item {
            position: relative;
            transition: all 0.2s ease;
        }
        
        .nav-item:hover {
            background: rgba(51, 65, 85, 0.5);
        }
        
        .nav-item.active {
            background: rgba(59, 130, 246, 0.15);
            border-left: 3px solid #3b82f6;
        }
        
        .nav-icon {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--icon-bg, rgba(75, 85, 99, 0.5));
        }
        
        .header {
            background: rgba(15, 23, 42, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid #334155;
        }
        
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
            border: none;
            transition: all 0.2s ease;
        }
        
        .btn-primary:hover {
            background: linear-gradient(135deg, #b91c1c 0%, #991b1b 100%);
            transform: translateY(-1px);
        }
    </style>
    @stack('styles')
</head>
<body>
    <!-- Sidebar -->
    <div class="fixed inset-y-0 left-0 z-50 w-64 sidebar">
        <!-- Logo -->
        <div class="flex items-center justify-center h-20 border-b border-slate-700">
            <div class="text-center">
                <h1 class="text-white text-xl font-bold flex items-center">
                    <div class="w-10 h-10 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-crown text-white"></i>
                    </div>
                    Admin Panel
                </h1>
                <p class="text-slate-400 text-xs mt-1">Cinema Management System</p>
            </div>
        </div>
        
        <!-- Navigation -->
        <nav class="mt-6 px-4">
            <!-- Overview Section -->
            <div class="mb-8">
                <p class="text-slate-500 text-xs uppercase tracking-wide font-semibold mb-4 px-3">Overview</p>
                
                <a href="{{ route('admin.dashboard') }}" 
                   class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }} flex items-center px-3 py-3 text-slate-300 rounded-lg mb-2">
                    <div class="nav-icon mr-3" style="--icon-bg: rgba(59, 130, 246, 0.2);">
                        <i class="fas fa-chart-pie text-blue-400"></i>
                    </div>
                    <span class="font-medium">Dashboard</span>
                </a>
                
                <a href="{{ route('admin.qr-scanner') }}" 
                   class="nav-item {{ request()->routeIs('admin.qr-scanner') ? 'active' : '' }} flex items-center px-3 py-3 text-slate-300 rounded-lg mb-2">
                    <div class="nav-icon mr-3" style="--icon-bg: rgba(16, 185, 129, 0.2);">
                        <i class="fas fa-qrcode text-green-400"></i>
                    </div>
                    <span class="font-medium">QR Scanner</span>
                </a>
            </div>
            
            <!-- Management Section -->
            <div>
                <p class="text-slate-500 text-xs uppercase tracking-wide font-semibold mb-4 px-3">Management</p>
                
                <a href="{{ route('admin.movies.index') }}" 
                   class="nav-item {{ request()->routeIs('admin.movies.*') ? 'active' : '' }} flex items-center px-3 py-3 text-slate-300 rounded-lg mb-2">
                    <div class="nav-icon mr-3" style="--icon-bg: rgba(239, 68, 68, 0.2);">
                        <i class="fas fa-film text-red-400"></i>
                    </div>
                    <span class="font-medium">Movies</span>
                </a>
                
                <a href="{{ route('admin.cinemas.index') }}" 
                   class="nav-item {{ request()->routeIs('admin.cinemas.*') ? 'active' : '' }} flex items-center px-3 py-3 text-slate-300 rounded-lg mb-2">
                    <div class="nav-icon mr-3" style="--icon-bg: rgba(139, 92, 246, 0.2);">
                        <i class="fas fa-building text-purple-400"></i>
                    </div>
                    <span class="font-medium">Cinemas</span>
                </a>
                
                <a href="{{ route('admin.studios.index') }}" 
                   class="nav-item {{ request()->routeIs('admin.studios.*') ? 'active' : '' }} flex items-center px-3 py-3 text-slate-300 rounded-lg mb-2">
                    <div class="nav-icon mr-3" style="--icon-bg: rgba(6, 182, 212, 0.2);">
                        <i class="fas fa-door-open text-cyan-400"></i>
                    </div>
                    <span class="font-medium">Studios</span>
                </a>
                
                <a href="{{ route('admin.schedules.index') }}" 
                   class="nav-item {{ request()->routeIs('admin.schedules.*') ? 'active' : '' }} flex items-center px-3 py-3 text-slate-300 rounded-lg mb-2">
                    <div class="nav-icon mr-3" style="--icon-bg: rgba(245, 158, 11, 0.2);">
                        <i class="fas fa-calendar text-amber-400"></i>
                    </div>
                    <span class="font-medium">Schedules</span>
                </a>
                
                <a href="{{ route('admin.bookings.index') }}" 
                   class="nav-item {{ request()->routeIs('admin.bookings.*') ? 'active' : '' }} flex items-center px-3 py-3 text-slate-300 rounded-lg mb-2">
                    <div class="nav-icon mr-3" style="--icon-bg: rgba(236, 72, 153, 0.2);">
                        <i class="fas fa-ticket-alt text-pink-400"></i>
                    </div>
                    <span class="font-medium">Bookings</span>
                </a>
            </div>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="ml-64">
        <!-- Header -->
        <header class="header sticky top-0 z-40">
            <div class="flex items-center justify-between px-6 py-4">
                <div class="flex items-center space-x-4">
                    <!-- Breadcrumb -->
                    <nav class="flex items-center space-x-2 text-sm">
                        <i class="fas fa-home text-slate-400"></i>
                        <span class="text-slate-500">Admin</span>
                        <i class="fas fa-chevron-right text-slate-600 text-xs"></i>
                        <span class="text-slate-300 font-medium">@yield('page-title', 'Dashboard')</span>
                    </nav>
                </div>
                
                <div class="flex items-center space-x-4">
                    <!-- User Info -->
                    <div class="flex items-center space-x-3">
                        <div class="text-right">
                            <p class="text-sm font-medium text-slate-200">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-slate-400">Administrator</p>
                        </div>
                        <div class="user-avatar">
                            <i class="fas fa-user text-white text-sm"></i>
                        </div>
                    </div>
                    
                    <!-- Logout -->
                    <form action="{{ route('admin.logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="btn-primary text-white px-4 py-2 rounded-lg text-sm flex items-center space-x-2">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Logout</span>
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

    @stack('scripts')
</body>
</html>
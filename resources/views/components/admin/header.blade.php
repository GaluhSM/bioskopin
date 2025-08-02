<header class="header sticky top-0 z-40">
    <div class="flex items-center justify-between px-6 py-4">
        <div class="flex items-center space-x-4">
            <nav class="flex items-center space-x-2 text-sm">
                <i class="fas fa-home text-slate-400"></i>
                <span class="text-slate-500">Admin</span>
                <i class="fas fa-chevron-right text-slate-600 text-xs"></i>
                <span class="text-slate-300 font-medium">{{ $pageTitle }}</span>
            </nav>
        </div>
        
        <div class="flex items-center space-x-4">
            <div class="flex items-center space-x-3">
                <div class="text-right">
                    <p class="text-sm font-medium text-slate-200">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-slate-400">Administrator</p>
                </div>
                <div class="user-avatar">
                    <i class="fas fa-user text-white text-sm"></i>
                </div>
            </div>
            
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
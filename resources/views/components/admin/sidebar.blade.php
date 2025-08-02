<div class="fixed inset-y-0 left-0 z-50 w-64 sidebar">
    <div class="flex items-center justify-center h-20 border-b border-slate-700">
        <div class="text-center">
            <h1 class="text-white text-xl font-bold flex items-center">
                <div class="w-10 h-10 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-lg flex items-center justify-center mr-3">
                    <i class="fas fa-crown text-white"></i>
                </div>
                Panel Admin
            </h1>
            <p class="text-slate-400 text-xs mt-1">Manajemen Sistem Bioskopin</p>
        </div>
    </div>
    
    <nav class="mt-6 px-4">
        <div class="mb-8">
            <p class="text-slate-500 text-xs uppercase tracking-wide font-semibold mb-4 px-3">Ringkasan</p>
            
            <x-admin.nav-item 
                route="admin.dashboard" 
                icon="fas fa-chart-pie" 
                label="Dashboard" 
                iconBg="rgba(59, 130, 246, 0.2)"
                iconColor="text-blue-400" />
            
            <x-admin.nav-item 
                route="admin.qr-scanner" 
                icon="fas fa-qrcode" 
                label="QR Scanner" 
                iconBg="rgba(16, 185, 129, 0.2)"
                iconColor="text-green-400" />
        </div>
        
        <div>
            <p class="text-slate-500 text-xs uppercase tracking-wide font-semibold mb-4 px-3">Manajemen</p>
            
            <x-admin.nav-item 
                route="admin.movies.*" 
                href="{{ route('admin.movies.index') }}"
                icon="fas fa-film" 
                label="Movies" 
                iconBg="rgba(239, 68, 68, 0.2)"
                iconColor="text-red-400" />
            
            <x-admin.nav-item 
                route="admin.cinemas.*" 
                href="{{ route('admin.cinemas.index') }}"
                icon="fas fa-building" 
                label="Cinemas" 
                iconBg="rgba(139, 92, 246, 0.2)"
                iconColor="text-purple-400" />
            
            <x-admin.nav-item 
                route="admin.studios.*" 
                href="{{ route('admin.studios.index') }}"
                icon="fas fa-door-open" 
                label="Studios" 
                iconBg="rgba(6, 182, 212, 0.2)"
                iconColor="text-cyan-400" />
            
            <x-admin.nav-item 
                route="admin.schedules.*" 
                href="{{ route('admin.schedules.index') }}"
                icon="fas fa-calendar" 
                label="Schedules" 
                iconBg="rgba(245, 158, 11, 0.2)"
                iconColor="text-amber-400" />
            
            <x-admin.nav-item 
                route="admin.bookings.*" 
                href="{{ route('admin.bookings.index') }}"
                icon="fas fa-ticket-alt" 
                label="Bookings" 
                iconBg="rgba(236, 72, 153, 0.2)"
                iconColor="text-pink-400" />
        </div>
    </nav>
</div>
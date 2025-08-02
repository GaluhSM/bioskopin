<!DOCTYPE html>
<html lang="en">
<x-layout.head :title="$title ?? 'Dashboard Admin - Bioskopin'">
    <x-slot name="styles">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <style>
            body {
                background: #0f172a;
                color: #e2e8f0;
                font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
                overflow-x: hidden;
            }
            
            .sidebar {
                background: linear-gradient(180deg, #1e293b 0%, #0f172a 100%);
                border-right: 1px solid #334155;
                box-shadow: 4px 0 15px rgba(0, 0, 0, 0.1);
            }
            
            .nav-item {
                position: relative;
                transition: all 0.2s ease;
                margin-bottom: 4px;
            }
            
            .nav-item:hover {
                background: rgba(51, 65, 85, 0.5);
                transform: translateX(4px);
            }
            
            .nav-item.active {
                background: rgba(59, 130, 246, 0.15);
                border-left: 3px solid #3b82f6;
                box-shadow: 0 4px 8px rgba(59, 130, 246, 0.15);
            }
            
            .nav-icon {
                width: 40px;
                height: 40px;
                border-radius: 8px;
                display: flex;
                align-items: center;
                justify-content: center;
                background: var(--icon-bg, rgba(75, 85, 99, 0.5));
                transition: all 0.2s ease;
            }
            
            .nav-item:hover .nav-icon {
                transform: scale(1.05);
            }
            
            .header {
                background: rgba(15, 23, 42, 0.95);
                backdrop-filter: blur(10px);
                border-bottom: 1px solid #334155;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            }
            
            .user-avatar {
                width: 40px;
                height: 40px;
                border-radius: 10px;
                background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
                display: flex;
                align-items: center;
                justify-content: center;
                transition: all 0.2s ease;
            }
            
            .user-avatar:hover {
                transform: scale(1.05);
                box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
            }
            
            .btn-primary {
                background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
                border: none;
                transition: all 0.2s ease;
                box-shadow: 0 2px 8px rgba(220, 38, 38, 0.2);
            }
            
            .btn-primary:hover {
                background: linear-gradient(135deg, #b91c1c 0%, #991b1b 100%);
                transform: translateY(-1px);
                box-shadow: 0 4px 15px rgba(220, 38, 38, 0.3);
            }
            
            .main-content {
                background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
                min-height: 100vh;
                position: relative;
            }
            
            .main-content::before {
                content: '';
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: radial-gradient(circle at 20% 80%, rgba(59, 130, 246, 0.05) 0%, transparent 50%),
                            radial-gradient(circle at 80% 20%, rgba(139, 92, 246, 0.05) 0%, transparent 50%);
                pointer-events: none;
                z-index: 0;
            }
            
            .content-wrapper {
                position: relative;
                z-index: 1;
            }
            
            /* Custom scrollbar */
            ::-webkit-scrollbar {
                width: 8px;
            }
            
            ::-webkit-scrollbar-track {
                background: #1f2937;
            }
            
            ::-webkit-scrollbar-thumb {
                background: #4b5563;
                border-radius: 4px;
            }
            
            ::-webkit-scrollbar-thumb:hover {
                background: #6b7280;
            }
            
            /* Animation utilities */
            .fade-in {
                animation: fadeIn 0.5s ease-in;
            }
            
            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(20px); }
                to { opacity: 1; transform: translateY(0); }
            }
            
            .slide-in {
                animation: slideIn 0.3s ease-out;
            }
            
            @keyframes slideIn {
                from { opacity: 0; transform: translateX(-20px); }
                to { opacity: 1; transform: translateX(0); }
            }
            
            /* Loading spinner */
            .spinner {
                border: 2px solid #374151;
                border-top: 2px solid #3b82f6;
                border-radius: 50%;
                width: 20px;
                height: 20px;
                animation: spin 1s linear infinite;
            }
            
            @keyframes spin {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }
        </style>
        {{ $styles ?? '' }}
    </x-slot>
</x-layout.head>

<x-layout.body>
    <div class="flex min-h-screen">
        <x-admin.sidebar />

        <div class="flex-1 ml-64 main-content">
            <div class="content-wrapper">
                <x-admin.header :pageTitle="$pageTitle ?? 'Dashboard'" />

                <main class="p-6 fade-in">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </div>

    <!-- Global notification container -->
    <div id="notification-container" class="fixed top-4 right-4 z-50 space-y-3"></div>

    <!-- Global scripts -->
    <script>
        // Global notification function
        window.showNotification = function(message, type = 'info', options = {}) {
            const container = document.getElementById('notification-container');
            const id = 'notification-' + Date.now();
            
            const notification = document.createElement('div');
            notification.className = `notification ${getNotificationClass(type)} text-white px-4 py-3 rounded-lg shadow-lg border-l-4 transform translate-x-full`;
            notification.id = id;
            
            notification.innerHTML = `
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <i class="${getNotificationIcon(type)} mr-3"></i>
                        <div>
                            ${options.title ? `<h4 class="font-semibold">${options.title}</h4>` : ''}
                            <p class="${options.title ? 'text-sm' : ''}">${message}</p>
                        </div>
                    </div>
                    <button onclick="removeNotification('${id}')" 
                            class="ml-4 text-white hover:text-gray-200 transition-colors p-1 hover:bg-white/20 rounded">
                        <i class="fas fa-times text-sm"></i>
                    </button>
                </div>
            `;
            
            container.appendChild(notification);
            
            // Animate in
            setTimeout(() => {
                notification.style.transform = 'translateX(0)';
            }, 50);
            
            // Auto hide
            if (options.autoHide !== false) {
                setTimeout(() => {
                    removeNotification(id);
                }, options.duration || 5000);
            }
            
            return id;
        };
        
        window.removeNotification = function(id) {
            const notification = document.getElementById(id);
            if (notification) {
                notification.style.transform = 'translateX(100%)';
                notification.style.opacity = '0';
                setTimeout(() => notification.remove(), 300);
            }
        };
        
        function getNotificationClass(type) {
            const classes = {
                success: 'bg-green-600 border-green-500',
                error: 'bg-red-600 border-red-500',
                warning: 'bg-yellow-600 border-yellow-500',
                info: 'bg-blue-600 border-blue-500'
            };
            return classes[type] || classes.info;
        }
        
        function getNotificationIcon(type) {
            const icons = {
                success: 'fas fa-check-circle',
                error: 'fas fa-exclamation-circle',
                warning: 'fas fa-exclamation-triangle',
                info: 'fas fa-info-circle'
            };
            return icons[type] || icons.info;
        }
        
        // Show Laravel session messages
        @if(session('success'))
            showNotification('{{ session('success') }}', 'success');
        @endif
        
        @if(session('error'))
            showNotification('{{ session('error') }}', 'error');
        @endif
        
        @if(session('warning'))
            showNotification('{{ session('warning') }}', 'warning');
        @endif
        
        @if(session('info'))
            showNotification('{{ session('info') }}', 'info');
        @endif
        
        // Loading states
        window.showLoading = function(element) {
            const originalContent = element.innerHTML;
            element.innerHTML = '<div class="spinner inline-block mr-2"></div>Loading...';
            element.disabled = true;
            return originalContent;
        };
        
        window.hideLoading = function(element, originalContent) {
            element.innerHTML = originalContent;
            element.disabled = false;
        };
        
        // Confirm dialogs
        window.confirmAction = function(message, callback) {
            if (confirm(message)) {
                callback();
            }
        };
    </script>

    {{ $scripts ?? '' }}
</x-layout.body>
</html>
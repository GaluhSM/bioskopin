<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard Admin - Bioskopin' }}</title>
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
    {{ $styles ?? '' }}
</head>
<body>
    <x-admin.sidebar />

    <div class="ml-64">
        <x-admin.header :pageTitle="$pageTitle ?? 'Dashboard'" />

        <main class="p-6">
            {{ $slot }}
        </main>
    </div>

    {{ $scripts ?? '' }}
</body>
</html>
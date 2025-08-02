<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Bioskopin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-gray-900 via-blue-900 to-gray-900 min-h-screen flex items-center justify-center">
    <div class="absolute inset-0 bg-black opacity-50"></div>
    
    <div class="relative z-10 w-full max-w-md px-6">
        <x-auth.header />

        <x-auth.login-form />

        <x-auth.back-link />
    </div>

    <x-auth.scripts />
</body>
</html>
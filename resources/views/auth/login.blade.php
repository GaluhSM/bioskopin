<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - CinemaTicket</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-gray-900 via-blue-900 to-gray-900 min-h-screen flex items-center justify-center">
    <div class="absolute inset-0 bg-black opacity-50"></div>
    
    <div class="relative z-10 w-full max-w-md px-6">
        <!-- Logo/Header -->
        <div class="text-center mb-8">
            <div class="bg-blue-600 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                <i class="fas fa-shield-alt text-2xl text-white"></i>
            </div>
            <h1 class="text-3xl font-bold text-white mb-2">Admin Login</h1>
            <p class="text-gray-300">Access the cinema management system</p>
        </div>

        <!-- Login Form -->
        <div class="bg-white/10 backdrop-blur-md rounded-2xl p-8 shadow-2xl border border-white/20">
            <form method="POST" action="{{ route('admin.login') }}">
                @csrf
                
                <!-- Email -->
                <div class="mb-6">
                    <label for="email" class="block text-white text-sm font-medium mb-2">
                        <i class="fas fa-envelope mr-2"></i>Email Address
                    </label>
                    <input type="email" 
                           name="email" 
                           id="email"
                           value="{{ old('email') }}"
                           class="w-full px-4 py-3 bg-white/20 backdrop-blur-sm text-white placeholder-gray-300 rounded-lg border border-white/30 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                           placeholder="Enter your email"
                           required>
                    @error('email')
                        <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-6">
                    <label for="password" class="block text-white text-sm font-medium mb-2">
                        <i class="fas fa-lock mr-2"></i>Password
                    </label>
                    <div class="relative">
                        <input type="password" 
                               name="password" 
                               id="password"
                               class="w-full px-4 py-3 bg-white/20 backdrop-blur-sm text-white placeholder-gray-300 rounded-lg border border-white/30 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent pr-12"
                               placeholder="Enter your password"
                               required>
                        <button type="button" 
                                onclick="togglePassword()"
                                class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-300 hover:text-white">
                            <i class="fas fa-eye" id="toggleIcon"></i>
                        </button>
                    </div>
                    @error('password')
                        <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="flex items-center mb-6">
                    <input type="checkbox" 
                           name="remember" 
                           id="remember"
                           class="w-4 h-4 text-blue-600 bg-white/20 border-white/30 rounded focus:ring-blue-500 focus:ring-2">
                    <label for="remember" class="ml-2 text-sm text-gray-300">
                        Remember me
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit" 
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg transition-colors duration-200 shadow-lg">
                    <i class="fas fa-sign-in-alt mr-2"></i>Sign In
                </button>
            </form>
        </div>

        <!-- Back to Home -->
        <div class="text-center mt-6">
            <a href="{{ route('home') }}" class="text-gray-300 hover:text-white text-sm transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>Back to Website
            </a>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>
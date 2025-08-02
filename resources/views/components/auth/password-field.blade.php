<div class="mb-6">
    <label for="password" class="block text-white text-sm font-medium mb-2">
        <i class="fas fa-lock mr-2"></i>Kata Sandi
    </label>
    <div class="relative">
        <input type="password" 
               name="password" 
               id="password"
               class="w-full px-4 py-3 bg-white/20 backdrop-blur-sm text-white placeholder-gray-300 rounded-lg border border-white/30 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent pr-12"
               placeholder="Masukkan Kata Sandi Anda"
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
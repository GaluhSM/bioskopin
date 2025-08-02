<div class="space-y-4 mb-6">
    <div>
        <label for="customer_name" class="block text-sm font-medium text-white mb-2">
            Nama Lengkap <span class="text-red-500">*</span>
        </label>
        <input type="text" name="customer_name" id="customer_name" 
               value="{{ old('customer_name') }}"
               class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
               placeholder="Masukkan nama lengkapmu" required>
        @error('customer_name')
            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>
    
    <div>
        <label for="customer_phone" class="block text-sm font-medium text-white mb-2">
            Nomor HP <span class="text-red-500">*</span>
        </label>
        <input type="tel" name="customer_phone" id="customer_phone" 
               value="{{ old('customer_phone') }}"
               class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
               placeholder="Contoh: 08123456789" required>
        @error('customer_phone')
            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>
</div>
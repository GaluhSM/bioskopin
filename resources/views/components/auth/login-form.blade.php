<div class="bg-white/10 backdrop-blur-md rounded-2xl p-8 shadow-2xl border border-white/20">
    <form method="POST" action="{{ route('admin.login') }}">
        @csrf
        
        <x-auth.form-field 
            type="email" 
            name="email" 
            label="Email Address" 
            icon="fas fa-envelope"
            placeholder="Masukkan email Anda"
            :value="old('email')"
            required />

        <x-auth.password-field />

        <x-auth.remember-checkbox />

        <button type="submit" 
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg transition-colors duration-200 shadow-lg">
            <i class="fas fa-sign-in-alt mr-2"></i>Masuk
        </button>
    </form>
</div>
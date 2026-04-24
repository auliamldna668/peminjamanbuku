<x-guest-layout>
    <style>
        body {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #0f172a 100%) !important;
            min-height: 100vh;
            font-family: 'Georgia', serif;
        }
        .input-field {
            width: 100%;
            background: #0f172a !important;
            border: 1px solid #334155 !important;
            border-radius: 10px !important;
            padding: 12px 14px !important;
            color: #f1f5f9 !important;
            font-size: 14px;
            transition: all .2s;
            box-sizing: border-box;
        }
        .input-field:focus {
            outline: none !important;
            border-color: #f59e0b !important;
            box-shadow: 0 0 0 3px rgba(245,158,11,0.2) !important;
        }
        .input-label {
            color: #94a3b8;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 1px;
            display: block;
            margin-bottom: 6px;
        }
        .btn-gold {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: #0f172a;
            border: none;
            border-radius: 10px;
            padding: 12px 28px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: all .2s;
            letter-spacing: .5px;
        }
        .btn-gold:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(245,158,11,0.4);
        }
        @keyframes slideUp {
            from { opacity:0; transform:translateY(20px); }
            to   { opacity:1; transform:translateY(0); }
        }
    </style>

    <!-- Header -->
    <div class="text-center mb-8">
        <div style="font-size:40px; margin-bottom:8px;">✍️</div>
        <h1 style="color:#f59e0b; font-size:24px; font-weight:700; letter-spacing:1px; margin:0;">
            DAFTAR ANGGOTA
        </h1>
        <p style="color:#64748b; font-size:13px; margin-top:6px;">
            Buat akun baru sebagai anggota perpustakaan
        </p>
    </div>

    <form method="POST" action="{{ route('register') }}" style="animation: slideUp .5s ease;">
        @csrf

        <!-- Name -->
        <div class="mb-4">
            <label for="name" class="input-label">NAMA LENGKAP</label>
            <input id="name" type="text" name="name"
                   value="{{ old('name') }}"
                   class="input-field"
                   placeholder="Nama lengkap Anda"
                   required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label for="email" class="input-label">EMAIL</label>
            <input id="email" type="email" name="email"
                   value="{{ old('email') }}"
                   class="input-field"
                   placeholder="email@example.com"
                   required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mb-4" style="position:relative;">
            <label for="password" class="input-label">PASSWORD</label>
            <input id="password" type="password" name="password"
                   class="input-field" style="padding-right:44px;"
                   placeholder="Min. 8 karakter"
                   required autocomplete="new-password" />
            <button type="button" onclick="togglePass('password', this)"
                style="position:absolute; right:12px; top:34px; background:none; border:none; color:#64748b; cursor:pointer; font-size:16px;">
                👁️
            </button>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mb-6" style="position:relative;">
            <label for="password_confirmation" class="input-label">KONFIRMASI PASSWORD</label>
            <input id="password_confirmation" type="password" name="password_confirmation"
                   class="input-field" style="padding-right:44px;"
                   placeholder="Ulangi password"
                   required autocomplete="new-password" />
            <button type="button" onclick="togglePass('password_confirmation', this)"
                style="position:absolute; right:12px; top:34px; background:none; border:none; color:#64748b; cursor:pointer; font-size:16px;">
                👁️
            </button>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Actions -->
        <div style="display:flex; align-items:center; justify-content:space-between;">
            <a href="{{ route('login') }}"
               style="color:#f59e0b; font-size:13px; text-decoration:none; font-weight:500;">
                Sudah punya akun?
            </a>

            <button type="submit" class="btn-gold">Daftar →</button>
        </div>
    </form>

    <script>
        function togglePass(fieldId, btn) {
            const input = document.getElementById(fieldId);
            if (input.type === 'password') {
                input.type = 'text';
                btn.textContent = '🙈';
            } else {
                input.type = 'password';
                btn.textContent = '👁️';
            }
        }
    </script>
</x-guest-layout>
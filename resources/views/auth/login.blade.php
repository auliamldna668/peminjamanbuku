<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Style -->
    <style>
        body {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #0f172a 100%) !important;
            min-height: 100vh;
            font-family: 'Georgia', serif;
        }
        .auth-card {
            background: #1e293b !important;
            border: 1px solid #334155 !important;
            border-radius: 24px !important;
            box-shadow: 0 32px 80px rgba(0,0,0,0.6) !important;
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
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        .icon-float { animation: float 3s ease-in-out infinite; }
        .circle {
            position: absolute;
            border-radius: 50%;
            border: 1px solid rgba(245,158,11,0.08);
            top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            pointer-events: none;
        }
    </style>

    <!-- Decorative Circles -->
    <div class="circle" style="width:200px;height:200px"></div>
    <div class="circle" style="width:320px;height:320px"></div>
    <div class="circle" style="width:440px;height:440px"></div>
    <div class="circle" style="width:560px;height:560px"></div>

    <!-- Header -->
    <div class="text-center mb-8">
        <div class="text-5xl mb-2 icon-float">📚</div>
        <h1 style="color:#f59e0b; font-size:26px; font-weight:700; letter-spacing:1px; margin:0;">
            PERPUSTAKAAN
        </h1>
        <p style="color:#64748b; font-size:13px; margin-top:6px;">
            Sistem Manajemen Perpustakaan Digital
        </p>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email -->
        <div class="mb-4">
            <label for="email" class="input-label">EMAIL</label>
            <input id="email" type="email" name="email"
                   value="{{ old('email') }}"
                   class="input-field"
                   placeholder="email@example.com"
                   required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mb-4" style="position:relative;">
            <label for="password" class="input-label">PASSWORD</label>
            <input id="password" type="password" name="password"
                   class="input-field" style="padding-right:44px;"
                   placeholder="••••••••"
                   required autocomplete="current-password" />
            <!-- Toggle show/hide password -->
            <button type="button" onclick="togglePassword()"
                style="position:absolute; right:12px; top:34px; background:none; border:none; color:#64748b; cursor:pointer; font-size:16px;">
                👁️
            </button>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="mb-6">
            <label for="remember_me" style="display:flex; align-items:center; gap:8px; cursor:pointer;">
                <input id="remember_me" type="checkbox" name="remember"
                       style="width:16px; height:16px; accent-color:#f59e0b; cursor:pointer;" />
                <span style="color:#64748b; font-size:13px;">Ingat saya</span>
            </label>
        </div>

        <!-- Actions -->
        <div style="display:flex; align-items:center; justify-content:space-between;">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}"
                   style="color:#f59e0b; font-size:13px; text-decoration:none; font-weight:500;">
                    Lupa password?
                </a>
            @endif

            <button type="submit" class="btn-gold">Masuk →</button>
        </div>

        <!-- Register link -->
        <p style="color:#64748b; text-align:center; margin-top:20px; font-size:13px;">
            Belum punya akun?
            <a href="{{ route('register') }}"
               style="color:#f59e0b; font-weight:600; text-decoration:none;">
                Daftar di sini
            </a>
        </p>
    </form>

    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            const btn = input.nextElementSibling;
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
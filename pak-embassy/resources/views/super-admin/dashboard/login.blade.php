<link rel="icon" href="{{ asset('images/favicon-ion.png') }}" type="image/x-icon">
<form method="POST" action="{{ route('dashboard.signin') }}" aria-label="{{ __('Login') }}" 
      style="max-width: 400px; margin: 40px auto; padding: 30px; border-radius: 12px; box-shadow: 0px 4px 15px rgba(0,0,0,0.1); background-color: #ffffff; font-family: Arial, sans-serif;">
    @csrf

    <div style="text-align: center; margin-bottom: 20px;">
        <img src="{{ asset('img/embassy-logo.svg') }}" height="60" alt="logo" style="margin-bottom: 15px;">
        <h1 style="font-size: 26px; font-weight: 600; color: #333;">Sign In</h1>
    </div>

    <div style="width: 100%;">
        {{-- Email --}}
        <div style="margin-bottom: 15px;">
            <input required type="email" name="email" id="email" 
                   placeholder="Email"
                   value="{{ old('email') }}"
                   style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 8px; font-size: 15px; outline: none;" 
                   autofocus>
        </div>

        {{-- Password --}}
        <div style="margin-bottom: 15px; position: relative;">
            <input required type="password" name="password" id="password" 
                   placeholder="Password"
                   autocomplete="new-password"
                   style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 8px; font-size: 15px; outline: none;">
        </div>

        {{-- Error Messages --}}
        @if ($errors->any())
            <div style="background-color: #f8d7da; color: #842029; border: 1px solid #f5c2c7; padding: 12px; border-radius: 8px; margin-bottom: 15px;">
                <ul style="margin: 0; padding-left: 20px; text-align: left;">
                    @foreach ($errors->all() as $error)
                        <li style="font-size: 14px;">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Login Button --}}
        <button type="submit" 
                style="width: 100%; padding: 12px; background-color: #198754; color: white; font-size: 16px; font-weight: bold; border: none; border-radius: 8px; cursor: pointer; transition: 0.3s;">
            Login
        </button>

        {{-- Forgot Password --}}
        <div style="text-align: right; margin-top: 12px;">
            <span id="forgot-password" onclick="" 
                  style="cursor: pointer; color: #dc3545; font-size: 14px; font-weight: 500;">
                Forgot Password?
            </span>
        </div>
    </div>
</form>
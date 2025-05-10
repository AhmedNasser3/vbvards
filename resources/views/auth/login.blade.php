@extends('frontend.master')
@section('content')

<style>
    body {
        background-color: #0d1624;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: #fff;
    }

    .login-wrapper {
        max-width: 420px;
        margin: 80px auto;
        background-color: #0d1624;
        border: 1.5px solid #25BA84;
        border-radius: 16px;
        padding: 40px 35px;
        box-shadow: 0 0 20px rgba(37, 186, 132, 0.15);
        animation: fadeIn 1s ease;
        position: relative;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(40px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .login-logo {
        text-align: center;
        margin-bottom: 25px;
        animation: popIn 0.8s ease;
    }

    @keyframes popIn {
        0% { transform: scale(0.8); opacity: 0; }
        100% { transform: scale(1); opacity: 1; }
    }

    .login-logo img {
        width: 90px;
    }

    .login-title {
        text-align: center;
        font-size: 26px;
        font-weight: bold;
        margin-bottom: 25px;
        color: #fff;
    }

    .input-group {
        margin-bottom: 22px;
        transition: all 0.3s ease;
    }

    label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #fff;
    }

    input[type="email"],
    input[type="password"] {
        width: 100%;
        padding: 12px;
        border-radius: 10px;
        background-color: #0d1624;
        border: 1px solid #25BA84;
        color: #fff;
        font-size: 15px;
        outline: none;
        transition: all 0.3s ease;
    }

    input[type="email"]:focus,
    input[type="password"]:focus {
        box-shadow: 0 0 8px #25BA84;
        transform: scale(1.02);
    }

    .checkbox-wrap {
        display: flex;
        align-items: center;
        margin-bottom: 18px;
    }

    .checkbox-wrap input[type="checkbox"] {
        width: 14px;
        height: 14px;
        accent-color: #25BA84;
        margin-right: 8px;
        transform: scale(0.9);
    }

    .checkbox-wrap label {
        margin: 0;
        font-size: 14px;
    }

    .forgot-password {
        text-align: right;
        margin-bottom: 20px;
    }

    .forgot-password a {
        font-size: 13px;
        color: #25BA84;
        text-decoration: none;
    }

    .forgot-password a:hover {
        text-decoration: underline;
    }

    .login-button {
        width: 100%;
        padding: 12px;
        background-color: #25BA84;
        border: none;
        color: #fff;
        font-size: 16px;
        font-weight: bold;
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .login-button:hover {
        background-color: #1a9468;
        transform: scale(1.01);
        box-shadow: 0 0 10px rgba(37, 186, 132, 0.5);
    }

    .message-box {
        margin-bottom: 15px;
        font-size: 14px;
        padding: 10px;
        border-radius: 8px;
    }

    .success-message {
        color: #25BA84;
    }

    .error-message ul {
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .error-message li {
        margin-bottom: 5px;
        color: #f88;
    }
</style>

<div class="login-wrapper">
    <div class="login-logo">
        <img src="{{ asset('assets/imgs/شعار_2.png') }}" alt="Logo">
    </div>

    <div class="login-title">تسجيل الدخول</div>

    @if (session('status'))
        <div class="message-box success-message">
            {{ session('status') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="message-box error-message">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" id="loginForm">
        @csrf

        <div class="input-group">
            <label for="email">البريد الإلكتروني</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
        </div>

        <div class="input-group">
            <label for="password">كلمة المرور</label>
            <input type="password" id="password" name="password" required>
        </div>

        <div class="checkbox-wrap">
            <input type="checkbox" name="remember" id="remember">
            <label for="remember">تذكرني</label>
        </div>

        <div class="forgot-password">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}">هل نسيت كلمة المرور؟</a>
            @endif
        </div>

        <button type="submit" class="login-button">تسجيل الدخول</button>
    </form>
    <div style="display: grid;justify-content:center;margin:10px 0 0 0 ">
        <div class="switch-login">
            <span>ليس لديك حساب؟ <a href="{{ route('register') }}">حساب جديد من هنا</a></span>
        </div>
    </div>
</div>

<script>
    // أنيميشن فوري عند الكتابة في الحقول
    const inputs = document.querySelectorAll('input[type="email"], input[type="password"]');
    inputs.forEach(input => {
        input.addEventListener('input', () => {
            input.style.borderColor = '#25BA84';
        });
    });

    // عند إرسال الفورم، نضيف أنيميشن تحميل أو نمنع الضغط المتكرر
    const form = document.getElementById('loginForm');
    const submitButton = form.querySelector('button');
    form.addEventListener('submit', () => {
        submitButton.disabled = true;
        submitButton.innerText = 'جاري التحقق...';
    });
</script>

@endsection

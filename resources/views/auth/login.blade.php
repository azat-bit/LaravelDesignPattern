<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Giriş Yap</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            background: linear-gradient(120deg, #3498db, #8e44ad);
            font-family: 'Segoe UI', sans-serif;
            display: flex;
            height: 100vh;
            justify-content: center;
            align-items: center;
        }
        .login-box {
            background: white;
            padding: 40px;
            border-radius: 12px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            text-align: center;
        }
        .login-box h2 {
            margin-bottom: 20px;
        }
        .login-box input {
            width: 100%;
            padding: 12px;
            margin-bottom: 14px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
        .login-box button {
            width: 100%;
            padding: 12px;
            background-color: #3498db;
            border: none;
            color: white;
            font-weight: bold;
            border-radius: 6px;
            cursor: pointer;
        }
        .error-message, .success-message {
            margin-top: 10px;
            padding: 10px;
            border-radius: 6px;
            font-size: 14px;
        }
        .error-message {
            background: #ffe0e0;
            color: #b10000;
        }
        .success-message {
            background: #e0ffe0;
            color: #008000;
        }
        .login-box .register-link {
            margin-top: 16px;
            display: block;
            font-size: 14px;
        }
        .login-box .register-link a {
            color: #8e44ad;
            text-decoration: none;
        }
        .login-box .register-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="login-box">
    <h2>Giriş Yap</h2>

    <div id="login-message"></div>

    <form id="login-form">
        @csrf
        <input type="email" name="email" placeholder="E-posta" required>
        <input type="password" name="password" placeholder="Şifre" required>
        <button type="submit">Giriş Yap</button>
    </form>

    <div class="register-link">
        Henüz hesabınız yok mu? <a href="{{ route('register.form') }}">Kayıt Ol</a>
    </div>
</div>

<script>
document.getElementById('login-form').addEventListener('submit', async function (e) {
    e.preventDefault();

    const form = e.target;
    const formData = new FormData(form);
    const messageBox = document.getElementById('login-message');

    messageBox.innerHTML = '';

    const response = await fetch("{{ route('login') }}", {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': form.querySelector('[name="_token"]').value,
            'Accept': 'application/json'
        },
        body: formData
    });

    const result = await response.json();

    if (response.ok) {
        messageBox.innerHTML = '<div class="success-message">Giriş başarılı. Yönlendiriliyorsunuz...</div>';
        setTimeout(() => {
window.location.href = "{{ route('dashboard') }}";        }, 1500);
    } else {
        const errorMsg = result?.message ?? Object.values(result.errors)[0][0];
        messageBox.innerHTML = '<div class="error-message">' + errorMsg + '</div>';
    }
});
</script>

</body>
</html>

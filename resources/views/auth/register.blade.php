<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Kayıt Ol</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            background: linear-gradient(120deg, #27ae60, #2980b9);
            font-family: 'Segoe UI', sans-serif;
            display: flex;
            height: 100vh;
            justify-content: center;
            align-items: center;
        }
        .register-box {
            background: white;
            padding: 40px;
            border-radius: 12px;
            width: 100%;
            max-width: 450px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        .register-box h2 {
            margin-bottom: 20px;
            text-align: center;
        }
        .register-box input {
            width: 100%;
            padding: 12px;
            margin-bottom: 14px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
        .register-box button {
            width: 100%;
            padding: 12px;
            background-color: #27ae60;
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
    </style>
</head>
<body>

<div class="register-box">
    <h2>Kayıt Ol</h2>

    <div id="register-message"></div>

    <form id="register-form">
        @csrf
        <input type="text" name="name" placeholder="İsim" required>
        <input type="email" name="email" placeholder="E-posta" required>
        <input type="password" name="password" placeholder="Şifre" required>
        <input type="password" name="password_confirmation" placeholder="Şifre Tekrar" required>

        <button type="submit">Kayıt Ol</button>
    </form>
</div>

<script>
document.getElementById('register-form').addEventListener('submit', async function (e) {
    e.preventDefault();

    const form = e.target;
    const formData = new FormData(form);
    const messageBox = document.getElementById('register-message');

    messageBox.innerHTML = '';

    const response = await fetch("{{ route('register') }}", {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': form.querySelector('[name="_token"]').value,
            'Accept': 'application/json'
        },
        body: formData
    });

    const result = await response.json();

    if (response.ok) {
        messageBox.innerHTML = '<div class="success-message">' + result.message + '</div>';
        setTimeout(() => {
            window.location.href = "{{ route('login.form') }}";
        }, 2000);
    } else {
        const errorMsg = result?.message ?? Object.values(result.errors)[0][0];
        messageBox.innerHTML = '<div class="error-message">' + errorMsg + '</div>';
    }
});
</script>

</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Login - KostKu Admin</title>
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-container {
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.3);
            width: 90%;
            max-width: 400px;
            text-align: center;
            animation: slideUp 0.5s ease;
        }
        .logo-circle {
            width: 100px; height: 100px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 50%;
            margin: 0 auto 20px;
            display: flex; align-items: center; justify-content: center;
            font-size: 50px; color: white; box-shadow: 0 5px 20px rgba(102,126,234,0.4);
        }
        h1 { font-size: 28px; color: #2c3e50; margin-bottom: 8px; }
        p.tagline { font-size: 14px; color: #7f8c8d; margin-bottom: 30px; }
        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }
        label { display: block; margin-bottom: 8px; color: #2c3e50; font-weight: 500; }
        input {
            width: 100%; padding: 12px; border: 1px solid #ddd;
            border-radius: 5px; font-size: 14px;
        }
        input:focus { outline: none; border-color: #3498db; box-shadow: 0 0 0 3px rgba(52,152,219,0.2); }
        .btn {
            width: 100%; padding: 12px; border: none; border-radius: 5px;
            background: #3498db; color: white; font-size: 16px; cursor: pointer;
        }
        .btn:hover { background: #2980b9; }
        .info { margin-top: 15px; font-size: 12px; color: #7f8c8d; }
        @keyframes slideUp {
            from { transform: translateY(50px); opacity: 0; }
            to   { transform: translateY(0); opacity: 1; }
        }
    </style>
</head>
<body>

<div class="login-container">
    <div class="logo-circle">🏠</div>
    <h1>KostKu Admin</h1>
    <p class="tagline">Sistem Manajemen Kostan</p>

    <form id="loginForm">
        <div class="form-group">
            <label>Username</label>
            <input type="text" id="username" placeholder="Masukkan username" required autofocus>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" id="password" placeholder="Masukkan password" required>
        </div>
        <button type="submit" class="btn">Login</button>
        <div class="info">Demo: <strong>admin / admin</strong></div>
    </form>
</div>

<script>
const isLogin = localStorage.getItem('isLoggedIn') === 'true';

// redirect hanya kalau benar-benar di halaman login
if (isLogin && window.location.pathname === '/') {
    window.location.href = '/home';
}

document.getElementById('loginForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const user = document.getElementById('username').value.trim();
    const pass = document.getElementById('password').value.trim();

    if (user === 'admin' && pass === 'admin') {
        localStorage.setItem('isLoggedIn', 'true');
        window.location.href = '/home';
    } else {
        alert('Username atau password salah!');
    }
});
</script>


</body>
</html>
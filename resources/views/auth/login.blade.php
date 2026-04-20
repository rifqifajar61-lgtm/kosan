<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — KostKu Admin</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root{
            --primary: #3b82f6;
            --primary-soft: #dbeafe;
            --text: #1e293b;
            --muted: #64748b;
            --border: #dbe2ea;
            --bg: #f8fafc;
        }

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            font-family:'Inter', sans-serif;
            background: linear-gradient(135deg, #eff6ff, #f8fafc);
            min-height:100vh;
            display:flex;
            align-items:center;
            justify-content:center;
            padding:20px;
        }

        .container{
            width:100%;
            max-width:380px;
            background:#fff;
            border:1px solid var(--border);
            border-radius:14px;
            overflow:hidden;
            box-shadow:0 8px 24px rgba(0,0,0,0.06);
        }

        .header{
            background: var(--primary-soft);
            padding:22px;
            text-align:center;
            border-bottom:1px solid var(--border);
        }

        .header .icon{
            font-size:32px;
            margin-bottom:8px;
        }

        .header h2{
            font-size:20px;
            color:var(--text);
            margin-bottom:4px;
        }

        .header p{
            font-size:13px;
            color:var(--muted);
        }

        .body{
            padding:24px;
        }

        .error{
            background:#fee2e2;
            color:#dc2626;
            padding:10px;
            border-radius:8px;
            margin-bottom:16px;
            font-size:13px;
        }

        .form-group{
            margin-bottom:16px;
        }

        label{
            display:block;
            margin-bottom:6px;
            font-size:13px;
            font-weight:600;
            color:var(--text);
        }

        input{
            width:100%;
            padding:11px 12px;
            border:1px solid var(--border);
            border-radius:8px;
            font-size:14px;
        }

        input:focus{
            outline:none;
            border-color:var(--primary);
            box-shadow:0 0 0 3px rgba(59,130,246,0.15);
        }

        button{
            width:100%;
            padding:11px;
            background:var(--primary);
            color:#fff;
            border:none;
            border-radius:8px;
            font-size:14px;
            font-weight:600;
            cursor:pointer;
            transition:.2s;
        }

        button:hover{
            background:#2563eb;
        }

        .footer{
            text-align:center;
            font-size:12px;
            color:var(--muted);
            margin-top:16px;
        }
    </style>
</head>
<body>

<div class="container">

    <div class="header">
        <div class="icon">🏠</div>
        <h2>KostKu Admin</h2>
        <p>Login Sistem Manajemen Kost</p>
    </div>

    <div class="body">

        @if ($errors->any())
            <div class="error">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.post') }}">
            @csrf

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email"
                       value="{{ old('email') }}"
                       placeholder="Masukkan email"
                       required autocomplete="email">
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password"
                       placeholder="Masukkan password"
                       required autocomplete="current-password">
            </div>

            <button type="submit">Masuk</button>
        </form>

    </div>

</div>

</body>
</html>
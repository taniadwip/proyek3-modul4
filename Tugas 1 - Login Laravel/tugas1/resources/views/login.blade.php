<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body { font-family: sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; background-color: #f7f7f7; }
        .card { background: #fff; padding: 2rem; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); width: 320px; }
        .error-box { background: #fde8e8; color: #9b1c1c; padding: 8px; border-radius: 4px; font-size: 13px; margin-bottom: 1rem; border: 1px solid #f8b4b4; }
        .form-group { margin-bottom: 1rem; }
        label { display: block; font-size: 14px; margin-bottom: 4px; font-weight: bold; }
        input { width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; }
        button { width: 100%; padding: 9px; background: #2563eb; color: #fff; border: none; border-radius: 4px; font-weight: bold; cursor: pointer; }
        button:hover { background: #1d4ed8; }
    </style>
</head>
<body>
    <div class="card">
        <h2 style="margin-top:0; margin-bottom: 4px;">Login</h2>
        <p style="color: #666; font-size: 13px; margin-top: 0; margin-bottom: 1rem;">Masuk untuk membuka dashboard</p>

        @if($errors->has('login'))
            <div class="error-box">
                {{ $errors->first('login') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" value="{{ old('username') }}" required autofocus>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Masuk</button>
        </form>
    </div>
</body>
</html>
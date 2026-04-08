<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST" action="{{ route('password.update') }}">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">

    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password baru" required>
    <input type="password" name="password_confirmation" placeholder="Konfirmasi password" required>

    <button type="submit">Reset Password</button>
</form>
</body>
</html>
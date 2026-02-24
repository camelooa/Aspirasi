<!DOCTYPE html>
<html>
<head>
    <title>Kode OTP Login</title>
</head>
<body style="font-family: sans-serif; padding: 20px;">
    <h2>Kode OTP Login Anda</h2>
    <p>Halo, {{ $username }}!</p>
    <p>Gunakan kode berikut untuk masuk ke akun Anda:</p>
    <h1 style="color: #2563eb; letter-spacing: 5px;">{{ $otp }}</h1>
    <p>Kode ini berlaku selama 5 menit.</p>
    <p>Jika Anda tidak merasa meminta kode ini, abaikan saja email ini.</p>
    <br>
    <p>Terima kasih,<br>Merdeka Aspirasi Team</p>
</body>
</html>

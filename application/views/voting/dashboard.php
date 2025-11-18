<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pemilih - E-Voting OSIS</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: #f8fafc;
            margin: 0;
            padding: 2rem;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 2rem;
        }
        .btn {
            background: #3b82f6;
            color: white;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            display: inline-block;
            margin: 0.5rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Dashboard Pemilih</h1>
            <p>Selamat datang, <?= $user_name ?>!</p>
        </div>
        
        <div style="text-align: center;">
            <p>Password Anda sudah berhasil diubah. Sistem voting akan segera tersedia.</p>
            <a href="<?= base_url('auth/logout') ?>" class="btn">Logout</a>
        </div>
    </div>
</body>
</html>
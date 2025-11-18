<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ganti Password - E-Voting OSIS</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #3b82f6, #8b5cf6);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        .container {
            width: 100%;
            max-width: 28rem;
            animation: scaleIn 0.5s ease-out;
        }

        .card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px -10px rgba(59, 130, 246, 0.2);
            padding: 2.5rem;
        }

        .header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .logo {
            width: 4rem;
            height: 4rem;
            border-radius: 50%;
            background: linear-gradient(135deg, #3b82f6, #8b5cf6);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            color: white;
            font-size: 2rem;
        }

        .title {
            font-size: 1.875rem;
            font-weight: bold;
            color: #1e293b;
            margin-bottom: 0.5rem;
        }

        .subtitle {
            color: #64748b;
            margin-bottom: 1rem;
        }

        .alert {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            background: #fef3c7;
            color: #92400e;
            border: 1px solid #fbbf24;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .label {
            display: block;
            font-size: 0.875rem;
            font-weight: 500;
            color: #1e293b;
            margin-bottom: 0.5rem;
        }

        .input {
            width: 100%;
            height: 3rem;
            padding: 0 1rem;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 0.875rem;
            transition: all 0.2s;
            background: white;
        }

        .input:focus {
            outline: none;
            border-color: #3b82f6;
            transform: scale(1.02);
        }

        .btn {
            width: 100%;
            height: 3rem;
            background: linear-gradient(135deg, #3b82f6, #8b5cf6);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: opacity 0.2s;
            margin-bottom: 1rem;
        }

        .btn:hover {
            opacity: 0.9;
        }

        .btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .loading {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255,255,255,.3);
            border-radius: 50%;
            border-top-color: #fff;
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        @keyframes scaleIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 1rem 1.5rem;
            border-radius: 8px;
            color: white;
            font-weight: 500;
            z-index: 9999;
            transform: translateX(400px);
            transition: transform 0.3s ease;
        }

        .notification.show {
            transform: translateX(0);
        }

        .notification.success {
            background: #10b981;
        }

        .notification.error {
            background: #ef4444;
        }

        .help-text {
            font-size: 0.75rem;
            color: #64748b;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="header">
                <div class="logo">🔒</div>
                <h1 class="title">Ganti Password</h1>
                <p class="subtitle">Untuk keamanan, Anda harus mengganti password default</p>
            </div>

            <div class="alert">
                <strong>Perhatian!</strong> Anda masih menggunakan password default "user123". Silakan ganti dengan password yang lebih aman.
            </div>

            <form id="changePasswordForm">
                <div class="form-group">
                    <label class="label" for="currentPassword">Password Lama</label>
                    <input type="password" id="currentPassword" name="current_password" class="input" placeholder="Masukkan password lama" required>
                </div>

                <div class="form-group">
                    <label class="label" for="newPassword">Password Baru</label>
                    <input type="password" id="newPassword" name="new_password" class="input" placeholder="Masukkan password baru (min. 6 karakter)" required>
                </div>

                <div class="form-group">
                    <label class="label" for="confirmPassword">Konfirmasi Password Baru</label>
                    <input type="password" id="confirmPassword" name="confirm_password" class="input" placeholder="Ulangi password baru" required>
                </div>

                <button type="submit" class="btn" id="changeBtn">
                    <span id="changeText">Ganti Password</span>
                    <span id="changeLoading" class="loading" style="display: none;"></span>
                </button>

                <p class="help-text">Password minimal 6 karakter untuk keamanan yang lebih baik</p>
            </form>
        </div>
    </div>

    <script>
        function showNotification(message, type = 'success') {
            const notification = document.createElement('div');
            notification.className = `notification ${type}`;
            notification.textContent = message;
            document.body.appendChild(notification);
            
            setTimeout(() => notification.classList.add('show'), 100);
            
            setTimeout(() => {
                notification.classList.remove('show');
                setTimeout(() => document.body.removeChild(notification), 300);
            }, 4000);
        }

        document.getElementById('changePasswordForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const changeBtn = document.getElementById('changeBtn');
            const changeText = document.getElementById('changeText');
            const changeLoading = document.getElementById('changeLoading');
            
            // Show loading
            changeBtn.disabled = true;
            changeText.style.display = 'none';
            changeLoading.style.display = 'inline-block';
            
            const formData = new FormData(this);
            
            fetch('<?= base_url('auth/update_password') ?>', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                showNotification(data.message, data.status);
                if (data.status === 'success') {
                    setTimeout(() => {
                        window.location.href = data.redirect;
                    }, 1500);
                }
            })
            .catch(() => {
                showNotification('Terjadi kesalahan sistem', 'error');
            })
            .finally(() => {
                changeBtn.disabled = false;
                changeText.style.display = 'inline';
                changeLoading.style.display = 'none';
            });
        });
    </script>
</body>
</html>
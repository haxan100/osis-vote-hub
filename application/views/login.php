<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Voting OSIS - Login</title>
    <style>
        :root {
            --primary: hsl(217, 91%, 60%);
            --secondary: hsl(271, 81%, 56%);
            --background: hsl(0, 0%, 100%);
            --foreground: hsl(222, 47%, 11%);
            --card: hsl(0, 0%, 100%);
            --muted: hsl(220, 13%, 95%);
            --muted-foreground: hsl(220, 9%, 46%);
            --border: hsl(220, 13%, 91%);
            --destructive: hsl(0, 84%, 60%);
            --success: hsl(142, 71%, 45%);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        .login-container {
            width: 100%;
            max-width: 28rem;
            animation: scaleIn 0.5s ease-out;
        }

        .login-card {
            background: var(--card);
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
            background: linear-gradient(135deg, var(--primary), var(--secondary));
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
            color: var(--foreground);
            margin-bottom: 0.5rem;
        }

        .subtitle {
            color: var(--muted-foreground);
        }

        .role-buttons {
            display: grid;
            gap: 0.75rem;
            margin-bottom: 1.5rem;
        }

        .role-btn {
            height: 3rem;
            border-radius: 12px;
            border: 2px solid var(--border);
            background: var(--background);
            color: var(--foreground);
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .role-btn:hover {
            transform: scale(1.02);
        }

        .role-btn.active {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border-color: transparent;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .label {
            display: block;
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--foreground);
            margin-bottom: 0.5rem;
        }

        .input {
            width: 100%;
            height: 3rem;
            padding: 0 1rem;
            border: 2px solid var(--border);
            border-radius: 12px;
            font-size: 0.875rem;
            transition: all 0.2s;
            background: var(--background);
        }

        .input:focus {
            outline: none;
            border-color: var(--primary);
            transform: scale(1.02);
        }

        .login-btn {
            width: 100%;
            height: 3rem;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: opacity 0.2s;
            margin-bottom: 1rem;
        }

        .login-btn:hover {
            opacity: 0.9;
        }

        .login-btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .help-text {
            font-size: 0.75rem;
            color: var(--muted-foreground);
            text-align: center;
        }

        .alert {
            padding: 0.75rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            font-size: 0.875rem;
        }

        .alert-error {
            background: rgba(239, 68, 68, 0.1);
            color: var(--destructive);
            border: 1px solid rgba(239, 68, 68, 0.2);
        }

        .alert-success {
            background: rgba(34, 197, 94, 0.1);
            color: var(--success);
            border: 1px solid rgba(34, 197, 94, 0.2);
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

        .hidden {
            display: none;
        }

        @media (max-width: 640px) {
            .login-card {
                padding: 2rem;
            }
            
            .title {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="header">
                <div class="logo">E</div>
                <h1 class="title">E-Voting OSIS</h1>
                <p class="subtitle">Pemilihan Ketua & Wakil OSIS</p>
            </div>

            <div id="alert" class="alert hidden"></div>

            <div class="role-buttons">
                <button type="button" class="role-btn active" data-role="pemilih">
                    👤 Login Sebagai Pemilih
                </button>
                <button type="button" class="role-btn" data-role="admin">
                    🛡️ Login Sebagai Admin
                </button>
                <button type="button" class="role-btn" data-role="calon">
                    👥 Login Sebagai Calon
                </button>
            </div>

            <form id="loginForm">
                <div class="form-group">
                    <label class="label" for="userId" id="userIdLabel">Nomor Telepon / ID User</label>
                    <input type="text" id="userId" name="user_id" class="input" placeholder="Masukkan nomor telepon" required>
                </div>

                <div class="form-group">
                    <label class="label" for="password">Password</label>
                    <input type="password" id="password" name="password" class="input" placeholder="Masukkan password" required>
                </div>

                <button type="submit" class="login-btn" id="loginBtn">Login</button>

                <p class="help-text" id="helpText">Gunakan akun yang diberikan panitia</p>
            </form>
        </div>
    </div>

    <script>
        const roleButtons = document.querySelectorAll('.role-btn');
        const userIdInput = document.getElementById('userId');
        const userIdLabel = document.getElementById('userIdLabel');
        const helpText = document.getElementById('helpText');
        const loginForm = document.getElementById('loginForm');
        const loginBtn = document.getElementById('loginBtn');
        const alert = document.getElementById('alert');

        let selectedRole = 'pemilih';

        // Role selection
        roleButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                roleButtons.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                selectedRole = btn.dataset.role;
                updateFormLabels();
            });
        });

        function updateFormLabels() {
            switch(selectedRole) {
                case 'pemilih':
                    userIdLabel.textContent = 'Nomor Telepon / ID User';
                    userIdInput.placeholder = 'Masukkan nomor telepon';
                    helpText.textContent = 'Gunakan akun yang diberikan panitia';
                    break;
                case 'admin':
                    userIdLabel.textContent = 'Username Admin';
                    userIdInput.placeholder = 'Masukkan username';
                    helpText.textContent = 'Hanya untuk administrator sistem';
                    break;
                case 'calon':
                    userIdLabel.textContent = 'ID Calon';
                    userIdInput.placeholder = 'Masukkan ID calon';
                    helpText.textContent = 'Login khusus untuk kandidat';
                    break;
            }
        }

        function showAlert(message, type = 'error') {
            alert.textContent = message;
            alert.className = `alert alert-${type}`;
            alert.classList.remove('hidden');
            
            setTimeout(() => {
                alert.classList.add('hidden');
            }, 5000);
        }

        // Form submission
        loginForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            
            loginBtn.disabled = true;
            loginBtn.textContent = 'Memproses...';

            const formData = new FormData();
            formData.append('user_id', userIdInput.value);
            formData.append('password', document.getElementById('password').value);
            formData.append('role', selectedRole);

            try {
                const response = await fetch('<?= base_url('auth/login') ?>', {
                    method: 'POST',
                    body: formData
                });

                const result = await response.json();

                if (result.status === 'success') {
                    showAlert(result.message, 'success');
                    setTimeout(() => {
                        window.location.href = result.redirect;
                    }, 1000);
                } else {
                    showAlert(result.message, 'error');
                }
            } catch (error) {
                showAlert('Terjadi kesalahan sistem', 'error');
            } finally {
                loginBtn.disabled = false;
                loginBtn.textContent = 'Login';
            }
        });
    </script>
</body>
</html>
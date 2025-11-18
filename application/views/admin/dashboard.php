<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - E-Voting OSIS</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

        [data-theme="dark"] {
            --background: hsl(222, 47%, 11%);
            --foreground: hsl(0, 0%, 98%);
            --card: hsl(222, 47%, 15%);
            --muted: hsl(220, 13%, 20%);
            --muted-foreground: hsl(220, 9%, 65%);
            --border: hsl(220, 13%, 25%);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: var(--muted);
            min-height: 100vh;
        }

        .header {
            background: var(--card);
            border-bottom: 1px solid var(--border);
            box-shadow: 0 4px 20px rgba(59, 130, 246, 0.1);
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .header-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .logo {
            width: 3rem;
            height: 3rem;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
        }

        .header-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--foreground);
        }

        .header-subtitle {
            font-size: 0.875rem;
            color: var(--muted-foreground);
        }

        .logout-btn {
            padding: 0.5rem 1rem;
            border: 2px solid var(--border);
            border-radius: 12px;
            background: var(--background);
            color: var(--foreground);
            text-decoration: none;
            font-size: 0.875rem;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .logout-btn:hover {
            border-color: var(--primary);
            color: var(--primary);
        }

        .main {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem 1rem;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: var(--card);
            border-radius: 20px;
            padding: 1.5rem;
            box-shadow: 0 4px 20px rgba(59, 130, 246, 0.1);
            animation: fadeIn 0.5s ease-out;
        }

        .stat-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .stat-info h3 {
            font-size: 2rem;
            font-weight: bold;
            color: var(--foreground);
            margin-bottom: 0.25rem;
        }

        .stat-info p {
            font-size: 0.875rem;
            color: var(--muted-foreground);
        }

        .stat-icon {
            width: 3rem;
            height: 3rem;
            border-radius: 50%;
            background: var(--muted);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        .tabs {
            margin-bottom: 1.5rem;
        }

        .tab-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            gap: 0.25rem;
            background: var(--muted);
            padding: 0.25rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
        }

        .tab-btn {
            padding: 0.75rem 1rem;
            border: none;
            border-radius: 8px;
            background: transparent;
            color: var(--muted-foreground);
            font-size: 0.875rem;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .tab-btn.active {
            background: var(--card);
            color: var(--foreground);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        .card {
            background: var(--card);
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(59, 130, 246, 0.1);
            overflow: hidden;
        }

        .card-header {
            padding: 1.5rem;
            border-bottom: 1px solid var(--border);
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: bold;
            color: var(--foreground);
            margin-bottom: 0.25rem;
        }

        .card-description {
            font-size: 0.875rem;
            color: var(--muted-foreground);
        }

        .card-content {
            padding: 1.5rem;
        }

        .chart-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 1.5rem;
        }

        .chart-container {
            height: 300px;
            position: relative;
        }

        .theme-toggle {
            padding: 0.5rem;
            border: 2px solid var(--border);
            border-radius: 50%;
            background: var(--background);
            color: var(--foreground);
            cursor: pointer;
            transition: all 0.2s;
            font-size: 1.25rem;
            width: 2.5rem;
            height: 2.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .theme-toggle:hover {
            border-color: var(--primary);
            color: var(--primary);
        }

        .candidate-list {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .candidate-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem;
            background: var(--muted);
            border-radius: 12px;
        }

        .btn {
            padding: 0.5rem 1rem;
            border: 2px solid var(--border);
            border-radius: 8px;
            background: var(--background);
            color: var(--foreground);
            font-size: 0.875rem;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
        }

        .btn:hover {
            border-color: var(--primary);
            color: var(--primary);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border-color: transparent;
        }

        .btn-primary:hover {
            opacity: 0.9;
            color: white;
        }

        .btn-destructive {
            background: var(--destructive);
            color: white;
            border-color: transparent;
        }

        .btn-destructive:hover {
            opacity: 0.9;
            color: white;
        }

        .form-group {
            margin-bottom: 1rem;
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
            padding: 0.75rem;
            border: 2px solid var(--border);
            border-radius: 12px;
            font-size: 0.875rem;
            background: var(--background);
        }

        .input:focus {
            outline: none;
            border-color: var(--primary);
        }

        .switch-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem;
            background: var(--muted);
            border-radius: 12px;
            margin-bottom: 1rem;
        }

        .switch {
            position: relative;
            width: 44px;
            height: 24px;
            background: var(--border);
            border-radius: 12px;
            cursor: pointer;
            transition: background 0.2s;
        }

        .switch.active {
            background: var(--primary);
        }

        .switch::after {
            content: '';
            position: absolute;
            top: 2px;
            left: 2px;
            width: 20px;
            height: 20px;
            background: white;
            border-radius: 50%;
            transition: transform 0.2s;
        }

        .switch.active::after {
            transform: translateX(20px);
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background: var(--card);
            border-radius: 20px;
            padding: 2rem;
            max-width: 600px;
            width: 90%;
            max-height: 90vh;
            overflow-y: auto;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .modal-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--foreground);
        }

        .close-btn {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--muted-foreground);
        }

        .photo-upload {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            border: 2px dashed var(--border);
            border-radius: 12px;
            margin-bottom: 1rem;
        }

        .photo-preview {
            width: 120px;
            height: 120px;
            border-radius: 12px;
            object-fit: cover;
            border: 2px solid var(--border);
        }

        .photo-placeholder {
            width: 120px;
            height: 120px;
            border-radius: 12px;
            background: var(--muted);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: var(--muted-foreground);
        }

        .file-input {
            display: none;
        }

        .upload-btn {
            padding: 0.5rem 1rem;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 0.875rem;
        }

        .textarea {
            width: 100%;
            min-height: 100px;
            padding: 0.75rem;
            border: 2px solid var(--border);
            border-radius: 12px;
            font-size: 0.875rem;
            background: var(--background);
            resize: vertical;
            font-family: inherit;
        }

        .textarea:focus {
            outline: none;
            border-color: var(--primary);
        }

        .photo-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .couple-photo {
            grid-column: 1 / -1;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }

            .chart-grid {
                grid-template-columns: 1fr;
            }

            .tab-list {
                grid-template-columns: repeat(2, 1fr);
            }

            .tab-btn span {
                display: none;
            }
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="header-content">
            <div class="header-left">
                <div class="logo">🛡️</div>
                <div>
                    <h1 class="header-title">Dashboard Admin</h1>
                    <p class="header-subtitle"><?= $admin_name ?></p>
                </div>
            </div>
            <div style="display: flex; align-items: center; gap: 1rem;">
                <button class="theme-toggle" id="themeToggle" title="Toggle Dark Mode">
                    🌙
                </button>
                <a href="<?= base_url('auth/logout') ?>" class="logout-btn">
                    🚪 <span>Keluar</span>
                </a>
            </div>
        </div>
    </header>

    <main class="main">
        <!-- Stats Cards -->
        <div class="stats-grid" id="statsGrid">
            <div class="stat-card">
                <div class="stat-content">
                    <div class="stat-info">
                        <h3 id="totalVoters">150</h3>
                        <p>Total Pemilih</p>
                    </div>
                    <div class="stat-icon" style="color: var(--primary);">👥</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-content">
                    <div class="stat-info">
                        <h3 id="totalVotes">100</h3>
                        <p>Sudah Memilih</p>
                    </div>
                    <div class="stat-icon" style="color: var(--success);">✅</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-content">
                    <div class="stat-info">
                        <h3 id="remainingVoters">50</h3>
                        <p>Belum Memilih</p>
                    </div>
                    <div class="stat-icon" style="color: var(--destructive);">⏰</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-content">
                    <div class="stat-info">
                        <h3 id="participation">66.7%</h3>
                        <p>Partisipasi</p>
                    </div>
                    <div class="stat-icon" style="color: var(--secondary);">📈</div>
                </div>
            </div>
        </div>

        <!-- Tabs -->
        <div class="tabs">
            <div class="tab-list">
                <button class="tab-btn active" data-tab="quickcount">
                    📊 <span>Quickcount</span>
                </button>
                <button class="tab-btn" data-tab="candidates">
                    🗳️ <span>Calon</span>
                </button>
                <button class="tab-btn" data-tab="voters">
                    👥 <span>Pemilih</span>
                </button>
                <button class="tab-btn" data-tab="schedule">
                    ⏰ <span>Jadwal</span>
                </button>
                <button class="tab-btn" data-tab="settings">
                    ⚙️ <span>Pengaturan</span>
                </button>
            </div>

            <!-- Quickcount Tab -->
            <div class="tab-content active" id="quickcount">
                <div class="chart-grid">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Distribusi Suara</h3>
                            <p class="card-description">Persentase perolehan suara real-time</p>
                        </div>
                        <div class="card-content">
                            <div class="chart-container">
                                <canvas id="pieChart"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Perolehan Suara</h3>
                            <p class="card-description">Jumlah suara per kandidat</p>
                        </div>
                        <div class="card-content">
                            <div class="chart-container">
                                <canvas id="barChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Candidates Tab -->
            <div class="tab-content" id="candidates">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Manajemen Calon</h3>
                        <p class="card-description">Kelola data kandidat ketua & wakil OSIS</p>
                    </div>
                    <div class="card-content">
                        <div class="candidate-list">
                            <div class="candidate-item">
                                <div>
                                    <p style="font-weight: 600;">Pasangan Calon 1</p>
                                    <p style="font-size: 0.875rem; color: var(--muted-foreground);">Ahmad Rizki & Sari Dewi</p>
                                </div>
                                <div style="display: flex; gap: 0.5rem;">
                                    <button class="btn" onclick="editCandidate(1)">
                                        ✏️ Edit
                                    </button>
                                    <button class="btn btn-destructive" onclick="deleteCandidate(1)">
                                        🗑️ Hapus
                                    </button>
                                </div>
                            </div>
                            <div class="candidate-item">
                                <div>
                                    <p style="font-weight: 600;">Pasangan Calon 2</p>
                                    <p style="font-size: 0.875rem; color: var(--muted-foreground);">Siti Aisyah & Budi Hartono</p>
                                </div>
                                <div style="display: flex; gap: 0.5rem;">
                                    <button class="btn" onclick="editCandidate(2)">
                                        ✏️ Edit
                                    </button>
                                    <button class="btn btn-destructive" onclick="deleteCandidate(2)">
                                        🗑️ Hapus
                                    </button>
                                </div>
                            </div>
                            <div class="candidate-item">
                                <div>
                                    <p style="font-weight: 600;">Pasangan Calon 3</p>
                                    <p style="font-size: 0.875rem; color: var(--muted-foreground);">Muhammad Farhan & Rina Sari</p>
                                </div>
                                <div style="display: flex; gap: 0.5rem;">
                                    <button class="btn" onclick="editCandidate(3)">
                                        ✏️ Edit
                                    </button>
                                    <button class="btn btn-destructive" onclick="deleteCandidate(3)">
                                        🗑️ Hapus
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Voters Tab -->
            <div class="tab-content" id="voters">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Manajemen Pemilih</h3>
                        <p class="card-description">Import dan kelola data pemilih</p>
                    </div>
                    <div class="card-content">
                        <button class="btn btn-primary" style="margin-bottom: 1rem;">
                            👥 Import Data Pemilih
                        </button>
                        <div style="border: 2px solid var(--border); border-radius: 12px; padding: 2rem; text-align: center; color: var(--muted-foreground);">
                            Daftar pemilih akan ditampilkan di sini
                        </div>
                    </div>
                </div>
            </div>

            <!-- Schedule Tab -->
            <div class="tab-content" id="schedule">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Pengaturan Waktu Pemilihan</h3>
                        <p class="card-description">Atur jadwal mulai dan selesai pemilihan</p>
                    </div>
                    <div class="card-content">
                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1rem; margin-bottom: 1rem;">
                            <div class="form-group">
                                <label class="label">Waktu Mulai</label>
                                <input type="datetime-local" class="input">
                            </div>
                            <div class="form-group">
                                <label class="label">Waktu Selesai</label>
                                <input type="datetime-local" class="input">
                            </div>
                        </div>
                        <button class="btn btn-primary">
                            ⏰ Simpan Jadwal
                        </button>
                    </div>
                </div>
            </div>

            <!-- Settings Tab -->
            <div class="tab-content" id="settings">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Pengaturan Sistem</h3>
                        <p class="card-description">Konfigurasi sistem pemilihan</p>
                    </div>
                    <div class="card-content">
                        <div class="switch-container">
                            <div>
                                <p style="font-weight: 600; margin-bottom: 0.25rem;">Quickcount Real-time</p>
                                <p style="font-size: 0.875rem; color: var(--muted-foreground);">Tampilkan hasil perhitungan suara secara langsung</p>
                            </div>
                            <div class="switch active" id="quickcountSwitch"></div>
                        </div>
                        
                        <div class="switch-container">
                            <div>
                                <p style="font-weight: 600; margin-bottom: 0.25rem;">Reset Data Pemilihan</p>
                                <p style="font-size: 0.875rem; color: var(--muted-foreground);">Hapus semua data suara (tidak dapat dikembalikan)</p>
                            </div>
                            <button class="btn btn-destructive">
                                Reset
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Edit Candidate Modal -->
    <div class="modal" id="editModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Edit Kandidat</h3>
                <button class="close-btn" onclick="closeEditModal()">&times;</button>
            </div>
            
            <form id="editCandidateForm">
                <input type="hidden" id="candidateId">
                
                <!-- Photo Uploads -->
                <div class="photo-grid">
                    <div class="photo-upload">
                        <div class="photo-placeholder" id="ketuaPreview">👤</div>
                        <input type="file" id="ketuaPhoto" class="file-input" accept="image/*" onchange="previewPhoto(this, 'ketuaPreview')">
                        <button type="button" class="upload-btn" onclick="document.getElementById('ketuaPhoto').click()">
                            Upload Foto Ketua
                        </button>
                    </div>
                    
                    <div class="photo-upload">
                        <div class="photo-placeholder" id="wakilPreview">👤</div>
                        <input type="file" id="wakilPhoto" class="file-input" accept="image/*" onchange="previewPhoto(this, 'wakilPreview')">
                        <button type="button" class="upload-btn" onclick="document.getElementById('wakilPhoto').click()">
                            Upload Foto Wakil
                        </button>
                    </div>
                </div>
                
                <div class="photo-upload couple-photo">
                    <div class="photo-placeholder" id="couplePreview" style="width: 200px; height: 150px;">👥</div>
                    <input type="file" id="couplePhoto" class="file-input" accept="image/*" onchange="previewPhoto(this, 'couplePreview')">
                    <button type="button" class="upload-btn" onclick="document.getElementById('couplePhoto').click()">
                        Upload Foto Bersama (Foto Utama)
                    </button>
                </div>
                
                <!-- Names -->
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
                    <div class="form-group">
                        <label class="label">Nama Ketua</label>
                        <input type="text" id="ketuaName" class="input" required>
                    </div>
                    <div class="form-group">
                        <label class="label">Nama Wakil</label>
                        <input type="text" id="wakilName" class="input" required>
                    </div>
                </div>
                
                <!-- Vision -->
                <div class="form-group">
                    <label class="label">Visi</label>
                    <textarea id="vision" class="textarea" placeholder="Masukkan visi kandidat..." required></textarea>
                </div>
                
                <!-- Mission -->
                <div class="form-group">
                    <label class="label">Misi</label>
                    <textarea id="mission" class="textarea" placeholder="Masukkan misi kandidat..." required></textarea>
                </div>
                
                <div style="display: flex; gap: 1rem; justify-content: flex-end;">
                    <button type="button" class="btn" onclick="closeEditModal()">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        let pieChart, barChart;
        let isDarkMode = localStorage.getItem('darkMode') === 'true';

        // Initialize theme
        if (isDarkMode) {
            document.documentElement.setAttribute('data-theme', 'dark');
            document.getElementById('themeToggle').textContent = '☀️';
        }

        // Theme toggle
        document.getElementById('themeToggle').addEventListener('click', () => {
            isDarkMode = !isDarkMode;
            localStorage.setItem('darkMode', isDarkMode);
            
            if (isDarkMode) {
                document.documentElement.setAttribute('data-theme', 'dark');
                document.getElementById('themeToggle').textContent = '☀️';
            } else {
                document.documentElement.removeAttribute('data-theme');
                document.getElementById('themeToggle').textContent = '🌙';
            }
            
            // Update charts with new theme
            updateCharts();
        });

        // Tab functionality
        const tabButtons = document.querySelectorAll('.tab-btn');
        const tabContents = document.querySelectorAll('.tab-content');

        tabButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                const targetTab = btn.dataset.tab;
                
                tabButtons.forEach(b => b.classList.remove('active'));
                tabContents.forEach(c => c.classList.remove('active'));
                
                btn.classList.add('active');
                document.getElementById(targetTab).classList.add('active');
            });
        });

        // Switch functionality
        const quickcountSwitch = document.getElementById('quickcountSwitch');
        quickcountSwitch.addEventListener('click', () => {
            quickcountSwitch.classList.toggle('active');
        });

        // Chart colors based on theme
        function getChartColors() {
            const style = getComputedStyle(document.documentElement);
            return {
                candidate1: '#3B82F6', // Blue
                candidate2: '#8B5CF6', // Purple  
                candidate3: '#10B981', // Green
                text: `hsl(${style.getPropertyValue('--foreground').trim()})`,
                grid: `hsl(${style.getPropertyValue('--border').trim()})`
            };
        }

        // Initialize charts
        function initCharts() {
            const colors = getChartColors();
            
            // Pie Chart
            const pieCtx = document.getElementById('pieChart').getContext('2d');
            pieChart = new Chart(pieCtx, {
                type: 'pie',
                data: {
                    labels: ['Paslon 1', 'Paslon 2', 'Paslon 3'],
                    datasets: [{
                        data: [45, 32, 23],
                        backgroundColor: [colors.candidate1, colors.candidate2, colors.candidate3],
                        borderWidth: 2,
                        borderColor: colors.grid
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                color: colors.text,
                                padding: 20
                            }
                        }
                    }
                }
            });

            // Bar Chart
            const barCtx = document.getElementById('barChart').getContext('2d');
            barChart = new Chart(barCtx, {
                type: 'bar',
                data: {
                    labels: ['Paslon 1', 'Paslon 2', 'Paslon 3'],
                    datasets: [{
                        label: 'Jumlah Suara',
                        data: [45, 32, 23],
                        backgroundColor: [colors.candidate1, colors.candidate2, colors.candidate3],
                        borderWidth: 2,
                        borderColor: colors.grid,
                        borderRadius: 8
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                color: colors.text
                            },
                            grid: {
                                color: colors.grid
                            }
                        },
                        x: {
                            ticks: {
                                color: colors.text
                            },
                            grid: {
                                color: colors.grid
                            }
                        }
                    }
                }
            });
        }

        // Update charts with new theme colors
        function updateCharts() {
            if (pieChart && barChart) {
                const colors = getChartColors();
                
                // Update pie chart
                pieChart.data.datasets[0].backgroundColor = [colors.candidate1, colors.candidate2, colors.candidate3];
                pieChart.data.datasets[0].borderColor = colors.grid;
                pieChart.options.plugins.legend.labels.color = colors.text;
                pieChart.update();
                
                // Update bar chart
                barChart.data.datasets[0].backgroundColor = [colors.candidate1, colors.candidate2, colors.candidate3];
                barChart.data.datasets[0].borderColor = colors.grid;
                barChart.options.scales.y.ticks.color = colors.text;
                barChart.options.scales.y.grid.color = colors.grid;
                barChart.options.scales.x.ticks.color = colors.text;
                barChart.options.scales.x.grid.color = colors.grid;
                barChart.update();
            }
        }

        // Load vote data
        async function loadVoteData() {
            try {
                const response = await fetch('<?= base_url('api/vote_data') ?>');
                const data = await response.json();
                
                if (data.statistics) {
                    document.getElementById('totalVoters').textContent = data.statistics.total_voters;
                    document.getElementById('totalVotes').textContent = data.statistics.total_votes;
                    document.getElementById('remainingVoters').textContent = data.statistics.remaining_voters;
                    document.getElementById('participation').textContent = data.statistics.participation + '%';
                }
                
                if (data.vote_data && pieChart && barChart) {
                    const labels = data.vote_data.map(item => `Paslon ${item.candidate_number}`);
                    const votes = data.vote_data.map(item => parseInt(item.vote_count));
                    
                    pieChart.data.labels = labels;
                    pieChart.data.datasets[0].data = votes;
                    pieChart.update();
                    
                    barChart.data.labels = labels;
                    barChart.data.datasets[0].data = votes;
                    barChart.update();
                }
            } catch (error) {
                console.log('Using dummy data');
            }
        }

        // Initialize when page loads
        document.addEventListener('DOMContentLoaded', () => {
            initCharts();
            loadVoteData();
            
            // Auto refresh every 30 seconds
            setInterval(loadVoteData, 30000);
        });
    </script>
</body>
</html>
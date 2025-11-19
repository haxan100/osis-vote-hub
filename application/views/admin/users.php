<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pemilih - Admin E-Voting</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: #f8fafc;
            color: #1e293b;
        }

        .header {
            background: linear-gradient(135deg, #3b82f6, #8b5cf6);
            color: white;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .card-header {
            padding: 1.5rem;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .btn {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.2s;
        }

        .btn-primary {
            background: #3b82f6;
            color: white;
        }

        .btn-success {
            background: #10b981;
            color: white;
        }

        .btn-warning {
            background: #f59e0b;
            color: white;
        }

        .btn-danger {
            background: #ef4444;
            color: white;
        }

        .btn:hover {
            opacity: 0.9;
            transform: translateY(-1px);
        }

        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
        }

        th {
            background: #f8fafc;
            font-weight: 600;
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
        }

        .modal-content {
            background: white;
            margin: 5% auto;
            padding: 2rem;
            border-radius: 12px;
            width: 90%;
            max-width: 500px;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        .form-input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 0.875rem;
        }

        .alert {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
        }

        .alert-success {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
        }

        .alert-error {
            background: #fef2f2;
            color: #dc2626;
            border: 1px solid #fecaca;
        }

        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Manajemen Data Pemilih</h1>
        <div>
            <span>Admin: <?= $admin_name ?></span>
            <a href="<?= base_url('admin') ?>" class="btn btn-primary" style="margin-left: 1rem;">Dashboard</a>
        </div>
    </div>

    <div class="container">
        <div id="alert" class="alert hidden"></div>

        <div class="card">
            <div class="card-header">
                <h2>Data Pemilih</h2>
                <button class="btn btn-success" onclick="openImportModal()">
                    📥 Import Data Pemilih
                </button>
            </div>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Nomor Telepon</th>
                            <th>Kelas</th>
                            <th>Status Voting</th>
                            <th>Password Default</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach($users as $user): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $user['name'] ?></td>
                            <td><?= $user['user_id'] ?></td>
                            <td><?= $user['kelas'] ?? '-' ?></td>
                            <td>
                                <?= $user['has_voted'] ? '<span style="color: green;">Sudah Voting</span>' : '<span style="color: orange;">Belum Voting</span>' ?>
                            </td>
                            <td>
                                <?= $user['default_password'] ? '<span style="color: red;">Ya</span>' : '<span style="color: green;">Tidak</span>' ?>
                            </td>
                            <td>
                                <button class="btn btn-warning" onclick="editUser(<?= $user['id'] ?>, '<?= $user['name'] ?>', '<?= $user['user_id'] ?>', '<?= $user['kelas'] ?>')">Edit</button>
                                <button class="btn btn-primary" onclick="resetPassword(<?= $user['id'] ?>, '<?= $user['name'] ?>')">Reset Password</button>
                                <button class="btn btn-danger" onclick="deleteUser(<?= $user['id'] ?>, '<?= $user['name'] ?>')">Hapus</button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Import Modal -->
    <div id="importModal" class="modal">
        <div class="modal-content">
            <h3>Import Data Pemilih</h3>
            <form id="importForm" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="form-label">File Excel</label>
                    <input type="file" name="excel_file" class="form-input" accept=".xlsx,.xls" required>
                </div>
                <div style="margin-bottom: 1rem;">
                    <a href="<?= base_url('import/download_template') ?>" class="btn btn-success">
                        📥 Download Template
                    </a>
                </div>
                <div style="display: flex; gap: 1rem;">
                    <button type="submit" class="btn btn-primary">Upload</button>
                    <button type="button" class="btn btn-danger" onclick="closeImportModal()">Batal</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <h3>Edit Data Pemilih</h3>
            <form id="editForm">
                <input type="hidden" id="editUserId" name="user_id">
                <div class="form-group">
                    <label class="form-label">Nama</label>
                    <input type="text" id="editName" name="name" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Nomor Telepon</label>
                    <input type="text" id="editPhone" name="phone" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Kelas</label>
                    <input type="text" id="editKelas" name="kelas" class="form-input" required>
                </div>
                <div style="display: flex; gap: 1rem;">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <button type="button" class="btn btn-danger" onclick="closeEditModal()">Batal</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function showAlert(message, type = 'success') {
            const alert = document.getElementById('alert');
            alert.textContent = message;
            alert.className = `alert alert-${type}`;
            alert.classList.remove('hidden');
            
            setTimeout(() => {
                alert.classList.add('hidden');
            }, 5000);
        }

        function openImportModal() {
            document.getElementById('importModal').style.display = 'block';
        }

        function closeImportModal() {
            document.getElementById('importModal').style.display = 'none';
        }

        function editUser(id, name, phone, kelas) {
            document.getElementById('editUserId').value = id;
            document.getElementById('editName').value = name;
            document.getElementById('editPhone').value = phone;
            document.getElementById('editKelas').value = kelas;
            document.getElementById('editModal').style.display = 'block';
        }

        function closeEditModal() {
            document.getElementById('editModal').style.display = 'none';
        }

        function resetPassword(id, name) {
            if (confirm(`Yakin ingin reset password untuk ${name}?\nPassword akan direset ke nomor telepon tanpa angka 0 di depan.`)) {
                fetch('<?= base_url('admin/reset_password') ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `user_id=${id}`
                })
                .then(response => response.json())
                .then(data => {
                    showAlert(data.message, data.status);
                    if (data.status === 'success') {
                        setTimeout(() => location.reload(), 1000);
                    }
                });
            }
        }

        function deleteUser(id, name) {
            if (confirm(`Yakin ingin menghapus ${name}?`)) {
                fetch('<?= base_url('admin/delete_user') ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `user_id=${id}`
                })
                .then(response => response.json())
                .then(data => {
                    showAlert(data.message, data.status);
                    if (data.status === 'success') {
                        setTimeout(() => location.reload(), 1000);
                    }
                });
            }
        }

        // Import form submission
        document.getElementById('importForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            
            fetch('<?= base_url('import/upload_data') ?>', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                showAlert(data.message, data.status);
                if (data.status === 'success') {
                    closeImportModal();
                    setTimeout(() => location.reload(), 2000);
                }
            });
        });

        // Edit form submission
        document.getElementById('editForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            
            fetch('<?= base_url('admin/edit_user') ?>', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                showAlert(data.message, data.status);
                if (data.status === 'success') {
                    closeEditModal();
                    setTimeout(() => location.reload(), 1000);
                }
            });
        });
    </script>
</body>
</html>
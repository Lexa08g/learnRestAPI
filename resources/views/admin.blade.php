<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - MyShop</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        }

        body {
            background-color: #ffffff;
            color: #111827;
        }

        /* Header Navigation (Sesuai Dashboard) */
        .header {
            background-color: #1a6cf0;
            color: #ffffff;
            padding: 12px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header .brand {
            font-size: 20px;
            font-weight: 700;
            color: #ffffff;
            text-decoration: none;
            letter-spacing: -0.3px;
        }

        .header .nav-links {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .header .nav-links a {
            color: #ffffff;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
        }

        .header .nav-links a:hover {
            opacity: 0.85;
        }

        .btn-header-logout {
            background-color: #ffffff;
            color: #dc2626;
            border: none;
            padding: 5px 12px;
            border-radius: 4px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
        }

        .btn-header-logout:hover {
            background-color: #fee2e2;
        }

        /* Search & Filter Bar */
        .filter-section {
            background-color: #f1f3f4;
            padding: 12px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .search-box {
            width: 250px;
            padding: 6px 12px;
            font-size: 13.5px;
            border: 1px solid #757575;
            border-radius: 6px;
            background-color: #ffffff;
            outline: none;
            color: #333333;
        }

        .search-box:focus {
            border-color: #1a6cf0;
        }

        .category-select {
            padding: 6px 10px;
            font-size: 13.5px;
            border: 1.5px solid #222222;
            border-radius: 4px;
            background-color: #ffffff;
            outline: none;
            cursor: pointer;
            color: #111111;
        }

        .btn-primary {
            background-color: #1a6cf0;
            color: #ffffff;
            border: none;
            padding: 7px 16px;
            border-radius: 6px;
            font-size: 13.5px;
            font-weight: 600;
            cursor: pointer;
        }

        .btn-primary:hover {
            background-color: #1355c4;
        }

        .btn-secondary {
            background-color: #e5e7eb;
            color: #374151;
            border: none;
            padding: 7px 14px;
            border-radius: 6px;
            font-size: 13.5px;
            font-weight: 500;
            cursor: pointer;
        }

        .btn-secondary:hover {
            background-color: #d1d5db;
        }

        /* Main Container */
        .main-container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 24px;
        }

        .page-title {
            font-size: 20px;
            font-weight: 800;
            color: #000000;
            margin-bottom: 16px;
            letter-spacing: -0.2px;
        }

        /* Alert Messages */
        .alert {
            padding: 10px 14px;
            border-radius: 6px;
            font-size: 13.5px;
            margin-bottom: 16px;
            display: none;
        }

        .alert-success {
            background-color: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
        }

        .alert-danger {
            background-color: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        /* Auth Form Card */
        .auth-card {
            max-width: 400px;
            margin: 40px auto;
            background: #ffffff;
            border: 1.5px solid #4b5563;
            border-radius: 8px;
            padding: 24px;
        }

        .auth-tabs {
            display: flex;
            border-bottom: 1px solid #e5e7eb;
            margin-bottom: 20px;
        }

        .auth-tab {
            flex: 1;
            text-align: center;
            padding: 8px;
            font-size: 14px;
            font-weight: 600;
            color: #6b7280;
            cursor: pointer;
            border-bottom: 2px solid transparent;
        }

        .auth-tab.active {
            color: #1a6cf0;
            border-bottom-color: #1a6cf0;
        }

        .form-group {
            margin-bottom: 14px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 5px;
        }

        .form-control {
            width: 100%;
            padding: 8px 12px;
            font-size: 13.5px;
            border: 1px solid #757575;
            border-radius: 4px;
            outline: none;
        }

        .form-control:focus {
            border-color: #1a6cf0;
        }

        .demo-box {
            background-color: #f9fafb;
            border: 1px dashed #9ca3af;
            border-radius: 4px;
            padding: 10px;
            font-size: 12px;
            color: #4b5563;
            margin-top: 14px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* Table Styling */
        .table-responsive {
            width: 100%;
            overflow-x: auto;
            border: 1px solid #e5e7eb;
            border-radius: 6px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13.5px;
            text-align: left;
        }

        th {
            background-color: #f9fafb;
            color: #374151;
            font-weight: 600;
            padding: 10px 14px;
            border-bottom: 1px solid #e5e7eb;
        }

        td {
            padding: 12px 14px;
            border-bottom: 1px solid #e5e7eb;
            vertical-align: middle;
        }

        tr:hover td {
            background-color: #f9fafb;
        }

        .prod-thumb {
            width: 48px;
            height: 48px;
            object-fit: cover;
            border: 1px solid #d1d5db;
            border-radius: 4px;
        }

        .no-thumb {
            width: 48px;
            height: 48px;
            background-color: #e5e7eb;
            color: #6b7280;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            border-radius: 4px;
            text-align: center;
        }

        .btn-action-edit {
            color: #1a6cf0;
            text-decoration: none;
            font-weight: 600;
            margin-right: 10px;
            cursor: pointer;
        }

        .btn-action-edit:hover {
            text-decoration: underline;
        }

        .btn-action-delete {
            color: #dc2626;
            text-decoration: none;
            font-weight: 600;
            cursor: pointer;
        }

        .btn-action-delete:hover {
            text-decoration: underline;
        }

        /* Modal */
        .modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 100;
            padding: 20px;
        }

        .modal.active {
            display: flex;
        }

        .modal-dialog {
            background: #ffffff;
            border-radius: 8px;
            width: 100%;
            max-width: 520px;
            padding: 20px 24px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            max-height: 90vh;
            overflow-y: auto;
        }

        .modal-title {
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 16px;
            padding-bottom: 8px;
            border-bottom: 1px solid #e5e7eb;
        }

        .modal-footer {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 18px;
            padding-top: 12px;
            border-top: 1px solid #e5e7eb;
        }
    </style>
</head>
<body>

    <!-- Header Navigation -->
    <header class="header">
        <a href="{{ url('/') }}" class="brand">MyShop</a>
        <nav class="nav-links">
            <a href="{{ url('/') }}">Katalog Toko</a>
            <span id="navUserDisplay" style="display: none; font-size: 13.5px; opacity: 0.95;">
                Halo, <strong id="userNameText">Admin</strong>
            </span>
            <button id="btnLogout" class="btn-header-logout" style="display: none;" onclick="handleLogout()">Logout</button>
        </nav>
    </header>

    <!-- Sub-header Filter & Actions (Hanya Tampil Saat Login) -->
    <div id="filterBar" class="filter-section" style="display: none;">
        <div style="display: flex; gap: 10px; align-items: center;">
            <input 
                type="text" 
                id="searchBox" 
                class="search-box" 
                placeholder="Cari produk..." 
                oninput="filterTable()"
            >
            <select id="catSelect" class="category-select" onchange="filterTable()">
                <option value="">Semua Kategori</option>
                <option value="Indie Rock">Indie Rock</option>
                <option value="Dream Pop / Ambient Pop">Dream Pop</option>
                <option value="Alternative Rock / Grunge">Alternative Rock</option>
            </select>
        </div>
        <button class="btn-primary" onclick="openCreateModal()">+ Tambah Produk</button>
    </div>

    <!-- Main Content -->
    <main class="main-container">
        
        <!-- Alert Banner -->
        <div id="alertSuccess" class="alert alert-success"></div>
        <div id="alertDanger" class="alert alert-danger"></div>

        <!-- ========================================== -->
        <!-- 1. LOGIN & REGISTER FORM (SEPERTI BIASA)   -->
        <!-- ========================================== -->
        <div id="authSection" class="auth-card">
            <div class="auth-tabs">
                <div class="auth-tab active" id="tabLogin" onclick="switchTab('login')">Masuk (Login)</div>
                <div class="auth-tab" id="tabRegister" onclick="switchTab('register')">Daftar Akun</div>
            </div>

            <!-- Form Login -->
            <form id="formLogin" onsubmit="handleLogin(event)">
                <div class="form-group">
                    <label for="loginEmail">Email</label>
                    <input type="email" id="loginEmail" class="form-control" placeholder="contoh: test@example.com" required>
                </div>
                <div class="form-group">
                    <label for="loginPassword">Kata Sandi</label>
                    <input type="password" id="loginPassword" class="form-control" placeholder="Password" required>
                </div>
                <button type="submit" id="btnLogin" class="btn-primary" style="width: 100%;">Masuk</button>

                <div class="demo-box">
                    <span>Akun Uji: <strong>test@example.com</strong> (password)</span>
                    <button type="button" class="btn-secondary" style="padding: 3px 8px; font-size: 11px;" onclick="fillDemo()">Isi Cepat</button>
                </div>
            </form>

            <!-- Form Register -->
            <form id="formRegister" onsubmit="handleRegister(event)" style="display: none;">
                <div class="form-group">
                    <label for="regName">Nama Lengkap</label>
                    <input type="text" id="regName" class="form-control" placeholder="Nama" required>
                </div>
                <div class="form-group">
                    <label for="regEmail">Email</label>
                    <input type="email" id="regEmail" class="form-control" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <label for="regPassword">Kata Sandi (Min. 6 Karakter)</label>
                    <input type="password" id="regPassword" class="form-control" placeholder="Password" minlength="6" required>
                </div>
                <button type="submit" id="btnRegister" class="btn-primary" style="width: 100%;">Daftar Akun</button>
            </form>
        </div>

        <!-- ========================================== -->
        <!-- 2. DASHBOARD ADMIN TABEL CRUD PRODUK       -->
        <!-- ========================================== -->
        <div id="adminDashboard" style="display: none;">
            <h1 class="page-title">Manajemen Produk (Admin)</h1>

            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th style="width: 65px;">Gambar</th>
                            <th>Nama Produk</th>
                            <th>Artis</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th style="text-align: right; width: 140px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        <tr>
                            <td colspan="7" style="text-align: center; color: #6b7280; padding: 20px;">
                                Memuat data produk...
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </main>

    <!-- ========================================== -->
    <!-- 3. MODAL TAMBAH & EDIT PRODUK              -->
    <!-- ========================================== -->
    <div id="productModal" class="modal">
        <div class="modal-dialog">
            <h3 id="modalTitle" class="modal-title">Tambah Produk Baru</h3>

            <form id="productForm" onsubmit="handleProductSubmit(event)">
                <input type="hidden" id="prodId">

                <div class="form-group">
                    <label for="prodName">Nama Produk / Album *</label>
                    <input type="text" id="prodName" class="form-control" placeholder="contoh: AM" required>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
                    <div class="form-group">
                        <label for="prodArtist">Artis</label>
                        <input type="text" id="prodArtist" class="form-control" placeholder="contoh: Arctic Monkeys">
                    </div>
                    <div class="form-group">
                        <label for="prodFormat">Format</label>
                        <input type="text" id="prodFormat" class="form-control" placeholder="contoh: Vinyl LP">
                    </div>
                </div>

                <div class="form-group">
                    <label for="prodCategory">Kategori *</label>
                    <select id="prodCategory" class="form-control" required>
                        <option value="1">Indie Rock</option>
                        <option value="2">Dream Pop / Ambient Pop</option>
                        <option value="3">Alternative Rock / Grunge</option>
                    </select>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
                    <div class="form-group">
                        <label for="prodPrice">Harga (Rp) *</label>
                        <input type="number" id="prodPrice" class="form-control" placeholder="495000" min="0" required>
                    </div>
                    <div class="form-group">
                        <label for="prodStock">Stok</label>
                        <input type="number" id="prodStock" class="form-control" placeholder="10" min="0" value="10">
                    </div>
                </div>

                <div class="form-group">
                    <label for="prodDesc">Deskripsi</label>
                    <textarea id="prodDesc" class="form-control" rows="3" placeholder="Deskripsi produk..."></textarea>
                </div>

                <!-- FILE STORAGE UPLOAD -->
                <div class="form-group">
                    <label for="prodImg">Upload File Gambar (Storage)</label>
                    <input type="file" id="prodImg" class="form-control" accept="image/png,image/jpeg,image/jpg" onchange="previewFile(this)">
                    <small style="color: #6b7280; font-size: 11.5px; display: block; margin-top: 4px;">
                        File akan diunggah ke storage lokal (public/storage/products)
                    </small>
                    
                    <div id="previewWrap" style="display: none; margin-top: 8px; align-items: center; gap: 10px;">
                        <img id="previewImg" src="" style="width: 44px; height: 44px; object-fit: cover; border: 1px solid #ccc; border-radius: 4px;">
                        <span id="previewName" style="font-size: 12px; color: #4b5563;"></span>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-secondary" onclick="closeModal()">Batal</button>
                    <button type="submit" id="btnSaveProd" class="btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- JAVASCRIPT LOGIC (REST API & STORAGE) -->
    <script>
        const API_URL = '/api';
        let productsData = [];

        document.addEventListener('DOMContentLoaded', () => {
            const token = localStorage.getItem('token');
            if (token) {
                checkProfile(token);
            } else {
                showAuth();
            }
        });

        function switchTab(tab) {
            document.getElementById('tabLogin').classList.toggle('active', tab === 'login');
            document.getElementById('tabRegister').classList.toggle('active', tab === 'register');
            document.getElementById('formLogin').style.display = tab === 'login' ? 'block' : 'none';
            document.getElementById('formRegister').style.display = tab === 'register' ? 'block' : 'none';
        }

        function fillDemo() {
            document.getElementById('loginEmail').value = 'test@example.com';
            document.getElementById('loginPassword').value = 'password';
        }

        function showAlert(msg, isSuccess = true) {
            const el = document.getElementById(isSuccess ? 'alertSuccess' : 'alertDanger');
            const other = document.getElementById(isSuccess ? 'alertDanger' : 'alertSuccess');
            other.style.display = 'none';
            el.textContent = msg;
            el.style.display = 'block';
            setTimeout(() => { el.style.display = 'none'; }, 4000);
        }

        // LOGIN
        async function handleLogin(e) {
            e.preventDefault();
            const email = document.getElementById('loginEmail').value;
            const password = document.getElementById('loginPassword').value;
            const btn = document.getElementById('btnLogin');

            btn.disabled = true;
            btn.textContent = 'Memproses...';

            try {
                const res = await fetch(`${API_URL}/login`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
                    body: JSON.stringify({ email, password })
                });

                const data = await res.json();
                if (res.ok && data.token) {
                    localStorage.setItem('token', data.token);
                    showAlert('Login berhasil!');
                    checkProfile(data.token);
                } else {
                    showAlert(data.message || 'Email atau password salah.', false);
                }
            } catch (err) {
                showAlert('Gagal terhubung ke server.', false);
            } finally {
                btn.disabled = false;
                btn.textContent = 'Masuk';
            }
        }

        // REGISTER
        async function handleRegister(e) {
            e.preventDefault();
            const name = document.getElementById('regName').value;
            const email = document.getElementById('regEmail').value;
            const password = document.getElementById('regPassword').value;
            const btn = document.getElementById('btnRegister');

            btn.disabled = true;
            btn.textContent = 'Memproses...';

            try {
                const res = await fetch(`${API_URL}/register`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
                    body: JSON.stringify({ name, email, password })
                });

                const data = await res.json();
                if (res.ok) {
                    showAlert('Registrasi berhasil! Silakan masuk.');
                    switchTab('login');
                    document.getElementById('loginEmail').value = email;
                    document.getElementById('loginPassword').value = password;
                } else {
                    showAlert(data.message || 'Registrasi gagal.', false);
                }
            } catch (err) {
                showAlert('Gagal terhubung ke server.', false);
            } finally {
                btn.disabled = false;
                btn.textContent = 'Daftar Akun';
            }
        }

        // CHECK PROFILE
        async function checkProfile(token) {
            try {
                const res = await fetch(`${API_URL}/profile`, {
                    headers: { 'Authorization': `Bearer ${token}`, 'Accept': 'application/json' }
                });

                if (res.ok) {
                    const user = await res.json();
                    document.getElementById('userNameText').textContent = user.name || 'Admin';
                    document.getElementById('authSection').style.display = 'none';
                    document.getElementById('filterBar').style.display = 'flex';
                    document.getElementById('adminDashboard').style.display = 'block';
                    document.getElementById('navUserDisplay').style.display = 'inline';
                    document.getElementById('btnLogout').style.display = 'inline-block';
                    loadProducts();
                } else {
                    localStorage.removeItem('token');
                    showAuth();
                }
            } catch (err) {
                localStorage.removeItem('token');
                showAuth();
            }
        }

        function showAuth() {
            document.getElementById('authSection').style.display = 'block';
            document.getElementById('filterBar').style.display = 'none';
            document.getElementById('adminDashboard').style.display = 'none';
            document.getElementById('navUserDisplay').style.display = 'none';
            document.getElementById('btnLogout').style.display = 'none';
        }

        // LOGOUT
        async function handleLogout() {
            const token = localStorage.getItem('token');
            if (token) {
                try {
                    await fetch(`${API_URL}/logout`, {
                        method: 'POST',
                        headers: { 'Authorization': `Bearer ${token}`, 'Accept': 'application/json' }
                    });
                } catch (e) {}
            }
            localStorage.removeItem('token');
            showAlert('Anda telah keluar.');
            showAuth();
        }

        // LOAD PRODUCTS
        async function loadProducts() {
            const token = localStorage.getItem('token');
            const tbody = document.getElementById('tableBody');

            try {
                const res = await fetch(`${API_URL}/products`, {
                    headers: { 'Authorization': `Bearer ${token}`, 'Accept': 'application/json' }
                });
                const json = await res.json();

                if (res.ok && json.data) {
                    productsData = json.data;
                    renderTable(productsData);
                } else {
                    tbody.innerHTML = '<tr><td colspan="7" style="text-align:center; color:#dc2626;">Gagal memuat produk.</td></tr>';
                }
            } catch (err) {
                tbody.innerHTML = '<tr><td colspan="7" style="text-align:center; color:#dc2626;">Error: ' + err.message + '</td></tr>';
            }
        }

        // RENDER TABLE
        function renderTable(data) {
            const tbody = document.getElementById('tableBody');
            if (!data || data.length === 0) {
                tbody.innerHTML = '<tr><td colspan="7" style="text-align:center; color:#6b7280; padding:20px;">Belum ada data produk.</td></tr>';
                return;
            }

            tbody.innerHTML = data.map(item => {
                const priceFormatted = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(item.price);
                const thumb = item.img_url 
                    ? `<img src="${item.img_url}" class="prod-thumb" alt="${item.name}" onerror="this.outerHTML='<div class=\\'no-thumb\\'>No Img</div>'">`
                    : `<div class="no-thumb">No Img</div>`;

                const catName = item.category ? item.category.name : '-';

                return `
                    <tr>
                        <td>${thumb}</td>
                        <td>
                            <strong>${escapeHtml(item.name)}</strong>
                            <div style="font-size: 11px; color: #6b7280;">slug: ${escapeHtml(item.slug || '')}</div>
                        </td>
                        <td>${escapeHtml(item.artist || '-')}</td>
                        <td>${escapeHtml(catName)}</td>
                        <td><strong>${priceFormatted}</strong></td>
                        <td>${item.stock}</td>
                        <td style="text-align: right;">
                            <a class="btn-action-edit" onclick="openEditModal(${item.id})">Edit</a>
                            <a class="btn-action-delete" onclick="handleDelete(${item.id})">Hapus</a>
                        </td>
                    </tr>
                `;
            }).join('');
        }

        // FILTER SEARCH & CATEGORY
        function filterTable() {
            const query = document.getElementById('searchBox').value.toLowerCase();
            const cat = document.getElementById('catSelect').value.toLowerCase();

            const filtered = productsData.filter(item => {
                const matchName = (item.name && item.name.toLowerCase().includes(query)) ||
                                  (item.artist && item.artist.toLowerCase().includes(query));
                const matchCat = cat === '' || (item.category && item.category.name && item.category.name.toLowerCase().includes(cat));
                return matchName && matchCat;
            });

            renderTable(filtered);
        }

        // PREVIEW FILE
        function previewFile(input) {
            const wrap = document.getElementById('previewWrap');
            const img = document.getElementById('previewImg');
            const name = document.getElementById('previewName');

            if (input.files && input.files[0]) {
                const file = input.files[0];
                const reader = new FileReader();
                reader.onload = function(e) {
                    img.src = e.target.result;
                    name.textContent = file.name;
                    wrap.style.display = 'flex';
                };
                reader.readAsDataURL(file);
            }
        }

        // MODAL
        function openCreateModal() {
            document.getElementById('modalTitle').textContent = 'Tambah Produk Baru';
            document.getElementById('prodId').value = '';
            document.getElementById('productForm').reset();
            document.getElementById('previewWrap').style.display = 'none';
            document.getElementById('productModal').classList.add('active');
        }

        function openEditModal(id) {
            const item = productsData.find(p => p.id === id);
            if (!item) return;

            document.getElementById('modalTitle').textContent = 'Edit Produk';
            document.getElementById('prodId').value = item.id;
            document.getElementById('prodName').value = item.name;
            document.getElementById('prodArtist').value = item.artist || '';
            document.getElementById('prodFormat').value = item.format || '';
            document.getElementById('prodCategory').value = item.category ? item.category.id : 1;
            document.getElementById('prodPrice').value = item.price;
            document.getElementById('prodStock').value = item.stock;
            document.getElementById('prodDesc').value = item.description || '';

            const wrap = document.getElementById('previewWrap');
            if (item.img_url) {
                document.getElementById('previewImg').src = item.img_url;
                document.getElementById('previewName').textContent = 'Gambar tersimpan di storage';
                wrap.style.display = 'flex';
            } else {
                wrap.style.display = 'none';
            }

            document.getElementById('productModal').classList.add('active');
        }

        function closeModal() {
            document.getElementById('productModal').classList.remove('active');
        }

        // SUBMIT (CREATE / UPDATE WITH STORAGE FILE)
        async function handleProductSubmit(e) {
            e.preventDefault();
            const token = localStorage.getItem('token');
            const id = document.getElementById('prodId').value;
            const btn = document.getElementById('btnSaveProd');

            btn.disabled = true;
            btn.textContent = 'Menyimpan...';

            const formData = new FormData();
            formData.append('name', document.getElementById('prodName').value);
            formData.append('artist', document.getElementById('prodArtist').value);
            formData.append('format', document.getElementById('prodFormat').value);
            formData.append('category_id', document.getElementById('prodCategory').value);
            formData.append('price', document.getElementById('prodPrice').value);
            formData.append('stock', document.getElementById('prodStock').value);
            formData.append('description', document.getElementById('prodDesc').value);

            const file = document.getElementById('prodImg').files[0];
            if (file) {
                formData.append('img', file);
            }

            let url = `${API_URL}/products`;
            if (id) {
                url = `${API_URL}/products/${id}`;
                formData.append('_method', 'PUT');
            }

            try {
                const res = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json'
                    },
                    body: formData
                });

                const data = await res.json();
                if (res.ok) {
                    showAlert(id ? 'Produk berhasil diubah.' : 'Produk baru dan gambar berhasil disimpan.');
                    closeModal();
                    loadProducts();
                } else {
                    showAlert(data.message || 'Gagal menyimpan produk.', false);
                }
            } catch (err) {
                showAlert('Terjadi kesalahan koneksi.', false);
            } finally {
                btn.disabled = false;
                btn.textContent = 'Simpan';
            }
        }

        // DELETE
        async function handleDelete(id) {
            if (!confirm('Apakah Anda yakin ingin menghapus produk ini?')) return;

            const token = localStorage.getItem('token');
            try {
                const res = await fetch(`${API_URL}/products/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json'
                    }
                });

                if (res.ok) {
                    showAlert('Produk berhasil dihapus.');
                    loadProducts();
                } else {
                    showAlert('Gagal menghapus produk.', false);
                }
            } catch (err) {
                showAlert('Terjadi kesalahan koneksi.', false);
            }
        }

        function escapeHtml(str) {
            if (!str) return '';
            return str.toString()
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#039;');
        }
    </script>
</body>
</html>

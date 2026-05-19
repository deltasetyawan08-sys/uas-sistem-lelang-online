<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sistem Lelang Online Terintegrasi</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            color: #1f2937;
        }

        .sidebar {
            width: 240px;
            height: 100vh;
            background: #111827;
            color: white;
            position: fixed;
            padding: 25px 20px;
        }

        .sidebar h2 {
            font-size: 20px;
            margin-bottom: 30px;
        }

        .menu button {
            width: 100%;
            margin-bottom: 10px;
            padding: 12px;
            border: none;
            border-radius: 8px;
            background: #1f2937;
            color: white;
            cursor: pointer;
            text-align: left;
        }

        .menu button.active,
        .menu button:hover {
            background: #2563eb;
        }

        .content {
            margin-left: 280px;
            padding: 30px;
        }

        .header {
            background: linear-gradient(135deg, #2563eb, #1e40af);
            color: white;
            padding: 25px;
            border-radius: 15px;
            margin-bottom: 25px;
        }

        .card {
            background: white;
            padding: 22px;
            border-radius: 14px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.06);
            margin-bottom: 25px;
        }

        h3 {
            margin-top: 0;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 14px;
        }

        input, select, textarea {
            padding: 11px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            width: 100%;
            box-sizing: border-box;
        }

        textarea {
            grid-column: span 2;
        }

        .btn {
            padding: 11px 18px;
            border: none;
            border-radius: 8px;
            color: white;
            cursor: pointer;
            margin-top: 15px;
        }

        .btn-primary { background: #2563eb; }
        .btn-danger { background: #dc2626; }
        .btn-warning { background: #f59e0b; }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        th {
            background: #f3f4f6;
            text-align: left;
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid #e5e7eb;
        }

        .badge {
            padding: 5px 9px;
            border-radius: 20px;
            font-size: 12px;
            background: #dbeafe;
            color: #1e40af;
        }
    </style>
</head>

<body>

<div class="sidebar">
    <h2>🏆 Lelang Online</h2>
    <div class="menu">
        <button class="active" onclick="showModule('barang')">📦 Barang Lelang</button>
        <button onclick="showModule('peserta')">👥 Peserta</button>
        <button onclick="showModule('panitia')">🧑‍💼 Panitia</button>
        <button onclick="showModule('penawaran')">💰 Penawaran</button>
        <button onclick="showModule('pemenang')">🏅 Pemenang</button>
    </div>
</div>

<div class="content">
    <div class="header">
        <h1>Sistem Lelang Online Terintegrasi</h1>
        <p>RESTful API Laravel + Frontend jQuery AJAX tanpa reload halaman</p>
    </div>

    <div id="barang" class="module">
        <div class="card">
            <h3>Form Barang Lelang</h3>
            <form id="formBarang">
                <div class="form-grid">
                    <input type="text" id="nama_barang" placeholder="Nama Barang" required>
                    <input type="number" id="harga_awal" placeholder="Harga Awal" required>
                    <select id="status" required>
                        <option value="draft">Draft</option>
                        <option value="aktif">Aktif</option>
                        <option value="selesai">Selesai</option>
                        <option value="dibatalkan">Dibatalkan</option>
                    </select>
                    <input type="date" id="tanggal_mulai">
                    <input type="date" id="tanggal_selesai">
                    <textarea id="deskripsi" placeholder="Deskripsi Barang"></textarea>
                </div>
                <button class="btn btn-primary" type="submit">Simpan Barang</button>
            </form>
        </div>

        <div class="card">
            <h3>Data Barang Lelang</h3>
            <table>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Barang</th>
                    <th>Harga Awal</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody id="dataBarang"></tbody>
            </table>
        </div>
    </div>

    <div id="peserta" class="module" style="display:none">
        <div class="card">
            <h3>Modul Peserta Lelang</h3>
            <p>Gunakan endpoint <b>/api/peserta-lelang</b>.</p>
        </div>
    </div>

    <div id="panitia" class="module" style="display:none">
        <div class="card">
            <h3>Modul Panitia</h3>
            <p>Gunakan endpoint <b>/api/panitia</b>.</p>
        </div>
    </div>

    <div id="penawaran" class="module" style="display:none">
        <div class="card">
            <h3>Modul Penawaran</h3>
            <p>Gunakan endpoint <b>/api/penawaran</b>.</p>
        </div>
    </div>

    <div id="pemenang" class="module" style="display:none">
        <div class="card">
            <h3>Modul Pemenang</h3>
            <p>Gunakan endpoint <b>/api/pemenang</b>.</p>
        </div>
    </div>
</div>

<script>
    function showModule(id) {
        $('.module').hide();
        $('#' + id).show();

        $('.menu button').removeClass('active');
        event.target.classList.add('active');
    }

    const apiBarang = '/api/barang-lelang';

    function loadBarang() {
        $.ajax({
            url: apiBarang,
            type: 'GET',
            success: function(response) {
                let html = '';

                $.each(response.data, function(index, item) {
                    html += `
                        <tr>
                            <td>${item.id}</td>
                            <td>${item.nama_barang}</td>
                            <td>Rp ${parseInt(item.harga_awal).toLocaleString('id-ID')}</td>
                            <td><span class="badge">${item.status}</span></td>
                            <td>
                                <button class="btn btn-danger btnHapusBarang" data-id="${item.id}">
                                    Hapus
                                </button>
                            </td>
                        </tr>
                    `;
                });

                $('#dataBarang').html(html);
            },
            error: function() {
                alert('Gagal mengambil data barang lelang.');
            }
        });
    }

    $('#formBarang').submit(function(e) {
        e.preventDefault();

        $.ajax({
            url: apiBarang,
            type: 'POST',
            data: {
                nama_barang: $('#nama_barang').val(),
                deskripsi: $('#deskripsi').val(),
                harga_awal: $('#harga_awal').val(),
                status: $('#status').val(),
                tanggal_mulai: $('#tanggal_mulai').val(),
                tanggal_selesai: $('#tanggal_selesai').val()
            },
            success: function(response) {
                alert(response.message);
                $('#formBarang')[0].reset();
                loadBarang();
            },
            error: function() {
                alert('Gagal menyimpan data barang.');
            }
        });
    });

    $('#dataBarang').on('click', '.btnHapusBarang', function() {
        let id = $(this).data('id');

        if (confirm('Yakin ingin menghapus barang ini?')) {
            $.ajax({
                url: apiBarang + '/' + id,
                type: 'DELETE',
                success: function(response) {
                    alert(response.message);
                    loadBarang();
                },
                error: function() {
                    alert('Gagal menghapus data.');
                }
            });
        }
    });

    $(document).ready(function() {
        loadBarang();
    });
</script>

</body>
</html>
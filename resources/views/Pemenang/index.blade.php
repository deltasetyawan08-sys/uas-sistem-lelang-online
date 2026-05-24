<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Modul Pemenang — Sistem Lelang Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <style>
        body { background: #f4f7fb; font-family: Arial, sans-serif; }

        .sidebar {
            width: 250px; height: 100vh; background: #111827;
            position: fixed; padding: 25px; color: white; top: 0; left: 0; z-index: 100;
        }
        .sidebar h2 { margin-bottom: 35px; font-weight: bold; font-size: 1.1rem; }
        .sidebar button {
            width: 100%; border: none; padding: 14px; margin-bottom: 10px;
            border-radius: 10px; background: #1f2937; color: white;
            text-align: left; transition: 0.3s;
        }
        .sidebar button:hover, .sidebar button.active { background: #2563eb; }

        .main { margin-left: 270px; padding: 30px; }

        .hero {
            background: linear-gradient(135deg, #7c3aed, #4f46e5);
            color: white; padding: 30px 35px; border-radius: 18px; margin-bottom: 25px;
        }

        .card-custom {
            background: white; border-radius: 15px; padding: 25px;
            margin-bottom: 25px; box-shadow: 0 5px 20px rgba(0,0,0,0.06);
        }

        .stat-card {
            background: white; border-radius: 15px; padding: 20px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.06); text-align: center;
        }
        .stat-card .angka { font-size: 2rem; font-weight: bold; color: #4f46e5; }

        .badge-belum  { background: #fee2e2; color: #dc2626; padding: 5px 12px; border-radius: 20px; font-size: 12px; }
        .badge-dp     { background: #fef9c3; color: #ca8a04; padding: 5px 12px; border-radius: 20px; font-size: 12px; }
        .badge-lunas  { background: #dcfce7; color: #16a34a; padding: 5px 12px; border-radius: 20px; font-size: 12px; }

        .table th { white-space: nowrap; }
        .btn-aksi { white-space: nowrap; }

        #alertBox { display: none; }

        .loading-row td { text-align: center; color: #9ca3af; padding: 40px !important; }
    </style>
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <h2>🏆 Lelang Online</h2>
    <button onclick="location.href='/'"><i class="bi bi-grid me-2"></i>Dashboard</button>
    <button onclick="location.href='/'"><i class="bi bi-box me-2"></i>Barang Lelang</button>
    <button onclick="location.href='/'"><i class="bi bi-people me-2"></i>Peserta</button>
    <button onclick="location.href='/'"><i class="bi bi-person-badge me-2"></i>Panitia</button>
    <button onclick="location.href='/'"><i class="bi bi-cash-stack me-2"></i>Penawaran</button>
    <button class="active"><i class="bi bi-trophy me-2"></i>Pemenang</button>
</div>

<!-- MAIN CONTENT -->
<div class="main">

    <!-- HERO -->
    <div class="hero">
        <h1 class="fw-bold mb-1"><i class="bi bi-trophy-fill me-2"></i>Modul Pemenang</h1>
        <p class="mb-0 opacity-75">Kelola data pemenang lelang — tetapkan otomatis atau input manual</p>
    </div>

    <!-- STATISTIK -->
    <div class="row mb-4 g-3">
        <div class="col-md-3">
            <div class="stat-card">
                <div class="text-muted small mb-1">Total Pemenang</div>
                <div class="angka" id="statTotal">0</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="text-muted small mb-1">Belum Bayar</div>
                <div class="angka text-danger" id="statBelum">0</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="text-muted small mb-1">DP / Cicilan</div>
                <div class="angka text-warning" id="statDp">0</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="text-muted small mb-1">Lunas</div>
                <div class="angka text-success" id="statLunas">0</div>
            </div>
        </div>
    </div>

    <!-- ALERT -->
    <div id="alertBox" class="alert alert-dismissible fade show mb-3" role="alert">
        <span id="alertMsg"></span>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>

    <!-- PANEL TETAPKAN OTOMATIS -->
    <div class="card-custom">
        <h5 class="fw-bold mb-3"><i class="bi bi-magic me-2 text-purple"></i>Tetapkan Pemenang Otomatis</h5>
        <p class="text-muted small">Sistem akan memilih penawaran tertinggi dari barang yang dipilih sebagai pemenang secara otomatis.</p>
        <div class="row g-3 align-items-end">
            <div class="col-md-6">
                <label class="form-label fw-semibold">Pilih Barang Lelang</label>
                <select id="otomatis_barang_id" class="form-select">
                    <option value="">-- Pilih Barang --</option>
                </select>
            </div>
            <div class="col-md-3">
                <button id="btnOtomatis" class="btn btn-purple w-100"
                    style="background:#7c3aed;color:white;border:none;padding:10px 20px;border-radius:8px;">
                    <i class="bi bi-lightning-charge-fill me-1"></i> Tetapkan Otomatis
                </button>
            </div>
        </div>
    </div>

    <!-- FORM INPUT MANUAL -->
    <div class="card-custom">
        <h5 class="fw-bold mb-3" id="formTitle"><i class="bi bi-person-plus me-2 text-primary"></i>Tambah Pemenang Manual</h5>
        <input type="hidden" id="editId">

        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label fw-semibold">Barang Lelang <span class="text-danger">*</span></label>
                <select id="barang_lelang_id" class="form-select" required>
                    <option value="">-- Pilih Barang --</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-semibold">Peserta <span class="text-danger">*</span></label>
                <select id="peserta_lelang_id" class="form-select" required>
                    <option value="">-- Pilih Peserta --</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-semibold">Penawaran (ID) <span class="text-danger">*</span></label>
                <input type="number" id="penawaran_id" class="form-control" placeholder="ID Penawaran" min="1">
            </div>
            <div class="col-md-4">
                <label class="form-label fw-semibold">Harga Menang (Rp) <span class="text-danger">*</span></label>
                <input type="number" id="harga_menang" class="form-control" placeholder="Contoh: 5000000" min="1">
            </div>
            <div class="col-md-4">
                <label class="form-label fw-semibold">Tanggal Menang <span class="text-danger">*</span></label>
                <input type="date" id="tanggal_menang" class="form-control">
            </div>
            <div class="col-md-4">
                <label class="form-label fw-semibold">Status Pembayaran <span class="text-danger">*</span></label>
                <select id="status_pembayaran" class="form-select">
                    <option value="belum_bayar">Belum Bayar</option>
                    <option value="dp">DP / Uang Muka</option>
                    <option value="lunas">Lunas</option>
                </select>
            </div>
        </div>

        <div class="mt-4 d-flex gap-2">
            <button id="btnSimpan" class="btn btn-primary px-4">
                <i class="bi bi-save me-1"></i> <span id="btnSimpanLabel">Simpan Pemenang</span>
            </button>
            <button id="btnBatal" class="btn btn-secondary px-4" style="display:none;">
                <i class="bi bi-x-circle me-1"></i> Batal Edit
            </button>
        </div>
    </div>

    <!-- TABEL DATA PEMENANG -->
    <div class="card-custom">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-bold mb-0"><i class="bi bi-table me-2 text-primary"></i>Data Pemenang Lelang</h5>
            <button id="btnRefresh" class="btn btn-outline-primary btn-sm">
                <i class="bi bi-arrow-clockwise me-1"></i>Refresh
            </button>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Nama Pemenang</th>
                        <th>Harga Menang</th>
                        <th>Tanggal Menang</th>
                        <th>Status Pembayaran</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody id="tabelPemenang">
                    <tr class="loading-row">
                        <td colspan="7">
                            <i class="bi bi-hourglass-split me-2"></i>Memuat data...
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div id="emptyState" style="display:none;" class="text-center py-5 text-muted">
            <i class="bi bi-trophy" style="font-size: 3rem; opacity: 0.3;"></i>
            <p class="mt-3">Belum ada data pemenang.</p>
        </div>
    </div>

</div><!-- end .main -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
const API_PEMENANG  = '/api/pemenang';
const API_BARANG    = '/api/barang-lelang';
const API_PESERTA   = '/api/peserta-lelang';

/* =========================================
   UTILITY
========================================= */
function rupiah(angka) {
    return 'Rp ' + parseInt(angka).toLocaleString('id-ID');
}

function badgeStatus(status) {
    const map = {
        belum_bayar: '<span class="badge-belum">Belum Bayar</span>',
        dp:          '<span class="badge-dp">DP / Uang Muka</span>',
        lunas:       '<span class="badge-lunas">✓ Lunas</span>',
    };
    return map[status] || status;
}

function showAlert(msg, type = 'success') {
    const box = $('#alertBox');
    box.removeClass('alert-success alert-danger alert-warning')
       .addClass('alert-' + type);
    $('#alertMsg').text(msg);
    box.show();
    setTimeout(() => box.fadeOut(), 4000);
}

function resetForm() {
    $('#editId').val('');
    $('#barang_lelang_id, #peserta_lelang_id').val('');
    $('#penawaran_id, #harga_menang, #tanggal_menang').val('');
    $('#status_pembayaran').val('belum_bayar');
    $('#formTitle').html('<i class="bi bi-person-plus me-2 text-primary"></i>Tambah Pemenang Manual');
    $('#btnSimpanLabel').text('Simpan Pemenang');
    $('#btnSimpan').removeClass('btn-warning').addClass('btn-primary');
    $('#btnBatal').hide();
}

/* =========================================
   LOAD DROPDOWN BARANG & PESERTA
========================================= */
function loadDropdownBarang() {
    $.get(API_BARANG, function(res) {
        let opts = '<option value="">-- Pilih Barang --</option>';
        $.each(res.data || [], function(i, item) {
            opts += `<option value="${item.id}">[${item.id}] ${item.nama_barang} (${item.status})</option>`;
        });
        $('#barang_lelang_id, #otomatis_barang_id').html(opts);
    });
}

function loadDropdownPeserta() {
    $.get(API_PESERTA, function(res) {
        let opts = '<option value="">-- Pilih Peserta --</option>';
        $.each(res.data || [], function(i, item) {
            opts += `<option value="${item.id}">[${item.id}] ${item.nama_peserta}</option>`;
        });
        $('#peserta_lelang_id').html(opts);
    });
}

/* =========================================
   LOAD TABEL PEMENANG
========================================= */
function loadPemenang() {
    $('#tabelPemenang').html(`
        <tr class="loading-row">
            <td colspan="7"><i class="bi bi-hourglass-split me-2"></i>Memuat data...</td>
        </tr>
    `);

    $.get(API_PEMENANG, function(res) {
        const data = res.data || [];

        // Update statistik
        $('#statTotal').text(data.length);
        $('#statBelum').text(data.filter(d => d.status_pembayaran === 'belum_bayar').length);
        $('#statDp').text(data.filter(d => d.status_pembayaran === 'dp').length);
        $('#statLunas').text(data.filter(d => d.status_pembayaran === 'lunas').length);

        if (data.length === 0) {
            $('#tabelPemenang').html('');
            $('#emptyState').show();
            return;
        }

        $('#emptyState').hide();
        let html = '';
        $.each(data, function(i, item) {
            const namaBarang  = item.barang_lelang  ? item.barang_lelang.nama_barang   : `ID ${item.barang_lelang_id}`;
            const namaPeserta = item.peserta_lelang ? item.peserta_lelang.nama_peserta : `ID ${item.peserta_lelang_id}`;

            html += `
                <tr>
                    <td>${i + 1}</td>
                    <td><strong>${namaBarang}</strong></td>
                    <td>
                        <i class="bi bi-person-circle me-1 text-primary"></i>${namaPeserta}
                    </td>
                    <td class="fw-semibold text-success">${rupiah(item.harga_menang)}</td>
                    <td>${item.tanggal_menang}</td>
                    <td>${badgeStatus(item.status_pembayaran)}</td>
                    <td class="text-center btn-aksi">
                        <button class="btn btn-warning btn-sm me-1 btnEdit"
                            data-id="${item.id}"
                            data-barang="${item.barang_lelang_id}"
                            data-peserta="${item.peserta_lelang_id}"
                            data-penawaran="${item.penawaran_id}"
                            data-harga="${item.harga_menang}"
                            data-tanggal="${item.tanggal_menang}"
                            data-status="${item.status_pembayaran}">
                            <i class="bi bi-pencil-fill"></i> Edit
                        </button>
                        <button class="btn btn-danger btn-sm btnHapus" data-id="${item.id}">
                            <i class="bi bi-trash-fill"></i> Hapus
                        </button>
                    </td>
                </tr>
            `;
        });
        $('#tabelPemenang').html(html);

    }).fail(function() {
        $('#tabelPemenang').html(`
            <tr class="loading-row">
                <td colspan="7" class="text-danger">
                    <i class="bi bi-exclamation-triangle me-2"></i>Gagal memuat data API.
                </td>
            </tr>
        `);
    });
}

/* =========================================
   SIMPAN / UPDATE PEMENANG
========================================= */
$('#btnSimpan').on('click', function() {
    const id     = $('#editId').val();
    const method = id ? 'PUT' : 'POST';
    const url    = id ? `${API_PEMENANG}/${id}` : API_PEMENANG;

    const payload = {
        barang_lelang_id:  $('#barang_lelang_id').val(),
        peserta_lelang_id: $('#peserta_lelang_id').val(),
        penawaran_id:      $('#penawaran_id').val(),
        harga_menang:      $('#harga_menang').val(),
        tanggal_menang:    $('#tanggal_menang').val(),
        status_pembayaran: $('#status_pembayaran').val(),
    };

    // Validasi sisi klien
    if (!payload.barang_lelang_id || !payload.peserta_lelang_id ||
        !payload.penawaran_id || !payload.harga_menang || !payload.tanggal_menang) {
        showAlert('Semua field wajib diisi!', 'warning');
        return;
    }

    $('#btnSimpan').prop('disabled', true).html('<i class="bi bi-hourglass-split me-1"></i>Menyimpan...');

    $.ajax({
        url:  url,
        type: method,
        data: payload,
        success: function(res) {
            showAlert(res.message || 'Data berhasil disimpan.', 'success');
            resetForm();
            loadPemenang();
        },
        error: function(xhr) {
            const err = xhr.responseJSON;
            if (err && err.errors) {
                const pesan = Object.values(err.errors).flat().join(' | ');
                showAlert('Validasi gagal: ' + pesan, 'danger');
            } else {
                showAlert(err?.message || 'Terjadi kesalahan.', 'danger');
            }
        },
        complete: function() {
            $('#btnSimpan').prop('disabled', false)
                .html('<i class="bi bi-save me-1"></i> <span id="btnSimpanLabel">' +
                    ($('#editId').val() ? 'Update Pemenang' : 'Simpan Pemenang') + '</span>');
        }
    });
});

/* =========================================
   EDIT PEMENANG
========================================= */
$('#tabelPemenang').on('click', '.btnEdit', function() {
    const d = $(this).data();
    $('#editId').val(d.id);
    $('#barang_lelang_id').val(d.barang);
    $('#peserta_lelang_id').val(d.peserta);
    $('#penawaran_id').val(d.penawaran);
    $('#harga_menang').val(d.harga);
    $('#tanggal_menang').val(d.tanggal);
    $('#status_pembayaran').val(d.status);

    $('#formTitle').html('<i class="bi bi-pencil-fill me-2 text-warning"></i>Edit Data Pemenang');
    $('#btnSimpanLabel').text('Update Pemenang');
    $('#btnSimpan').removeClass('btn-primary').addClass('btn-warning');
    $('#btnBatal').show();

    window.scrollTo({ top: document.querySelector('.card-custom').offsetTop - 20, behavior: 'smooth' });
});

/* =========================================
   HAPUS PEMENANG
========================================= */
$('#tabelPemenang').on('click', '.btnHapus', function() {
    const id = $(this).data('id');
    if (!confirm('Yakin ingin menghapus data pemenang ini?')) return;

    $.ajax({
        url:  `${API_PEMENANG}/${id}`,
        type: 'DELETE',
        success: function(res) {
            showAlert(res.message || 'Data berhasil dihapus.', 'success');
            loadPemenang();
        },
        error: function() {
            showAlert('Gagal menghapus data.', 'danger');
        }
    });
});

/* =========================================
   TETAPKAN OTOMATIS
========================================= */
$('#btnOtomatis').on('click', function() {
    const barangId = $('#otomatis_barang_id').val();
    if (!barangId) {
        showAlert('Pilih barang lelang terlebih dahulu!', 'warning');
        return;
    }

    if (!confirm('Tetapkan pemenang otomatis dari penawaran tertinggi untuk barang ini?')) return;

    $(this).prop('disabled', true).html('<i class="bi bi-hourglass-split me-1"></i>Memproses...');

    $.ajax({
        url:  '/api/pemenang/tetapkan-otomatis',
        type: 'POST',
        data: { barang_lelang_id: barangId },
        success: function(res) {
            showAlert(res.message || 'Pemenang berhasil ditetapkan!', 'success');
            loadPemenang();
            $('#otomatis_barang_id').val('');
        },
        error: function(xhr) {
            const err = xhr.responseJSON;
            showAlert(err?.message || 'Gagal menetapkan pemenang.', 'danger');
        },
        complete: function() {
            $('#btnOtomatis').prop('disabled', false)
                .html('<i class="bi bi-lightning-charge-fill me-1"></i> Tetapkan Otomatis');
        }
    });
});

/* =========================================
   BATAL EDIT & REFRESH
========================================= */
$('#btnBatal').on('click', resetForm);
$('#btnRefresh').on('click', loadPemenang);

/* =========================================
   INIT
========================================= */
$(document).ready(function() {
    loadDropdownBarang();
    loadDropdownPeserta();
    loadPemenang();
    // Set default tanggal = hari ini
    $('#tanggal_menang').val(new Date().toISOString().split('T')[0]);
});
</script>
</body>
</html>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sistem Lelang Online Terintegrasi</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <style>

        body{
            background:#f4f7fb;
            font-family:Arial;
        }

        .sidebar{
            width:250px;
            height:100vh;
            background:#111827;
            position:fixed;
            padding:25px;
            color:white;
        }

        .sidebar h2{
            margin-bottom:35px;
            font-weight:bold;
        }

        .sidebar button{
            width:100%;
            border:none;
            padding:14px;
            margin-bottom:10px;
            border-radius:10px;
            background:#1f2937;
            color:white;
            text-align:left;
            transition:0.3s;
        }

        .sidebar button:hover{
            background:#2563eb;
        }

        .main{
            margin-left:270px;
            padding:30px;
        }

        .hero{
            background:linear-gradient(135deg,#2563eb,#1d4ed8);
            color:white;
            padding:35px;
            border-radius:18px;
            margin-bottom:25px;
        }

        .stat-card{
            background:white;
            border-radius:15px;
            padding:20px;
            box-shadow:0 5px 20px rgba(0,0,0,0.06);
        }

        .card-custom{
            background:white;
            border-radius:15px;
            padding:25px;
            margin-top:25px;
            box-shadow:0 5px 20px rgba(0,0,0,0.06);
        }

        table{
            width:100%;
        }

        .module{
            display:none;
        }

        #barang{
            display:block;
        }

        .badge-status{
            padding:7px 12px;
            border-radius:20px;
            background:#dbeafe;
            color:#1d4ed8;
            font-size:12px;
        }

        .badge-belum { background: #fee2e2; color: #dc2626; padding: 5px 12px; border-radius: 20px; font-size: 12px; display:inline-block; }
        .badge-dp    { background: #fef9c3; color: #ca8a04; padding: 5px 12px; border-radius: 20px; font-size: 12px; display:inline-block; }
        .badge-lunas { background: #dcfce7; color: #16a34a; padding: 5px 12px; border-radius: 20px; font-size: 12px; display:inline-block; }

        .loading-row td { text-align: center; color: #9ca3af; padding: 40px !important; }
        .btn-aksi { white-space: nowrap; }
        #pemenangAlertBox { display: none; }

        .stat-pemenang {
            background: white; border-radius: 15px; padding: 20px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.06); text-align: center;
        }
        .stat-pemenang .angka { font-size: 2rem; font-weight: bold; color: #4f46e5; }

    </style>

</head>

<body>

<div class="sidebar">

    <h2>🏆 Lelang Online</h2>

    <button onclick="showModule('barang')">
        📦 Barang Lelang
    </button>

    <button onclick="showModule('peserta')">
        👥 Peserta
    </button>

    <button onclick="showModule('panitia')">
        🧑‍💼 Panitia
    </button>

    <button onclick="showModule('penawaran')">
        💰 Penawaran
    </button>

    <button onclick="showModule('pemenang')">
        🏅 Pemenang
    </button>

</div>

<div class="main">

    <div class="hero">

        <h1 class="fw-bold">
            Sistem Lelang Online Terintegrasi
        </h1>

        <p>
            Laravel 12 REST API + Frontend jQuery AJAX Tanpa Reload Halaman
        </p>

    </div>

    <div class="row">

        <div class="col-md-3">
            <div class="stat-card">
                <h5>Total Barang</h5>
                <h2 id="totalBarang">0</h2>
            </div>
        </div>

        <div class="col-md-3">
            <div class="stat-card">
                <h5>Total Peserta</h5>
                <h2 id="totalPeserta">0</h2>
            </div>
        </div>

        <div class="col-md-3">
            <div class="stat-card">
                <h5>Total Penawaran</h5>
                <h2 id="totalPenawaran">0</h2>
            </div>
        </div>

        <div class="col-md-3">
            <div class="stat-card">
                <h5>Total Pemenang</h5>
                <h2 id="totalPemenang">0</h2>
            </div>
        </div>

    </div>

    <!-- BARANG -->
    <div id="barang" class="module">

        <div class="card-custom">

            <h3 class="mb-4">
                Modul Barang Lelang
            </h3>

            <form id="formBarang">

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <input type="text"
                               id="nama_barang"
                               class="form-control"
                               placeholder="Nama Barang">
                    </div>

                    <div class="col-md-6 mb-3">
                        <input type="number"
                               id="harga_awal"
                               class="form-control"
                               placeholder="Harga Awal">
                    </div>

                    <div class="col-md-6 mb-3">
                        <select id="status"
                                class="form-select">

                            <option value="draft">Draft</option>
                            <option value="aktif">Aktif</option>
                            <option value="selesai">Selesai</option>

                        </select>
                    </div>

                </div>

                <button class="btn btn-primary">
                    Simpan Barang
                </button>

            </form>

        </div>

        <div class="card-custom">

            <h4 class="mb-3">
                Data Barang Lelang
            </h4>

            <table class="table table-hover">

                <thead class="table-dark">

                <tr>
                    <th>ID</th>
                    <th>Nama Barang</th>
                    <th>Harga</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>

                </thead>

                <tbody id="dataBarang"></tbody>

            </table>

        </div>

    </div>

    <!-- PESERTA -->
    <div id="peserta" class="module">

        <div class="card-custom">

            <h3 class="mb-4">
                Modul Peserta Lelang
            </h3>

            <form id="formPeserta">

                <input type="hidden" id="peserta_id">

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <input type="text"
                               id="nama_peserta"
                               class="form-control"
                               placeholder="Nama Peserta">
                    </div>

                    <div class="col-md-6 mb-3">
                        <input type="email"
                               id="email_peserta"
                               class="form-control"
                               placeholder="Email">
                    </div>

                    <div class="col-md-6 mb-3">
                        <input type="text"
                               id="no_hp"
                               class="form-control"
                               placeholder="Nomor HP">
                    </div>

                    <div class="col-md-6 mb-3">
                        <select id="status_verifikasi"
                                class="form-select">

                            <option value="pending">Pending</option>
                            <option value="terverifikasi">Terverifikasi</option>
                            <option value="ditolak">Ditolak</option>

                        </select>
                    </div>

                    <div class="col-md-12 mb-3">
                        <textarea id="alamat"
                                  class="form-control"
                                  rows="3"
                                  placeholder="Alamat"></textarea>
                    </div>

                </div>

                <button type="submit"
                        class="btn btn-primary"
                        id="btnSubmitPeserta">

                    Simpan Peserta

                </button>

                <button type="button"
                        class="btn btn-secondary"
                        id="btnBatalEdit"
                        style="display:none;">

                    Batal

                </button>

            </form>

        </div>

        <div class="card-custom">

            <h4 class="mb-3">
                Data Peserta Lelang
            </h4>

            <table class="table table-hover">

                <thead class="table-primary">

                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>No HP</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>

                </thead>

                <tbody id="dataPeserta"></tbody>

            </table>

        </div>

    </div>

    <!-- PANITIA -->
    <div id="panitia" class="module">

        <div class="card-custom">

            <h3>Data Panitia</h3>

            <table class="table table-striped">

                <thead class="table-warning">

                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                </tr>

                </thead>

                <tbody id="dataPanitia"></tbody>

            </table>

        </div>

    </div>

    <!-- PENAWARAN -->
    <div id="penawaran" class="module">

        <div class="card-custom">

            <h3>Data Penawaran</h3>

            <table class="table table-striped">

                <thead class="table-success">

                <tr>
                    <th>ID</th>
                    <th>Nominal</th>
                </tr>

                </thead>

                <tbody id="dataPenawaran"></tbody>

            </table>

        </div>

    </div>

    <!-- PEMENANG -->
    <div id="pemenang" class="module">

        <!-- Statistik Pemenang -->
        <div class="row mb-4 g-3 mt-1">
            <div class="col-md-3">
                <div class="stat-pemenang">
                    <div class="text-muted small mb-1">Total Pemenang</div>
                    <div class="angka" id="statTotal">0</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-pemenang">
                    <div class="text-muted small mb-1">Belum Bayar</div>
                    <div class="angka text-danger" id="statBelum">0</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-pemenang">
                    <div class="text-muted small mb-1">DP / Cicilan</div>
                    <div class="angka text-warning" id="statDp">0</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-pemenang">
                    <div class="text-muted small mb-1">Lunas</div>
                    <div class="angka text-success" id="statLunas">0</div>
                </div>
            </div>
        </div>

        <!-- Alert -->
        <div id="pemenangAlertBox" class="alert alert-dismissible fade show mb-3" role="alert">
            <span id="pemenangAlertMsg"></span>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>

        <!-- Tetapkan Otomatis -->
        <div class="card-custom">
            <h5 class="fw-bold mb-3"><i class="bi bi-lightning-charge-fill me-2 text-warning"></i>Tetapkan Pemenang Otomatis</h5>
            <p class="text-muted small">Sistem akan memilih penawaran tertinggi dari barang yang dipilih sebagai pemenang secara otomatis.</p>
            <div class="row g-3 align-items-end">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Pilih Barang Lelang</label>
                    <select id="otomatis_barang_id" class="form-select">
                        <option value="">-- Pilih Barang --</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <button id="btnOtomatis" class="btn w-100"
                        style="background:#7c3aed;color:white;border:none;padding:10px 20px;border-radius:8px;">
                        <i class="bi bi-lightning-charge-fill me-1"></i> Tetapkan Otomatis
                    </button>
                </div>
            </div>
        </div>

        <!-- Form Input Manual -->
        <div class="card-custom">
            <h5 class="fw-bold mb-3" id="formPemenangTitle"><i class="bi bi-person-plus me-2 text-primary"></i>Tambah Pemenang Manual</h5>
            <input type="hidden" id="editPemenangId">

            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Barang Lelang <span class="text-danger">*</span></label>
                    <select id="pm_barang_lelang_id" class="form-select" required>
                        <option value="">-- Pilih Barang --</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Peserta <span class="text-danger">*</span></label>
                    <select id="pm_peserta_lelang_id" class="form-select" required>
                        <option value="">-- Pilih Peserta --</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Penawaran (ID) <span class="text-danger">*</span></label>
                    <input type="number" id="pm_penawaran_id" class="form-control" placeholder="ID Penawaran" min="1">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Harga Menang (Rp) <span class="text-danger">*</span></label>
                    <input type="number" id="pm_harga_menang" class="form-control" placeholder="Contoh: 5000000" min="1">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Tanggal Menang <span class="text-danger">*</span></label>
                    <input type="date" id="pm_tanggal_menang" class="form-control">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Status Pembayaran <span class="text-danger">*</span></label>
                    <select id="pm_status_pembayaran" class="form-select">
                        <option value="belum_bayar">Belum Bayar</option>
                        <option value="dp">DP / Uang Muka</option>
                        <option value="lunas">Lunas</option>
                    </select>
                </div>
            </div>

            <div class="mt-4 d-flex gap-2">
                <button id="btnSimpanPemenang" class="btn btn-primary px-4">
                    <i class="bi bi-save me-1"></i> <span id="btnSimpanPemenangLabel">Simpan Pemenang</span>
                </button>
                <button id="btnBatalPemenang" class="btn btn-secondary px-4" style="display:none;">
                    <i class="bi bi-x-circle me-1"></i> Batal Edit
                </button>
            </div>
        </div>

        <!-- Tabel Data Pemenang -->
        <div class="card-custom">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold mb-0"><i class="bi bi-trophy me-2 text-warning"></i>Data Pemenang Lelang</h5>
                <button id="btnRefreshPemenang" class="btn btn-outline-primary btn-sm">
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
                            <td colspan="7"><i class="bi bi-hourglass-split me-2"></i>Memuat data...</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div id="pemenangEmptyState" style="display:none;" class="text-center py-5 text-muted">
                <i class="bi bi-trophy" style="font-size: 3rem; opacity: 0.3;"></i>
                <p class="mt-3">Belum ada data pemenang.</p>
            </div>
        </div>

    </div>

</div>

<script>

function showModule(id){

    $('.module').hide();
    $('#' + id).show();

}

/* =========================
   BARANG
========================= */

const apiBarang = '/api/barang-lelang';

function loadBarang(){

    $.get(apiBarang,function(response){

        $('#totalBarang').text(response.data.length);

        let html = '';

        $.each(response.data,function(i,item){

            html += `
                <tr>

                    <td>${item.id}</td>

                    <td>${item.nama_barang}</td>

                    <td>
                        Rp ${parseInt(item.harga_awal).toLocaleString('id-ID')}
                    </td>

                    <td>
                        <span class="badge-status">
                            ${item.status}
                        </span>
                    </td>

                    <td>

                        <button
                            class="btn btn-danger btn-sm hapusBarang"
                            data-id="${item.id}">

                            Hapus

                        </button>

                    </td>

                </tr>
            `;
        });

        $('#dataBarang').html(html);

    });

}

$('#formBarang').submit(function(e){

    e.preventDefault();

    $.ajax({

        url:apiBarang,
        type:'POST',

        data:{
            nama_barang:$('#nama_barang').val(),
            harga_awal:$('#harga_awal').val(),
            status:$('#status').val()
        },

        success:function(){

            $('#formBarang')[0].reset();

            loadBarang();

        }

    });

});

$('#dataBarang').on('click','.hapusBarang',function(){

    let id = $(this).data('id');

    $.ajax({

        url:apiBarang + '/' + id,
        type:'DELETE',

        success:function(){

            loadBarang();

        }

    });

});

/* =========================
   PESERTA
========================= */

const apiPeserta = '/api/peserta-lelang';

function loadPeserta(){

    $.get(apiPeserta,function(response){

        $('#totalPeserta').text(response.data.length);

        let html='';

        $.each(response.data,function(i,item){

            html += `
                <tr>

                    <td>${item.id}</td>

                    <td>${item.nama_peserta}</td>

                    <td>${item.email}</td>

                    <td>${item.no_hp}</td>

                    <td>
                        <span class="badge-status">
                            ${item.status_verifikasi}
                        </span>
                    </td>

                    <td>

                        <button
                            class="btn btn-warning btn-sm editPeserta"
                            data-id="${item.id}"
                            data-nama="${item.nama_peserta}"
                            data-email="${item.email}"
                            data-nohp="${item.no_hp}"
                            data-alamat="${item.alamat ?? ''}"
                            data-status="${item.status_verifikasi}">

                            Edit

                        </button>

                        <button
                            class="btn btn-danger btn-sm hapusPeserta"
                            data-id="${item.id}">

                            Hapus

                        </button>

                    </td>

                </tr>
            `;
        });

        $('#dataPeserta').html(html);

    });

}

$('#formPeserta').submit(function(e){

    e.preventDefault();

    let id = $('#peserta_id').val();

    let method = id ? 'PUT' : 'POST';

    let url = id
        ? apiPeserta + '/' + id
        : apiPeserta;

    $.ajax({

        url: url,
        type: method,

        data:{
            nama_peserta: $('#nama_peserta').val(),
            email: $('#email_peserta').val(),
            no_hp: $('#no_hp').val(),
            alamat: $('#alamat').val(),
            status_verifikasi: $('#status_verifikasi').val()
        },

        success:function(){

            resetFormPeserta();

            loadPeserta();

            alert(id
                ? 'Peserta berhasil diupdate'
                : 'Peserta berhasil ditambahkan');

        },

        error:function(xhr){

            alert('Terjadi kesalahan');

            console.log(xhr.responseText);

        }

    });

});

$('#dataPeserta').on('click','.editPeserta',function(){

    $('#peserta_id').val($(this).data('id'));

    $('#nama_peserta').val($(this).data('nama'));

    $('#email_peserta').val($(this).data('email'));

    $('#no_hp').val($(this).data('nohp'));

    $('#alamat').val($(this).data('alamat'));

    $('#status_verifikasi').val($(this).data('status'));

    $('#btnSubmitPeserta')
        .removeClass('btn-primary')
        .addClass('btn-warning')
        .text('Update Peserta');

    $('#btnBatalEdit').show();

});

$('#btnBatalEdit').click(function(){

    resetFormPeserta();

});

function resetFormPeserta(){

    $('#formPeserta')[0].reset();

    $('#peserta_id').val('');

    $('#btnSubmitPeserta')
        .removeClass('btn-warning')
        .addClass('btn-primary')
        .text('Simpan Peserta');

    $('#btnBatalEdit').hide();

}

$('#dataPeserta').on('click','.hapusPeserta',function(){

    let id = $(this).data('id');

    $.ajax({

        url: apiPeserta + '/' + id,
        type:'DELETE',

        success:function(){

            loadPeserta();

        }

    });

});

/* =========================
   PANITIA
========================= */

function loadPanitia(){

    $.get('/api/panitia',function(response){

        let html='';

        $.each(response.data,function(i,item){

            html += `
                <tr>
                    <td>${item.id}</td>
                    <td>${item.nama_panitia}</td>
                    <td>${item.jabatan}</td>
                </tr>
            `;
        });

        $('#dataPanitia').html(html);

    });

}

/* =========================
   PENAWARAN
========================= */

function loadPenawaran(){

    $.get('/api/penawaran',function(response){

        $('#totalPenawaran').text(response.data.length);

        let html='';

        $.each(response.data,function(i,item){

            html += `
                <tr>
                    <td>${item.id}</td>
                    <td>${item.nilai_penawaran}</td>
                </tr>
            `;
        });

        $('#dataPenawaran').html(html);

    });

}

/* =========================
   PEMENANG - UTILITY
========================= */

function rupiah(angka) {
    return 'Rp ' + parseInt(angka).toLocaleString('id-ID');
}

function badgeStatusPemenang(status) {
    const map = {
        belum_bayar: '<span class="badge-belum">Belum Bayar</span>',
        dp:          '<span class="badge-dp">DP / Uang Muka</span>',
        lunas:       '<span class="badge-lunas">&#10003; Lunas</span>',
    };
    return map[status] || status;
}

function showPemenangAlert(msg, type) {
    type = type || 'success';
    var box = $('#pemenangAlertBox');
    box.removeClass('alert-success alert-danger alert-warning').addClass('alert-' + type);
    $('#pemenangAlertMsg').text(msg);
    box.show();
    setTimeout(function() { box.fadeOut(); }, 4000);
}

function resetFormPemenang() {
    $('#editPemenangId').val('');
    $('#pm_barang_lelang_id, #pm_peserta_lelang_id').val('');
    $('#pm_penawaran_id, #pm_harga_menang, #pm_tanggal_menang').val('');
    $('#pm_status_pembayaran').val('belum_bayar');
    $('#formPemenangTitle').html('<i class="bi bi-person-plus me-2 text-primary"></i>Tambah Pemenang Manual');
    $('#btnSimpanPemenangLabel').text('Simpan Pemenang');
    $('#btnSimpanPemenang').removeClass('btn-warning').addClass('btn-primary');
    $('#btnBatalPemenang').hide();
}

function loadDropdownBarangPemenang() {
    $.get('/api/barang-lelang', function(res) {
        var opts = '<option value="">-- Pilih Barang --</option>';
        $.each(res.data || [], function(i, item) {
            opts += '<option value="' + item.id + '">[' + item.id + '] ' + item.nama_barang + ' (' + item.status + ')</option>';
        });
        $('#pm_barang_lelang_id, #otomatis_barang_id').html(opts);
    });
}

function loadDropdownPesertaPemenang() {
    $.get('/api/peserta-lelang', function(res) {
        var opts = '<option value="">-- Pilih Peserta --</option>';
        $.each(res.data || [], function(i, item) {
            opts += '<option value="' + item.id + '">[' + item.id + '] ' + item.nama_peserta + '</option>';
        });
        $('#pm_peserta_lelang_id').html(opts);
    });
}

function loadPemenang(){
    $('#tabelPemenang').html('<tr class="loading-row"><td colspan="7"><i class="bi bi-hourglass-split me-2"></i>Memuat data...</td></tr>');

    $.get('/api/pemenang', function(res){
        var data = res.data || [];

        $('#totalPemenang').text(data.length);
        $('#statTotal').text(data.length);
        $('#statBelum').text(data.filter(function(d){ return d.status_pembayaran === 'belum_bayar'; }).length);
        $('#statDp').text(data.filter(function(d){ return d.status_pembayaran === 'dp'; }).length);
        $('#statLunas').text(data.filter(function(d){ return d.status_pembayaran === 'lunas'; }).length);

        if (data.length === 0) {
            $('#tabelPemenang').html('');
            $('#pemenangEmptyState').show();
            return;
        }

        $('#pemenangEmptyState').hide();
        var html = '';
        $.each(data, function(i, item){
            var namaBarang  = item.barang_lelang  ? item.barang_lelang.nama_barang   : 'ID ' + item.barang_lelang_id;
            var namaPeserta = item.peserta_lelang ? item.peserta_lelang.nama_peserta : 'ID ' + item.peserta_lelang_id;

            html += '<tr>' +
                '<td>' + (i + 1) + '</td>' +
                '<td><strong>' + namaBarang + '</strong></td>' +
                '<td><i class="bi bi-person-circle me-1 text-primary"></i>' + namaPeserta + '</td>' +
                '<td class="fw-semibold text-success">' + rupiah(item.harga_menang) + '</td>' +
                '<td>' + item.tanggal_menang + '</td>' +
                '<td>' + badgeStatusPemenang(item.status_pembayaran) + '</td>' +
                '<td class="text-center btn-aksi">' +
                    '<button class="btn btn-warning btn-sm me-1 btnEditPemenang" ' +
                        'data-id="' + item.id + '" ' +
                        'data-barang="' + item.barang_lelang_id + '" ' +
                        'data-peserta="' + item.peserta_lelang_id + '" ' +
                        'data-penawaran="' + item.penawaran_id + '" ' +
                        'data-harga="' + item.harga_menang + '" ' +
                        'data-tanggal="' + item.tanggal_menang + '" ' +
                        'data-status="' + item.status_pembayaran + '">' +
                        '<i class="bi bi-pencil-fill"></i> Edit' +
                    '</button>' +
                    '<button class="btn btn-danger btn-sm btnHapusPemenang" data-id="' + item.id + '">' +
                        '<i class="bi bi-trash-fill"></i> Hapus' +
                    '</button>' +
                '</td>' +
            '</tr>';
        });
        $('#tabelPemenang').html(html);

    }).fail(function() {
        $('#tabelPemenang').html('<tr class="loading-row"><td colspan="7" class="text-danger"><i class="bi bi-exclamation-triangle me-2"></i>Gagal memuat data API.</td></tr>');
    });
}

/* =========================
   PEMENANG - EVENTS
========================= */

$('#btnSimpanPemenang').on('click', function() {
    var id      = $('#editPemenangId').val();
    var method  = id ? 'PUT' : 'POST';
    var url     = id ? '/api/pemenang/' + id : '/api/pemenang';

    var payload = {
        barang_lelang_id:  $('#pm_barang_lelang_id').val(),
        peserta_lelang_id: $('#pm_peserta_lelang_id').val(),
        penawaran_id:      $('#pm_penawaran_id').val(),
        harga_menang:      $('#pm_harga_menang').val(),
        tanggal_menang:    $('#pm_tanggal_menang').val(),
        status_pembayaran: $('#pm_status_pembayaran').val(),
    };

    if (!payload.barang_lelang_id || !payload.peserta_lelang_id ||
        !payload.penawaran_id || !payload.harga_menang || !payload.tanggal_menang) {
        showPemenangAlert('Semua field wajib diisi!', 'warning');
        return;
    }

    $('#btnSimpanPemenang').prop('disabled', true).html('<i class="bi bi-hourglass-split me-1"></i>Menyimpan...');

    $.ajax({
        url:  url,
        type: method,
        data: payload,
        success: function(res) {
            showPemenangAlert(res.message || 'Data berhasil disimpan.', 'success');
            resetFormPemenang();
            loadPemenang();
        },
        error: function(xhr) {
            var err = xhr.responseJSON;
            if (err && err.errors) {
                var pesan = Object.values(err.errors).flat().join(' | ');
                showPemenangAlert('Validasi gagal: ' + pesan, 'danger');
            } else {
                showPemenangAlert((err && err.message) ? err.message : 'Terjadi kesalahan.', 'danger');
            }
        },
        complete: function() {
            var label = $('#editPemenangId').val() ? 'Update Pemenang' : 'Simpan Pemenang';
            $('#btnSimpanPemenang').prop('disabled', false)
                .html('<i class="bi bi-save me-1"></i> <span id="btnSimpanPemenangLabel">' + label + '</span>');
        }
    });
});

$('#tabelPemenang').on('click', '.btnEditPemenang', function() {
    var d = $(this).data();
    $('#editPemenangId').val(d.id);
    $('#pm_barang_lelang_id').val(d.barang);
    $('#pm_peserta_lelang_id').val(d.peserta);
    $('#pm_penawaran_id').val(d.penawaran);
    $('#pm_harga_menang').val(d.harga);
    $('#pm_tanggal_menang').val(d.tanggal);
    $('#pm_status_pembayaran').val(d.status);

    $('#formPemenangTitle').html('<i class="bi bi-pencil-fill me-2 text-warning"></i>Edit Data Pemenang');
    $('#btnSimpanPemenangLabel').text('Update Pemenang');
    $('#btnSimpanPemenang').removeClass('btn-primary').addClass('btn-warning');
    $('#btnBatalPemenang').show();

    $('html, body').animate({ scrollTop: $('#pemenang .card-custom').first().offset().top - 20 }, 400);
});

$('#tabelPemenang').on('click', '.btnHapusPemenang', function() {
    var id = $(this).data('id');
    if (!confirm('Yakin ingin menghapus data pemenang ini?')) return;

    $.ajax({
        url:  '/api/pemenang/' + id,
        type: 'DELETE',
        success: function(res) {
            showPemenangAlert(res.message || 'Data berhasil dihapus.', 'success');
            loadPemenang();
        },
        error: function() {
            showPemenangAlert('Gagal menghapus data.', 'danger');
        }
    });
});

$('#btnOtomatis').on('click', function() {
    var barangId = $('#otomatis_barang_id').val();
    if (!barangId) {
        showPemenangAlert('Pilih barang lelang terlebih dahulu!', 'warning');
        return;
    }

    if (!confirm('Tetapkan pemenang otomatis dari penawaran tertinggi untuk barang ini?')) return;

    $(this).prop('disabled', true).html('<i class="bi bi-hourglass-split me-1"></i>Memproses...');

    $.ajax({
        url:  '/api/pemenang/tetapkan-otomatis',
        type: 'POST',
        data: { barang_lelang_id: barangId },
        success: function(res) {
            showPemenangAlert(res.message || 'Pemenang berhasil ditetapkan!', 'success');
            loadPemenang();
            $('#otomatis_barang_id').val('');
        },
        error: function(xhr) {
            var err = xhr.responseJSON;
            showPemenangAlert((err && err.message) ? err.message : 'Gagal menetapkan pemenang.', 'danger');
        },
        complete: function() {
            $('#btnOtomatis').prop('disabled', false)
                .html('<i class="bi bi-lightning-charge-fill me-1"></i> Tetapkan Otomatis');
        }
    });
});

$('#btnBatalPemenang').on('click', resetFormPemenang);
$('#btnRefreshPemenang').on('click', loadPemenang);

/* =========================
   LOAD SEMUA DATA
========================= */

$(document).ready(function(){

    loadBarang();
    loadPeserta();
    loadPanitia();
    loadPenawaran();
    loadPemenang();
    loadDropdownBarangPemenang();
    loadDropdownPesertaPemenang();
    $('#pm_tanggal_menang').val(new Date().toISOString().split('T')[0]);

});

</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
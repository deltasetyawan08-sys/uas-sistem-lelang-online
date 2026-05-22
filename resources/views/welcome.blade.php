<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sistem Lelang Online Terintegrasi</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

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

        <div class="card-custom">

            <h3>Data Pemenang</h3>

            <table class="table table-striped">

                <thead class="table-danger">

                <tr>
                    <th>ID</th>
                    <th>Harga Menang</th>
                </tr>

                </thead>

                <tbody id="dataPemenang"></tbody>

            </table>

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
   PEMENANG
========================= */

function loadPemenang(){

    $.get('/api/pemenang',function(response){

        $('#totalPemenang').text(response.data.length);

        let html='';

        $.each(response.data,function(i,item){

            html += `
                <tr>
                    <td>${item.id}</td>
                    <td>${item.harga_menang}</td>
                </tr>
            `;
        });

        $('#dataPemenang').html(html);

    });

}

/* =========================
   LOAD SEMUA DATA
========================= */

$(document).ready(function(){

    loadBarang();
    loadPeserta();
    loadPanitia();
    loadPenawaran();
    loadPemenang();

});

</script>

</body>
</html>
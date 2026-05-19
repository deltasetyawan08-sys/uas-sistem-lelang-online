<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sistem Lelang Online Terintegrasi</title>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body{background:#f6f8fb}.card{border:0;box-shadow:0 6px 18px rgba(15,23,42,.08)}
    .nav-pills .nav-link{margin-right:8px}.table td,.table th{vertical-align:middle}.small-muted{font-size:12px;color:#64748b}
  </style>
</head>
<body>
<div class="container py-4">
  <div class="mb-4">
    <h2 class="fw-bold">Sistem Lelang Online Terintegrasi</h2>
    <p class="text-muted mb-0">Prototype UAS Pemrograman Web: RESTful API Laravel 12 + Frontend jQuery AJAX.</p>
  </div>
  <ul class="nav nav-pills mb-3" id="moduleTabs"></ul>
  <div class="card"><div class="card-body">
    <h4 id="moduleTitle" class="mb-3"></h4>
    <form id="dataForm" class="row g-3 mb-4"></form>
    <div class="d-flex gap-2 mb-3">
      <button class="btn btn-primary" id="btnSubmit">Simpan Data</button>
      <button class="btn btn-secondary" id="btnReset" type="button">Reset Form</button>
    </div>
    <div class="table-responsive"><table class="table table-striped" id="dataTable"><thead></thead><tbody></tbody></table></div>
  </div></div>
</div>
<script src="/js/lelang.js"></script>
</body>
</html>

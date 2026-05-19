# Panduan GitHub UAS

## Branch yang disarankan
- `feat/modul-barang-lelang`
- `feat/modul-peserta-lelang`
- `feat/modul-panitia`
- `feat/modul-penawaran`
- `feat/modul-pemenang`

## Perintah kerja anggota
```bash
git checkout main
git pull origin main
git checkout -b feat/modul-barang-lelang
# kerjakan file modul
git add .
git commit -m "feat: menambahkan CRUD modul barang lelang"
git pull origin main
git push origin feat/modul-barang-lelang
```

Setelah push, buat Pull Request di GitHub dan minta review dari anggota lain sebelum merge.

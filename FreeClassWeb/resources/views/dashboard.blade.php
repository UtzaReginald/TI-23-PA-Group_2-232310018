@php
    use Carbon\Carbon;
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <!-- // ======= Bootstrap CDN ======= -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>

    <!-- // ======= Style Section ======= -->
    <style>
    /* ======= Tabel Style ======= */
    .table1 {
        padding: 15px;
        border-spacing: 20px;
        width: 100%;
        border-collapse: separate;
        margin-top: 15px;
    }

    .table2 {
        border: none;
        border-radius: 12px;
        background-color: #fff;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        overflow: hidden;
        width: 100%;
        table-layout: fixed;
    }

    .table2 th {
        background-color: #f3f3f3;
        color: #333;
        font-weight: 600;
        padding: 12px;
        text-align: left;
        z-index: 10;
    }

    .table2 td {
        padding: 12px;
        color: #444;
        background-color: #fff;
        border-bottom: 1px solid #e5e5e5;
        word-wrap: break-word;
    }

    .table2 tr:last-child td {
        border-bottom: none;
    }

    .table2 thead {
        background-color: #f9f9f9;
    }

    .table2-wrapper {
    overflow-y: auto;
    max-height: 224px;
    }

    .table2-wrapper::-webkit-scrollbar {
        width: 12px; 
    }

    .table2-wrapper:has(table) {
        padding-right: 1px;
    }


        

        /* // ======= Tampilan Umum ======= */
        .topdata { background-color: white; box-shadow: -1px 1px 5px gray; border-radius: 8px; text-align: center; }
        .a { background: linear-gradient(to top, #9933ff, #ffffff); height: 570px; }
        .btn-detail { background-color: #c4a5fc; color: #fff; border: none; font-weight: 500; border-radius: 8px; padding: 6px 16px; transition: 0.3s; }
        .btn-detail:hover { background-color: #a877f2; color: #fff; }
        .filter-bar { display: flex; justify-content: space-between; align-items: center; padding: 10px 0; }
        body { font-family: 'Segoe UI', sans-serif; }
        h1, h2, h3, h4 { color: #1e1e1e; }
        th, td { font-size: 14px; }
    </style>

    <!-- // ======= Fitur Live Clock & Hari ======= -->
    <script>
        function updateTime() {
            const date = new Date();
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            const day = date.toLocaleDateString(undefined, options);
            document.getElementById('day').innerHTML = day;
        }
        setInterval(updateTime, 1000);
        updateTime();

        function startTime() {
            const today = new Date();
            let h = today.getHours();
            let m = today.getMinutes();
            let s = today.getSeconds();
            m = checkTime(m);
            s = checkTime(s);
            document.getElementById('txt').innerHTML = h + ":" + m + ":" + s;
            setTimeout(startTime, 1000);
        }
        function checkTime(i) {
            if (i < 10) { i = "0" + i; }
            return i;
        }
    </script>
</head>

<body class="m-3 bg-dark d-flex flex-column min-vh-100" onload="startTime()">
<!-- // ======= Layout Dashboard Utama ======= -->
<div class="flex-grow-1">
    <div class="row a rounded">
        <!-- // Sidebar (Logo & Footer) -->
        <div class="col-2 d-flex flex-column align-items-center justify-content-between" style="background: linear-gradient(to top, #9933ff, #ffffff); min-height: 100%;">
            <div class="w-100 d-flex flex-column align-items-center">
                <img src="{{ asset('assets/FREECLASS-LOGO.png') }}" alt="freeclass" width="200" height="200" class="mt-3 mb-2">
            </div>
            <div class="w-100 text-center text-light mb-3" style="font-size: 0.9rem;">
                <small>&copy; {{ date('Y') }} FreeClass oleh Rhainy, Tiur & Utza.</small>
            </div>
        </div>

        <!-- // Konten Utama Dashboard -->
        <div class="col-10 bg-light">
            <div class="container mt-1">
                <h1 class="mb-3"><strong>Dashboard</strong></h1>
                <!-- // ======= Summary Panel (Top Data) ======= -->
                <table class="table1 mb-4">
                    <tr>
                        <td class="topdata align-middle">
                            <h2>Kelas Dipakai</h2>
                            <h3>Saat ini</h3>
                            <h1 style="color:#7c3aed;">{{ $kelasDipakai }}/{{ $totalKelas }}</h1>
                        </td>
                        <td class="topdata align-middle">
                            <h4 id="day"></h4>
                            <h1 id="txt" style="color:#7c3aed;"></h1>
                        </td>
                        <td class="topdata align-middle">
                            <h2>Pending Request</h2>
                            <h3>Saat ini</h3>
                            <h1 style="color:#7c3aed;">{{ $pendingRequest }}</h1>
                        </td>
                    </tr>
                </table>
                <!-- // ======= Tabel Permohonan Peminjaman ======= -->
                <h2>Permohonan Pinjaman</h2>
                

<!-- // ======= Tabel Permohonan Pinjaman (Lanjutan) ======= -->
<div class="container p-3 mb-2 bg-light rounded">
    
    <!-- // ======= Filter Bar ======= -->
    <div class="filter-bar">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="filterHariIni">
            <label class="form-check-label" for="filterHariIni">Hari Ini</label>
        </div>
        <div>
            <select id="filterJabatan" class="form-select form-select-sm" style="width: 120px;">
                <option value="semua" selected>Semua</option>
                <option value="mahasiswa">Mahasiswa</option>
                <option value="dosen">Dosen</option>
                <option value="staff">Staff</option>
                <option value="lainnya">Lainnya</option>
            </select>
        </div>
    </div>

<!-- ======= Tabel Data Peminjaman ======= -->
<div class="bg-white p-3 rounded shadow-sm">

    <!-- Header Table -->
    <table class="table table-bordered table2 mb-0">
        <colgroup>
            <col style="width: 20%;">
            <col style="width: 18%;">
            <col style="width: 15%;">
            <col style="width: 15%;">
            <col style="width: 16%;">
            <col style="width: 12%;">
        </colgroup>
        <thead class="table-light">
            <tr>
                <th>Kode</th>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Tanggal</th>
                <th>Waktu</th>
                <th>Aksi</th>
            </tr>
        </thead>
    </table>

    <!-- Scrollable Tbody -->
    <div class="table2-wrapper">
        <table class="table table-bordered table2 mb-0">
            <colgroup>
                <col style="width: 20%;">
                <col style="width: 18%;">
                <col style="width: 15%;">
                <col style="width: 15%;">
                <col style="width: 16%;">
                <col style="width: 12%;">
            </colgroup>
            <tbody>
                @foreach($data as $row)
                    <tr class="row-peminjaman" data-id="{{ $row->id_peminjaman }}">
                        <td>{{ $row->kode_peminjaman }}</td>
                        <td>{{ $row->nama_peminjam }}</td>
                        <td>{{ $row->jabatan }}</td>
                        <td>{{ \Carbon\Carbon::parse($row->tanggal)->format('d/m/Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($row->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($row->jam_selesai)->format('H:i') }}</td>
                        <td>
                            <button type="button" class="btn btn-secondary"
                                data-bs-toggle="modal"
                                data-bs-target="#detailPermintaanModal"
                                data-id="{{ $row->id_peminjaman }}"
                                data-nama="{{ $row->nama_peminjam }}"
                                data-jabatan="{{ $row->jabatan }}"
                                data-tanggal="{{ \Carbon\Carbon::parse($row->tanggal)->format('d/m/Y') }}"
                                data-tanggal-raw="{{ $row->tanggal }}"
                                data-waktu="{{ \Carbon\Carbon::parse($row->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($row->jam_selesai)->format('H:i') }}"
                                data-tujuan="{{ $row->tujuan }}"
                                data-jumlah="{{ $row->jumlah_orang }}"
                                data-ruangan="{{ $row->nama_ruangan }}"
                                data-id_slot="{{ $row->id_slot }}">
                                Detail
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


<!-- // ======= Modal Detail Permintaan ======= -->
<div class="modal fade" id="detailPermintaanModal" tabindex="-1" aria-labelledby="detailPermintaanLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailPermintaanLabel">Detail Permintaan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- // ======= Info Detail Peminjaman ======= -->
                <ul class="list-unstyled">
                    <div class="row">
                        <div class="col-sm-6 p-3">
                            <li><strong>Nama</strong></li>
                            <li><strong>Jabatan</strong></li>
                            <li><strong>Tanggal</strong></li>
                            <li><strong>Waktu</strong></li>
                            <li><strong>Tujuan Pinjam</strong></li>
                            <li><strong>Jumlah Orang</strong></li>
                            <li><strong>Ruangan</strong></li>
                        </div>
                        <div class="col-sm-6 p-3">
                            <li>: <span id="detail-nama"></span></li>
                            <li>: <span id="detail-jabatan"></span></li>
                            <li>: <span id="detail-tanggal"></span></li>
                            <li>: <span id="detail-waktu"></span></li>
                            <li>: <span id="detail-tujuan"></span></li>
                            <li>: <span id="detail-jumlah"></span></li>
                            <li>: <span id="detail-ruangan"></span></li>
                        </div>
                    </div>
                </ul>

                <!-- // ======= Pilihan Ganti Ruangan & Catatan ======= -->
                <div class="mb-3">
                    <label for="gantiRuangan" class="form-label"><strong>Ganti Ruangan</strong></label>
                    <select class="form-select" id="gantiRuangan">
                        <option selected>Ruangan Tersedia</option>
                        <option value="401">401</option>
                        <option value="402">402</option>
                        <option value="404">404</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="catatanPeminjam" class="form-label"><strong>Catatan</strong></label>
                    <textarea class="form-control" id="catatanPeminjam" rows="2" placeholder="Catatan Untuk Peminjam"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <div id="formSetujui">
                    <input type="hidden" id="inputCatatanSetujui">
                    <button type="button" class="btn btn-success">Setujui</button>
                </div>
                <div id="formTolak">
                    <input type="hidden" id="inputCatatanTolak">
                    <button type="button" class="btn btn-danger">Tolak</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- // ======= Script: Isi Modal Saat Tombol Diklik ======= -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('detailPermintaanModal');
        modal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            modal.querySelector('#detail-nama').textContent = button.getAttribute('data-nama');
            modal.querySelector('#detail-jabatan').textContent = button.getAttribute('data-jabatan');
            modal.querySelector('#detail-tanggal').textContent = button.getAttribute('data-tanggal');
            modal.querySelector('#detail-waktu').textContent = button.getAttribute('data-waktu');
            modal.querySelector('#detail-tujuan').textContent = button.getAttribute('data-tujuan');
            modal.querySelector('#detail-jumlah').textContent = button.getAttribute('data-jumlah');
            modal.querySelector('#detail-ruangan').textContent = button.getAttribute('data-ruangan');
        });
    });
</script>

<!-- // ======= Script: Muat Ruangan Tersedia ======= -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('detailPermintaanModal');
        modal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const tanggal = button.getAttribute('data-tanggal-raw');
            const id_slot = button.getAttribute('data-id_slot');
            const select = modal.querySelector('#gantiRuangan');
            select.innerHTML = '<option disabled selected>Loading...</option>';

            fetch(`/api/ruangan-tersedia?tanggal=${tanggal}&id_slot=${id_slot}`)
                .then(res => res.json())
                .then(data => {
                    select.innerHTML = '';
                    if (data.length === 0) {
                        select.innerHTML = '<option disabled>Tidak ada ruangan tersedia</option>';
                        return;
                    }
                    data.forEach(item => {
                        const option = document.createElement('option');
                        option.value = item.id_ruangan;
                        option.text = item.nama_ruangan;
                        select.appendChild(option);
                    });
                })
                .catch(() => {
                    select.innerHTML = '<option disabled>Gagal memuat data</option>';
                });
        });
    });
</script>

<!-- // ======= Script: Proses Setujui & Tolak ======= -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const modal = document.getElementById('detailPermintaanModal');
        modal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');
            const catatanInput = document.getElementById('catatanPeminjam');
            const ruanganSelect = document.getElementById('gantiRuangan');
            const setujuiBtn = document.querySelector('#formSetujui button');
            const tolakBtn = document.querySelector('#formTolak button');

            // Reset tombol
            setujuiBtn.disabled = false;
            tolakBtn.disabled = false;

            // Setujui
            setujuiBtn.onclick = function () {
                setujuiBtn.disabled = true;
                const catatan = catatanInput.value;
                const id_ruangan = ruanganSelect.value;
                if (!id_ruangan || id_ruangan === 'Ruangan Tersedia') {
                    alert('⚠️ Silakan pilih ruangan terlebih dahulu.');
                    setujuiBtn.disabled = false;
                    return;
                }
                fetch(`/peminjaman/${id}/setujui`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ catatan, id_ruangan })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        alert('✅ Permintaan berhasil disetujui.');
                        location.reload();
                    } else {
                        alert('Terjadi kesalahan.');
                        setujuiBtn.disabled = false;
                    }
                })
                .catch(() => {
                    alert('Terjadi kesalahan koneksi.');
                    setujuiBtn.disabled = false;
                });
            };

            // Tolak
            tolakBtn.onclick = function () {
                tolakBtn.disabled = true;
                const catatan = catatanInput.value;
                fetch(`/peminjaman/${id}/tolak`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ catatan })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        alert('❌ Permintaan telah ditolak.');
                        location.reload();
                    } else {
                        alert('Terjadi kesalahan.');
                        tolakBtn.disabled = false;
                    }
                })
                .catch(() => {
                    alert('Terjadi kesalahan koneksi.');
                    tolakBtn.disabled = false;
                });
            };
        });
    });
</script>

<!-- // ======= Script: Filter Hari Ini & Jabatan ======= -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const checkbox = document.getElementById('filterHariIni');
        const dropdown = document.getElementById('filterJabatan');
        const tbody = document.querySelector('.table2 tbody');

        function fetchFilteredData() {
            const hariIni = checkbox.checked ? 1 : 0;
            const selectedFilter = dropdown.value;

            fetch(`/peminjaman/filter?hari_ini=${hariIni}&jabatan=${selectedFilter}`)
                .then(res => res.json())
                .then(data => {
                    tbody.innerHTML = '';
                    if (data.length === 0) {
                        tbody.innerHTML = `<tr><td colspan="6" class="text-center">Tidak ada data</td></tr>`;
                        return;
                    }

                    // Filter jabatan
                    const filtered = data.filter(row => {
                        const jabatan = row.jabatan?.toLowerCase() || '';

                        if (selectedFilter === 'semua') return true;
                        if (selectedFilter === 'mahasiswa') return jabatan.includes('mahasiswa');
                        if (selectedFilter === 'dosen') return jabatan.includes('dosen');
                        if (selectedFilter === 'staff') return jabatan.includes('staff');
                        if (selectedFilter === 'lainnya') {
                            return !jabatan.includes('mahasiswa') &&
                                   !jabatan.includes('dosen') &&
                                   !jabatan.includes('staff');
                        }
                        return true;
                    });

                    if (filtered.length === 0) {
                        tbody.innerHTML = `<tr><td colspan="6" class="text-center">Tidak ada data</td></tr>`;
                        return;
                    }

                    filtered.forEach(row => {
                        const tr = document.createElement('tr');
                        tr.classList.add('row-peminjaman');
                        tr.setAttribute('data-id', row.id_peminjaman);
                        tr.innerHTML = `
                            <td>${row.kode_peminjaman}</td>
                            <td>${row.nama_peminjam}</td>
                            <td>${row.jabatan}</td>
                            <td>${formatDate(row.tanggal)}</td>
                            <td>${formatTime(row.jam_mulai)} - ${formatTime(row.jam_selesai)}</td>
                            <td>
                                <button type="button" class="btn btn-secondary"
                                    data-bs-toggle="modal"
                                    data-bs-target="#detailPermintaanModal"
                                    data-id="${row.id_peminjaman}"
                                    data-nama="${row.nama_peminjam}"
                                    data-jabatan="${row.jabatan}"
                                    data-tanggal="${formatDate(row.tanggal)}"
                                    data-tanggal-raw="${row.tanggal}"
                                    data-waktu="${formatTime(row.jam_mulai)} - ${formatTime(row.jam_selesai)}"
                                    data-tujuan="${row.tujuan}"
                                    data-jumlah="${row.jumlah_orang}"
                                    data-ruangan="${row.nama_ruangan}"
                                    data-id_slot="${row.id_slot}">
                                    Detail
                                </button>
                            </td>
                        `;
                        tbody.appendChild(tr);
                    });
                })
                .catch(() => {
                    tbody.innerHTML = `<tr><td colspan="6" class="text-center text-danger">Gagal memuat data</td></tr>`;
                });
        }

        function formatDate(dateStr) {
            const date = new Date(dateStr);
            return date.toLocaleDateString('id-ID', {
                day: '2-digit', month: '2-digit', year: 'numeric'
            });
        }

        function formatTime(timeStr) {
            return timeStr.slice(0, 5);
        }

        checkbox.addEventListener('change', fetchFilteredData);
        dropdown.addEventListener('change', fetchFilteredData);
    });
</script>

<!-- // ======= Script: Notifikasi Error / Success dari Session ======= -->
@if(isset($error))
    <div class="alert alert-danger mt-3">{{ $error }}</div>
@endif
@if (session('success'))
    <div class="alert alert-success mt-3">{{ session('success') }}</div>
@endif



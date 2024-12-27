<?php
require 'koneksi.php';

// Ambil ID dari parameter URL
$id = $_GET['id'];

// Query untuk mengambil detail periksa
$ambilDetail = mysqli_query($mysqli, "
    SELECT 
        dp.id AS idDetailPeriksa,
        daftar_poli.id AS idDaftarPoli,
        poli.nama_poli,
        dokter.nama AS namaDokter,
        jadwal_periksa.hari,
        DATE_FORMAT(jadwal_periksa.jam_mulai, '%H:%i') AS jamMulai,
        DATE_FORMAT(jadwal_periksa.jam_selesai, '%H:%i') AS jamSelesai,
        daftar_poli.no_antrian,
        p.id AS idPeriksa,
        p.tgl_periksa,
        p.catatan,
        p.biaya_periksa,
        GROUP_CONCAT(o.id) AS idObat,
        GROUP_CONCAT(o.nama_obat SEPARATOR ', ') AS namaObat
    FROM daftar_poli
    INNER JOIN jadwal_periksa ON daftar_poli.id_jadwal = jadwal_periksa.id
    INNER JOIN dokter ON jadwal_periksa.id_dokter = dokter.id
    INNER JOIN poli ON dokter.id_poli = poli.id
    LEFT JOIN periksa p ON daftar_poli.id = p.id_daftar_poli
    LEFT JOIN detail_periksa dp ON p.id = dp.id_periksa
    LEFT JOIN obat o ON dp.id_obat = o.id
    WHERE daftar_poli.id = '$id'
    GROUP BY daftar_poli.id
");

// Fetch data
$data = mysqli_fetch_assoc($ambilDetail);

// Cek jika data tidak ditemukan
if (!$data) {
    echo "<script>alert('Data tidak ditemukan!'); window.location.href = 'daftarPoliklinik.php';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Periksa</title>
  <style>


        .no-antrian {
            font-size: 18px;
            text-align: center;
            border-radius: 5px;
            padding: 8px 16px ;
            display: inline-block;
        }

        .biaya-periksa {
            font-size: 20px;
            font-weight: bold;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            display: inline-block;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h3 class="text-center">Riwayat Periksa</h3>
        <div class="card">
            <div class="card-header bg-primary">
                Riwayat Periksa
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Nama Poli:</strong> <?php echo htmlspecialchars($data['nama_poli']); ?></p>
                        <p><strong>Nama Dokter:</strong> <?php echo htmlspecialchars($data['namaDokter']); ?></p>
                        <p><strong>Hari:</strong> <?php echo htmlspecialchars($data['hari']); ?></p>
                        <p><strong>Jam Mulai:</strong> <?php echo htmlspecialchars($data['jamMulai']); ?></p>
                        <p><strong>Jam Selesai:</strong> <?php echo htmlspecialchars($data['jamSelesai']); ?></p>
                        <strong>Nomor Antrian</strong>
                    <div class="no-antrian bg-info">
                        <?php echo htmlspecialchars($data['no_antrian']); ?>
                    </div>
                    </div>
                </div>
                <hr>
                <p><strong>Tanggal Periksa:</strong> <?php echo htmlspecialchars($data['tgl_periksa']); ?></p>
                <p><strong>Catatan:</strong> <?php echo htmlspecialchars($data['catatan']); ?></p>
                <p><strong>Daftar Obat Yang Diresepkan:</strong></p>
                <ul>
                    <?php
                    if (!empty($data['namaObat'])) {
                        $namaObatArray = explode(', ', $data['namaObat']);
                        foreach ($namaObatArray as $index => $namaObat) {
                            echo "<li>" . htmlspecialchars($namaObat) . "</li>";
                        }
                    } else {
                        echo "<li>Tidak ada obat yang diresepkan.</li>";
                    }
                    ?>
                </ul>
                <div class="biaya-periksa mb-3 bg-danger">
                    Biaya Periksa: Rp <?php echo number_format($data['biaya_periksa'], 0, ',', '.'); ?> 
                </div>
                
                    
            </div>
            <div class="card-footer text-center">
                <a href="daftarPoliklinik.php" class="btn btn-primary">Kembali</a>
            </div>
        </div>
    </div>
   </body>

</html>
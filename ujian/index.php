<?php

session_start();

if (!isset($_SESSION['ssLogin'])) {
  header("location: ../otentikasi");
  exit();
}

require "../config.php";

$title ="Peraturan - Ujian Online";

require "../template/header.php";
require "../template/navbar.php";
require "../template/sidebar.php";
// admin tidak bisa masuk
if ($_SESSION['ssRole'] != 2) {
  echo "<script>
            alert('Halaman Tidak Ditemukan');
            window.location = '../';
        </script>";
  exit();
}

// cek apakah siswa sudah pernah mengikuti ujian
$idUser       = $_SESSION['ssId'];
$queryNilai   = mysqli_query($koneksi, "SELECT * FROM tb_nilai WHERE id_user = '$idUser'");
$cekNilai     = mysqli_num_rows($queryNilai);
if ($cekNilai) {
  echo "<script> window.location = 'hasil-ujian.php'</script>";
  exit();
}

$queryAturan  = mysqli_query($koneksi, "SELECT * FROM tb_pengaturan");
$row          = mysqli_fetch_assoc($queryAturan);

?>

<!-- partial -->
<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-md-12 grid-margin mb-3">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <h3 class="font-weight-bold mb-0">Peraturan</h3>
          </div>
          <div>
            <a href="soal.php" onclick="return confirm('anda yakin akan mulai mengerjakan ujian ?')" class="btn btn-warning btn-icon-text btn-rounded">
              <i class="ti-angel-double-lift btn-icon-prepend"></i>Mulai Ujian
            </a>
          </div>
        </div>
      </div>
    </div>

    <div class="card">
      <div class="card-body">
        <div class="col-md-10 px-lg-4">
          <p class="card-title text-center fs-4 py-3">Ujian Online</p>
          <div class="row mb-3">
            <div class="col-6 col-lg-3 col-md-3">
              Durasi Ujian
            </div>
            <div class="col-6 col-lg-9 col-md-9">
              <?= ': ' . $row['waktu'] . ' menit' ?>
            </div>
          </div>
          <div class="row mb-4">
            <div class="col-6 col-lg-3 col-md-3">
              Syarat Nilai Kelulusan :
            </div>
            <div class="col-6 col-lg-9 col-md-9">
              <?= ': ' . $row['nilai_minimal'] . ' %' ?>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col fw-bold fs-5 text-secondary">
              Peraturan Saat Ujian:
            </div>
          </div>
          <div class="row mb-3">
            <div class="col">
              <?= html_entity_decode($row['peraturan']) ?>
            </div>
          </div>
          <h4 class="text-secondary mb-5">Selamat Mengerjakan !</h4>
        </div>
      </div>
    </div>
    <!-- cards -->

  </div>
  <!-- content-wrapper ends -->
</div>
<!-- main-panel ends -->

<?php

require "../template/footer.php";

?>
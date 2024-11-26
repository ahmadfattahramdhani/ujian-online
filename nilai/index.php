<?php

session_start();

if (!isset($_SESSION['ssLogin'])) {
    header("location: ../otentikasi");
    exit();
}

require "../config.php";

$title = "Soal - Ujian Online";

require "../template/header.php";
require "../template/navbar.php";
require "../template/sidebar.php";

if ($_SESSION['ssRole'] != 1) {
    echo "<script>
            alert('Halaman Tidak Ditemukan');
            window.location = '../ujian';
        </script>";
    exit();
}

$querySiswa = mysqli_query($koneksi, "SELECT tb_user.fullname, tb_nilai.nilai, tb_nilai.status, tb_nilai.tanggal FROM tb_user JOIN tb_nilai ON tb_user.user_id=tb_nilai.id_user")

?>

<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin mb-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="font-weight-bold mb-0">Data Nilai</h3>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="mytable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Siswa</th>
                                    <th>Nilai</th>
                                    <th>status</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                while ($siswa = mysqli_fetch_assoc($querySiswa)) { ?>
                                    <tr>
                                        <td class="text-center" style="width:5%;"><?= $no++ ?></td>
                                        <td><?= short(html_entity_decode($siswa['fullname'])) ?></td>
                                        <td style="width:10%;"><?= short(html_entity_decode($siswa['nilai'])) ?></td>
                                        <td ><?= short(html_entity_decode($siswa['status'])) ?></td>
                                        <td><?= short(html_entity_decode($siswa['tanggal'])) ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
</div>
<!-- main-panel ends -->

<?php

require "../template/footer.php";

?>
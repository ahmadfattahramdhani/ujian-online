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

$querySoal = mysqli_query($koneksi, "SELECT * FROM tb_soal")

?>

<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin mb-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="font-weight-bold mb-0">Data Soal</h3>
                    </div>
                    <div>
                        <a href="add-soal.php" class="btn btn-warning btn-icon-text btn-rounded">
                            <i class="ti-plus btn-icon-prepend"></i> Tambah Soal
                        </a>
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
                                    <th>Pertanyaan</th>
                                    <th>Operasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                while ($soal = mysqli_fetch_assoc($querySoal)) { ?>
                                    <tr>
                                        <td class="text-center" style="width:5%;"><?= $no++ ?></td>
                                        <td><?= short(html_entity_decode($soal['pertanyaan'])) ?></td>
                                        <td style="width:10%;">
                                            <a href="" title="view soal" onclick="window.open('view-soal.php?id=<?= $soal['id'] ?>','','width=800,height=450,top=80,left=120)')" class="btn btn-primary btn-xs"><i class="ti-eye"></i></a>
                                            <a href="edit-soal.php?id=<?= $soal['id'] ?>" title="update soal" class="btn btn-warning btn-xs"><i class="ti-pencil-alt"></i></a>
                                            <a href="proses-soal.php?id=<?= $soal['id'] ?>&gbr=<?= $soal['gambar'] ?>&op=delete" onclick="return confirm('Anda yakin mau menghapus soal ini ?')" title="delete soal" class="btn btn-danger btn-xs"><i class="ti-trash"></i></a>
                                        </td>
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
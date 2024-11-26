<?php

session_start();

if (!isset($_SESSION['ssLogin'])) {
    header("location: ../otentikasi");
    exit();
}

require "../config.php";

if (isset($_POST['save'])) {
   $soal  = htmlspecialchars($_POST['soal']);
   $gambar  = htmlspecialchars($_FILES['gambar']['name']);
   $a  = htmlspecialchars($_POST['a']);
   $b  = htmlspecialchars($_POST['b']);
   $c  = htmlspecialchars($_POST['c']);
   $d  = htmlspecialchars($_POST['d']);
   $kunci  = htmlspecialchars($_POST['kunci']);

   if($gambar !=null){
    $page = 'add-soal.php';
    $gambar = uploadImg($page);
   } else {
    $gambar = '';
   }

//    masukan data ke database
    mysqli_query($koneksi, "INSERT INTO tb_soal VALUES (null, '$soal', '$gambar', '$a', '$b', '$c', '$d', '$kunci')");

    echo "<script>
            alert('Soal baru berhasil di tambahkan');
            window.location = 'add-soal.php';
        </script>";
    return;
}

// hapus soal
if (@$_GET['op'] == 'delete' ) {
    $id  = htmlspecialchars($_GET['id']);
    $gbr  = htmlspecialchars($_GET['gbr']);

    mysqli_query($koneksi, "DELETE FROM tb_soal WHERE id = $id");
    if ($gbr != "" ) {
        unlink('../images/soal/' . $gbr);
    }
echo"<script>
            alert('Soal berhasil di hapus');
            window.location = 'index.php';
        </script>";
    return;
}

// update soal
if (isset($_POST['update'])) {
    $id   =$_POST['id'];
   $soal  = htmlspecialchars($_POST['soal']);
   $gambar  = htmlspecialchars($_FILES['gambar']['name']);
   $gbrLama  = htmlspecialchars($_POST['gambarlama']);
   $a  = htmlspecialchars($_POST['a']);
   $b  = htmlspecialchars($_POST['b']);
   $c  = htmlspecialchars($_POST['c']);
   $d  = htmlspecialchars($_POST['d']);
   $kunci  = htmlspecialchars($_POST['kunci']);

   if($gambar !=null){
    $page = 'index.php';
    $gbrSoal = uploadImg($page);
    @unlink('../images/soal/' . $gbrLama);
   } else {
    $gbrSoal = $gbrLama;
   }
   
//    masukan data ke database
mysqli_query($koneksi, "UPDATE tb_soal SET
                        pertanyaan      = '$soal',
                        gambar          = '$gbrSoal',
                        a               = '$a',
                        b               = '$b',
                        c               = '$c',
                        d               = '$d',
                        kunci_jawaban   = '$kunci'
                        WHERE id = $id");

    echo "<script>
            alert('Soal berhasil di perbarui');
            window.location = 'index.php';
        </script>";
    return;
}
?>
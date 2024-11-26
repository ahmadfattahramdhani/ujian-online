<?php

$host = "localhost";
$user  = "root";
$pass = "tkjtkj";
$db = "db_ujian";

$koneksi  = mysqli_connect($host, $user, $pass, $db);

$mainUrl = "http://192.168.3.101/31/ujian-online/";



// funsi upload
function uploadImg($page){
    $fileName  = $_FILES['gambar']['name'];
    $size  = $_FILES['gambar']['size'];
    $tmp  = $_FILES['gambar']['tmp_name'];

    $validEks = ['jpg','jpeg','png','gif'];
    $fileEks  = explode('.',$fileName);
    $fileEks  = strtolower(end($fileEks));

    if(!in_array($fileEks,$validEks)){
        echo "<script>
            alert('Input soal gagal, file yang anda upload bukan gambar');
            window.location = '$page';
        </script>";
        die();
    }

    if($size > 1000000 ) {
        echo "<script>
            alert('Input soal gagal, maksimal ukuran gambar 1 MB');
            window.location = '$page';
        </script>";
        die();
    }

    $newName = time() . '-' . $fileName;

    move_uploaded_file($tmp, '../images/soal/' . $newName);
    return $newName;
}

function short($teks){
    if (strlen($teks) > 100) {
        $result = substr($teks, 0, 100) . '...';
    } else {
        $result = $teks;
    }
    return $result;
}









function durasi($waktu){
    if ($waktu < 60) {
        $jam = 0;
        $menit = ($waktu < 10 && $waktu >= 0) ? $waktu = '0' . $waktu : $waktu;
        $detik = '00';
    }else {
        $jam = floor($waktu / 60);
        $menit = $waktu - ($jam*60);
        $menit = ($menit < 10 && $menit >= 0) ? $menit = '0' . $menit : $menit;
        $detik = '00';
    }
    return $jam . ':' . $menit . ':' . $detik;
}





?>
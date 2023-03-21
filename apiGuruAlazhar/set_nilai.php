<?php
require_once('koneksi.php');
class emp
{
}

$id_siswa = $_POST['id_siswa'];
$id_pelajaran = $_POST['id_pelajaran'];
$nilai = $_POST['nilai'];
$date = date('Y-m-d H:i:s');

    $query = "INSERT INTO `tb_nilai` (`id_siswa`, `id_pelajaran`, `nilai`, `created_at`,`updated_at`) VALUES ('$id_siswa', '$id_pelajaran', '$nilai', '$date', '$date')";
    $ad = mysqli_query($con, $query);
    
    if ($ad) {
        $response = new emp();
        $response->response = "Sukses Register";
        $response->code = 1;
        die(json_encode($response));
    } else {
        $response = new emp();
        $response->response = "Gagal !. Silahkan coba lagi.";
        $response->code = 0;
        die(json_encode($response));
    }




mysqli_close($con);

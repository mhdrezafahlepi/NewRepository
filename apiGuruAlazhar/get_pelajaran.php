<?php
require_once('koneksi.php');

$kelas = $_GET['kelas'];

$perintah = "SELECT distinct  `tb_quis`.`id_pelajaran`, `tb_pelajaran`.`nama_pelajaran` FROM `tb_quis`
LEFT JOIN `tb_pelajaran` ON `tb_pelajaran`.`id_pelajaran`=`tb_quis`.`id_pelajaran`
WHERE `tb_quis`.`id_kelas`='$kelas'";

$eksekusi = mysqli_query($con, $perintah);
$cek = mysqli_affected_rows($con);

if ($cek > 0) {
    $response["kode"] = 1;
    $response["pesan"] = "Data tersedia";
    $response["data"] = array();
    $F = array();
    while ($ambil = mysqli_fetch_object($eksekusi)) {
        $F[] = $ambil;
    }
    $response["data"] = $F;
} else {
    $response["kode"] = 0;
    $response["pesan"] = "Data tidak tersedia";
}

echo json_encode($response);
mysqli_close($con);

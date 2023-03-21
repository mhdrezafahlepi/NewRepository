<?php
require_once('koneksi.php');

$id = $_POST['id'];

$perintah = "SELECT * FROM `tb_siswa` 
LEFT JOIN `tb_user` ON `tb_siswa`.`id_siswa`=`tb_user`.`id_s`
LEFT JOIN `tb_kelas` ON `tb_siswa`.`id_kelas`=`tb_kelas`.`id_kelas`
WHERE `id_siswa`='$id'";

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

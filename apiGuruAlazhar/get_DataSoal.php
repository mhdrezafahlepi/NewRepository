<?php
require_once('koneksi.php');

$id_pelajaran= $_POST['id_pelajaran'];
$id_kelas= $_POST['id_kelas'];

$perintah = "SELECT * FROM tb_quis WHERE id_pelajaran='$id_pelajaran' AND id_kelas='$id_kelas'";

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

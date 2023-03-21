<?php
require_once('koneksi.php');

$bulan = $_POST['bulan'];
$tahun = $_POST['tahun'];
$id = $_POST['id'];

$perintah = "SELECT * FROM `tb_spp` WHERE `id_siswa`='$id' AND `bulan_spp`='$bulan' AND `tahun_spp`='$tahun'";

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

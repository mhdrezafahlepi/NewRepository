<?php
require_once('koneksi.php');

$tgl = $_POST['hari'];
$kelas = $_POST['kelas'];

$perintah = "SELECT * FROM `tb_jadwal_pelajaran` 
            LEFT JOIN `tb_jam_ajar` ON `tb_jadwal_pelajaran`.`id_jam_ajar`=`tb_jam_ajar`.`id_jam` 
            LEFT JOIN `tb_kelas` ON `tb_jadwal_pelajaran`.`id_kelas`=`tb_kelas`.`id_kelas` 
            LEFT JOIN `tb_pelajaran` ON `tb_jadwal_pelajaran`.`id_pelajaran`=`tb_pelajaran`.`id_pelajaran` 
            LEFT JOIN `tb_pegawai` ON `tb_jadwal_pelajaran`.`id_pegawai`=`tb_pegawai`.`id`
            LEFT JOIN `tb_hari` ON `tb_jadwal_pelajaran`.`id_hari`=`tb_hari`.`id_hari`
            WHERE `tb_hari`.`hari`='$tgl'  AND `tb_jadwal_pelajaran`.`id_kelas`='$kelas'";

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

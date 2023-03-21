<?php
require_once('koneksi.php');

$tgl = $_POST['hari'];
$kelas = $_POST['kelas'];

$perintah = "SELECT * FROM `tb_jadwal_ujian`
LEFT JOIN `tb_jam_ajar` ON `tb_jadwal_ujian`.`id_jam_ajar`=`tb_jam_ajar`.`id_jam`
LEFT JOIN `tb_kelas` ON `tb_jadwal_ujian`.`id_kelas`=`tb_kelas`.`id_kelas`
LEFT JOIN `tb_pelajaran` ON `tb_jadwal_ujian`.`id_pelajaran`=`tb_pelajaran`.`id_pelajaran`
LEFT JOIN `tb_pegawai` ON `tb_jadwal_ujian`.`id_guru`=`tb_pegawai`.`id`
WHERE `hari_jadwal`='$tgl' AND `tb_jadwal_ujian`.`id_kelas`='$kelas'";

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

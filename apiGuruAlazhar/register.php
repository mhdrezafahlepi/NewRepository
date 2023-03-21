<?php
require_once('koneksi.php');
class emp
{
}

$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$tempat = $_POST['tempat'];
$tgl = $_POST['tgl'];
$gender = $_POST['gender'];
$nohp = $_POST['nohp'];





$query = "INSERT INTO `tb_siswa` (`id_siswa`, `nama_siswa`, `gender_siswa`, `nohp_siswa`, `tempat_lahir_siswa`, `tanggal_lahir_siswa`, `alamat_siswa`, `foto_siswa`, `status_daftar`) VALUES (NULL, '$nama', '$gender', '$nohp', '$tempat', '$tgl', '$alamat', 'siswa.png', '0');";
$ad = mysqli_query($con, $query);

if ($ad) {

    $response = new emp();
    $response->response = "Sukses Register";
    $response->code = 1;
    die(json_encode($response));
} else {
    $response = new emp();
    $response->response = "Gagal !. Silahkan coba lagi. 2";
    $response->code = 0;
    die(json_encode($response));
}

mysqli_close($con);

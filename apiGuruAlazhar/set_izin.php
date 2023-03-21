<?php
require_once('koneksi.php');
class emp
{
}

$ket = $_POST['ket'];
$ids = $_POST['ids'];
$tgl = $_POST['tgl'];
$foto = $_POST['foto'];

$random = random_word(20);
$path = $random . ".png";

$query = "INSERT INTO `tb_izin` (`id_izin`, `id_siswa`, `keterangan_izin`, `tgl_izin`, `foto_izin`) VALUES (NULL,'$ids', '$ket', '$tgl', '$path')";
$ad = mysqli_query($con, $query);

if ($ad) {
    file_put_contents("../backend/img/izin/" . $random . ".png", base64_decode($foto));
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

function random_word($id = 20)
{
    $pool = '1234567890abcdefghijkmnpqrstuvwxyz';

    $word = '';
    for ($i = 0; $i < $id; $i++) {
        $word .= substr($pool, mt_rand(0, strlen($pool) - 1), 1);
    }
    return $word;
}

mysqli_close($con);

<?php
require_once('koneksi.php');
class emp
{
}


$bulan = $_POST['bulan'];
$tahun = $_POST['tahun'];
$id = $_POST['id'];
$foto = $_POST['foto'];

$random = random_word(20);
$path = "SPP_". $random . ".png";

$query = "INSERT INTO `tb_spp` (`id_spp`, `id_siswa`, `bulan_spp`, `tahun_spp`, `tgl_bayar`, `upload_bukti`, `status`) 
VALUES (NULL, '$id', '$bulan', '$tahun', NOW(), '$path', '0');";
$ad = mysqli_query($con, $query);


if ($ad) {
    file_put_contents("../../tualazhar/backend/img/bukti_spp/" . "SPP_".$random . ".png", base64_decode($foto));
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

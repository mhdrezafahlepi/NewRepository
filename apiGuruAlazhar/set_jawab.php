<?php
require_once('koneksi.php');
class emp
{
}

$id_siswa = $_GET['id_siswa'];
$id_pelajaran = $_GET['id_pelajaran'];
$date = date('y-m-d');

$sql = "SELECT * FROM `tb_jawab` WHERE `id_siswa`='$id_siswa' AND `id_pelajaran`='$id_pelajaran'";
$cek = mysqli_fetch_array(mysqli_query($con, $sql));

if(!isset($cek)){
    $query = "INSERT INTO `tb_jawab` (`id_siswa`, `tgl_jawab`, `id_pelajaran`) VALUES ('$id_siswa', '$date', '$id_pelajaran');";
    $ad = mysqli_query($con, $query);
    
    if ($ad) {  
        $response = new emp();
        $response->response = "Sukses";
        $response->code = 1;
        $response->id = $con->insert_id;
        die(json_encode($response));
    } else {
        $response = new emp();
        $response->response = "Gagal !. Silahkan coba lagi.";
        $response->code = 0;
        die(json_encode($response));
    }
}else{
    $response = new emp();
    $response->response = "Gagal !. anda sudah mengerjaka quis ini";
    $response->code = 2;
    die(json_encode($response));
}




mysqli_close($con);

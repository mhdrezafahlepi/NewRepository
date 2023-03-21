<?php
require_once('koneksi.php');
class emp
{
}

$ids = $_POST['ids'];
$idt = $_POST['idt'];
$ket = $_POST['ket'];
$file = $_POST['file'];

$query = "UPDATE `tb_kirim_tugas` SET `id_user` = '$ids', `id_tugas`='$idt', `ket_tugas`='$ket' WHERE `tb_kirim_tugas`.`file_tugas` = '$file'";
$ad = mysqli_query($con, $query);

if ($ad) {

  $response = new emp();
  $response->response = "Sukses Add";
  $response->code = 1;
  die(json_encode($response));
} else {
  $response = new emp();
  $response->response = "Gagal !. Silahkan coba lagi. 2";
  $response->code = 0;
  die(json_encode($response));
}

mysqli_close($con);

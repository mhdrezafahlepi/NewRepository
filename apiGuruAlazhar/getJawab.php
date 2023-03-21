<?php

include "cosaine.php";
require_once('koneksi.php');

class emp
{
}

$jawab = $_GET['jawab'];
$kunci = $_GET['kunci'];
$id_jawab = $_GET['id_jawab'];
$id_quis = $_GET['id_quis'];

// $jawab = "saya tes";
// $kunci = "Dia tes";


$data = explode(" ", strtolower($kunci));
for ($i = 0; $i < count($data); $i++) {
    $key_value = explode(':', $data[$i]);
    $end_array[$key_value[0]] = 1;
}
$v1  = $end_array;

$data1 = explode(" ", strtolower($jawab));
for ($i = 0; $i < count($data1); $i++) {
    $key_value1 = explode(':', $data1[$i]);
    $end_array1[$key_value1[0]] = 1;
}
$v2  = $end_array1;

$cs = new CosineSimilarity();
$result1 = $cs->similarity($v1, $v2);

$query = "INSERT INTO `tb_jawab_detail` (`id_jawab`, `id_quis`, `jawaban`,`value`) VALUES ('$id_jawab', '$id_quis', '$jawab','$result1');";
$ad = mysqli_query($con, $query);

if($ad){
    $response = new emp();
    $response->success = 1;
     $response->message = "Sukses!";
    $response->nilai = ceil($result1 * 100);
    die(json_encode($response));    
}else{
    $response = new emp();
    $response->success = 0;
    $response->message = "Failed!";
    die(json_encode($response));
}


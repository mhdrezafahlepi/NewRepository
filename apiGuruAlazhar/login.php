<?php
header('Content-Type: application/json');
require_once('koneksi.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    
    // $pass = password_hash("$password", PASSWORD_DEFAULT);
    // echo $pass;
    $perintah = "SELECT * FROM `tb_user` WHERE `id_user`='$username'";
    $eksekusi = mysqli_query($con, $perintah);
    $query = mysqli_fetch_object($eksekusi);
    
    if (password_hash($password, $query['password'])) {
        $response = [];

        $cari_user = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `tb_siswa`
        JOIN `tb_user` on `tb_siswa`.`id_siswa`=`tb_user`.`id_s` WHERE `tb_user`.`username` = '$username' AND `tb_user`.`level`='1'"));


        if (!empty($cari_user)) {
            unset($cari_user['password']);
            $response["kode"] = 1;
            $response["pesan"] = "Data tersedia";
            $response["data"] = $cari_user;
        } else {
            $response["kode"] = 0;
            $response["pesan"] = "Data tidak tersedia";
        }    
    }else{
        echo $query['password'];
    }
    
} else {
    $response = [];
    $response["kode"] = 0;
    $response["pesan"] = "Not Found!!!";
}
mysqli_close($con);
echo json_encode($response);

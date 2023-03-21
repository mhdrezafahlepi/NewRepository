<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // echo $_SERVER["DOCUMENT_ROOT"];  // /home1/demonuts/public_html
  //including the database connection file
  require_once('koneksi.php');
  $ids = "1";
  $idt = "1";
  $tgl = date('y-m-d');
  //$_FILES['image']['name']   give original name from parameter where 'image' == parametername eg. city.jpg
  //$_FILES['image']['tmp_name']  temporary system generated name

  $originalImgName = $_FILES['filename']['name'];
  $tempName = $_FILES['filename']['tmp_name'];
  $folder = "../backend/file/kirim_tugas/";
  $url = "http://gurualazhar.mediatamaweb.com/backend/file/kirim_tugas/" . $originalImgName; //update path as per your directory structure 

  if (move_uploaded_file($tempName, $folder . $originalImgName)) {
    $query = "INSERT INTO `tb_kirim_tugas` (`id_kirim_tugas`, `id_tugas`, `id_user`, `tgl_kirim_tugas`, `file_tugas`, `ket_tugas`) VALUES (NULL, '$idt', '$ids', '$tgl', '$originalImgName','');";
    if (mysqli_query($con, $query)) {

      $query = "SELECT * FROM `tb_kirim_tugas` WHERE `file_tugas`='$originalImgName'";
      $result = mysqli_query($con, $query);
      $emparray = array();
      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          $emparray[] = $row;
        }
        echo json_encode(array("status" => "true", "message" => "Successfully file added!", "data" => $emparray));
      } else {
        echo json_encode(array("status" => "false", "message" => "Failed!"));
      }
    } else {
      echo json_encode(array("status" => "false", "message" => "Failed!"));
    }
    //echo "moved to ".$url;
  } else {
    echo json_encode(array("status" => "false", "message" => "Failed!"));
  }
}

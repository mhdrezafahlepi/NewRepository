    <?php
    require_once('koneksi.php');
    class emp
    {
    }

    $rapor = $_POST['rapor'];
    $random = random_word(20);
    $path = "AKTE_" . $random . ".png";
    $id = $_POST['siswa'];



    $query = "UPDATE `tb_berkas_siswa` SET `berkas_akte` = '$path' WHERE `tb_berkas_siswa`.`id_siswa` = $id";
    $ad = mysqli_query($con, $query);

    if ($ad) {
        file_put_contents("../public/backend/img/berkas/" . $path, base64_decode($rapor));
        $response = new emp();
        $response->response = "Sukses Buat Janji";
        $response->code = 1;
        $response->id = $id;
        die(json_encode($response));
    } else {
        $response = new emp();
        $response->response = "Gagal !. Silahkan coba lagi.";
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

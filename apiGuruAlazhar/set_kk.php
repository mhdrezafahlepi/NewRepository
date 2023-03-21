    <?php
    require_once('koneksi.php');
    class emp
    {
    }

    $kk = $_POST['kk'];
    $random = random_word(20);
    $pathKk = "KK_" . $random . ".png";
    $ql = "SELECT * FROM `tb_siswa` ORDER BY `tb_siswa`.`id_siswa` DESC LIMIT 1";
    $usr = mysqli_query($con, $ql);
    $hmm = mysqli_fetch_array($usr);

    $id = $hmm['id_siswa'];



    $query = "INSERT INTO `tb_berkas_siswa` (`id_siswa`, `berkas_kk`, `berkas_rapor`, `berkas_akte`) VALUES ('$id', '$pathKk', '-', '-');";
    $ad = mysqli_query($con, $query);

    if ($ad) {
        file_put_contents("../public/backend/img/berkas/" . $pathKk, base64_decode($kk));
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

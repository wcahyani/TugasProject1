<?php
require '../config.php';
require '../model/Produk.php';

$produk = new Produk($conn);

$action   = isset($_GET['action']) ? $_GET['action'] : 'insert';

if($action == 'insert'){
    $nama     = isset($_POST['nama']) ? $_POST['nama'] : 'a';
    $harga    = isset($_POST['harga']) ? $_POST['harga'] : 's';
    $penjual  = isset($_POST['penjual']) ? $_POST['penjual'] : '';
    $ukuran   = isset($_POST['ukuran']) ? $_POST['ukuran'] : 'f';
    //$file     = $_FILE['foto'];

    $data = [
        'nama'      => $nama,
        'harga'     => $harga,
        'penjual'   => $penjual,
        'ukuran'    => $ukuran
    ];

    foreach($data as $key => $value){
        echo $key;
        echo $value;
        if(empty($value)){
            $return['error'][$key] = $key.' field tidak boleh kosong';
        }
    }

    //dipake
    /*$datafoto = $produk->validateFile($file);
    if($datafoto == false){
        $return['error']['file'] = 'file field tidak boleh kosong';
    }
    else{
        $data['foto'] = $datafoto['filename'];
    }*/

    if(!empty($return['error'])){
        $return['hasil'] = 'gagal';
    }
    else{
        $return['hasil'] = 'sukses';
        //$profil->insertProduk($data);
        //move_uploaded_file($datafoto['filetmp'], '../images/produk/'.$datafoto['filename']);
    }

    print_r($return);
    echo json_encode($return);
}
elseif($action == 'update'){
    $nama     = isset($_POST['nama']) ? $_POST['nama'] : 'a';
    $harga    = isset($_POST['harga']) ? $_POST['harga'] : 's';
    $penjual  = isset($_POST['penjual']) ? $_POST['penjual'] : '';
    $ukuran   = isset($_POST['ukuran']) ? $_POST['ukuran'] : 'f';
    //$file     = $_FILE['foto'];

    $data = [
        'nama'      => $nama,
        'harga'     => $harga,
        'penjual'   => $penjual,
        'ukuran'    => $ukuran
    ];

    foreach($data as $key => $value){
        if(empty($value)){
            $return['error'][$key] = $key.' field tidak boleh kosong';
        }
    }

    //dipake
    /*$datafoto = $produk->validateFile($file);
    if($datafoto == false){
        $return['error']['file'] = 'file field tidak boleh kosong';
    }
    else{
        $data['foto'] = $datafoto['filename'];
    }*/

    if(!empty($return['error'])){
        $return['hasil'] = 'gagal';
    }
    else{
        $return['hasil'] = 'sukses';
        //$profil->updateProduk($data);
        //move_uploaded_file($datafoto['filetmp'], '../images/produk/'.$datafoto['filename']);
    }

    //print_r($return);
    echo json_encode($return);
}
elseif($action == 'delete'){
    $user->deleteProduk($_GET['id']);
}
else{
    //error action kosong
}
?>
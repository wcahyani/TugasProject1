<?php
require '../config.php';
require '../model/Produk.php';

$produk = new Produk($conn);

$action = $_GET['action'] ?: '';

if($action == 'insert'){
    $data = [
        'nama'      => $_POST['nama'] ?: '',
        'harga'     => $_POST['harga'] ?: '',
        'penjual'   => $_POST['penjual'] ?: '',
        'ukuran'    => $_POST['ukuran'] ?: ''
    ];

    //cek data kosong dlm array
    if(!in_array('', $data)){
        //cek duplikat profil
        if($profil->insertProduk($data)){
            header('location: ../produk.php');
        }
        else{
            //error upload file
        }
    }
    else{

    }
}
elseif($action == 'update'){
    //soon
}
elseif($action == 'delete'){
    if(isset($_GET['id'])){
        if($user->checkProduk($_GET['id']) == false){
            $user->deleteProduk($_GET['id']);
            header('location: ../Produk.php');
        }
        else{
            //error id user yg akan dihapus tidak ditemukan
        }
    }
    else{
        //error id kosong
    }
}
else{
    //error action kosong
}
?>
<?php
require '../config.php';
require '../model/Profil.php';

$profil = new Profil($conn);

$action = $_GET['action'] ?: '';

if($action == 'editprofil'){
    $data = [
        'id'       => $_POST['id'] ?: '',
        'nama'     => $_POST['nama'] ?: '',
        'alamat'   => $_POST['alamat'] ?: '',
        'email'    => $_POST['email'] ?: '',
        'tlp'      => $_POST['telp'] ?: '',
        'kota'     => $_POST['kota'] ?: '',
        'provinsi' => $_POST['provinsi'] ?: ''
    ];

    //cek data kosong dlm array
    if(!in_array('', $data)){
        //cek duplikat profil
        if($profil->checkProfil($data['id']) == false){
            if($profil->updateProfil($data)){
                header('location: ../profil.php');
            }
            else{
                //error upload file
            }
        }
        else{
            //error duplikat id
        }
    }
    else{
        //error field kosong
    }
}
elseif($action == 'editfoto'){
    $id = $_POST['id'] ?: '';

    //ambil data dari validate file, return array jika benar, selain itu false
    $datafoto = $profil->validateFile($_FILE['foto']);

    if($datafoto != false){
        if($profil->updateFoto($id, $datafoto['filename'])){
            //pindahkan image
            move_uploaded_file($datafoto['filetmp'], '../images/profil/'.$datafoto['filename']);
            header('location: ../profil.php');
        }
        else{
            //error upload file
        }
    }
    else{
        //error file kosong
    }
}
else{
    //error action kosong
}
?>
<?php
require '../config.php';
require '../model/Member.php';

$user = new Member($conn);

$username = $_POST['username'] ?: '';
$password = $_POST['password'] ?: '';
$email = $_POST['email'] ?: '';

if($username != '' && $password != '' && $email != ''){
    if($user->checkMember($username) == false){
        $data = [
            'username' => $username,
            'password' => $password,
            'email'    => $email
        ];

        if($user->register($data)){
            //$_SESSION['id'] = '';
            //$_SESSION['username'] = '';
            header('location: profil.php');
        }
        else{
            //error gagal register
        }
    }
    else{
        //error user duplikat
    }
}
else{
    //error field kosong
}
?>
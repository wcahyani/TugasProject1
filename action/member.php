<?php
require '../config.php';
require '../model/Member.php';

$user = new Member($conn);

$action = $_GET['action'] ?: '';

if($action == 'insert'){
    $username = $_POST['username'] ?: '';
    $password = $_POST['password'] ?: '';
    $email    = $_POST['email'] ?: '';

    if($username != '' && $password != '' && $email != ''){
        if($user->checkMember($username) == false){
            $data = [
                'username' => $username,
                'password' => $password,
                'email'    => $email
            ];
        
            if($user->insertMember($data)){
                //buat session log
                header('location: ../member.php');
            }
            else{
                //error gagal input data
            }
        }
        else{
            //error user duplikat
        }
    }
    else{
        //error field kosong
    }
}
elseif($action == 'update'){
    if(isset($_GET['id'])){
        $username = $_POST['username'] ?: '';
        $password = $_POST['password'] ?: '';
        $email    = $_POST['email'] ?: '';

        if($username != '' && $password != '' && $email != ''){
            if($user->checkMember($username) == false){
                $data = [
                    'username' => $username,
                    'password' => $password,
                    'email'    => $email
                ];
                
                if($user->updateMember($data)){
                    header('location: ../member.php');
                }
                else{
                    //error gagal update data
                }
            }
            else{
                //error user duplikat
            }
        }
        else{
            //error field kosong
        }
    }
}
elseif($action == 'delete'){
    if(isset($_GET['id'])){
        if($user->checkMember($_GET['id']) == false){
            $user->deleteMember($_GET['id']);
            header('location: ../member.php');
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
    header('location: ../member.php');
}
?>
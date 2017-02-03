<?php
require '../config.php';
require '../model/Member.php';

$username = $_POST['Username'] ?: null;
$password = $_POST['Password'] ?: null;

if(empty($username)){
    $return['error']['Username'] = 'Username tidak boleh kosong';
}

if(empty($password)){
    $return['error']['Password'] = 'Password tidak boleh kosong';
}

if(!empty($return['error'])){
    $return['hasil'] = 'gagal';
}
else{
    $return['hasil'] = 'sukses';
}

echo json_encode($return);
/*if($username != '' && $password != ''){
    $user = new Member($conn);
    if($user->authLogin($username, $password)){
        //$_SESSION['id'] = '';
        //$_SESSION['username'] = '';
        header('location: profil.php');
    }
}
else{
    header('location: login.html');
}*/
?>
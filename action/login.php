<?php
require '../config.php';
require '../model/Member.php';

$username = $_POST['username'] ?: '';
$password = $_POST['password'] ?: '';

if($username != '' && $password != ''){
    $user = new Member($conn);
    if($user->authLogin($username, $password)){
        //$_SESSION['id'] = '';
        //$_SESSION['username'] = '';
        header('location: profil.php');
    }
}
else{
    header('location: login.html');
}
?>
<?php
session_start();

spl_autoload_register(function ($class)
{
    if (file_exists('../model/'. $class .'.php'))
        require '../model/'. $class . '.php';
    else
        exit('Tidak dapat membuka class '.$class.'!');
});

require '../config/config.php';
require '../model/Member.php';

$username = $_POST['Username'] ?: null;
$password = $_POST['Password'] ?: null;

if(empty($username)){
    $return['error']['Username'] = 'Username tidak boleh kosong';
}

if(empty($password)){
    $return['error']['Password'] = 'Password tidak boleh kosong';
}

if(!empty($username) && !empty($password)){
    $user = new Member($con);
    if(!$data = $user->authLogin($username, $password)){
        $return['error']['Username'] = 'Username atau Password salah';
        $return['error']['Password'] = 'Username atau Password salah';
    }
}

if(!empty($return['error'])){
    $return['hasil'] = 'gagal';
}
else{
    $update = ['session_start' => date('Y-m-d h:i:s')];
    $where = ['username' => $username];
    $stmt = $con->update('member', $update, $where);
    $stmt->execute();
    
    $_SESSION['id'] = $data['id'];
    $_SESSION['username'] = $data['username'];
    $_SESSION['level'] = $data['level'];

    $return['hasil'] = 'sukses';
}

echo json_encode($return);
?>
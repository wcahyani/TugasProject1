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

$data = [
    'UsernameRegist' => $_POST['username'] ?: null,
    'PasswordRegist' => $_POST['password'] ?: null,
    'Konfirmasi'     => $_POST['konfirmasi'] ?: null,
    'Email'          => $_POST['email'] ?: null
];

foreach($data as $key => $value){
    if(empty($value)){
        if($key == 'UsernameRegist' || $key == 'PasswordRegist'){
            $err = substr($key, 0, 8);
            $return['error'][$key] = $err.' tidak boleh kosong';
        }
        else{
            $return['error'][$key] = $key.' tidak boleh kosong';
        }
    }
}

if(!empty($data['UsernameRegist'])){
    $stmt = $con->select('member', ['username' => $data['UsernameRegist']]);
    $stmt->execute();

    if($stmt->rowCount() > 0){
        $return['error']['UsernameRegist'] = 'Username sudah terpakai';
    }
}

if(!empty($data['Email'])){
    $stmt = $con->select('member', ['email' => $data['Email']]);
    $stmt->execute();

    if($stmt->rowCount() > 0){
        $return['error']['Email'] = 'Email sudah terpakai';
    }
}

if(!empty($data['PasswordRegist']) && !empty($data['Konfirmasi'])){
    if($data['PasswordRegist'] != $data['Konfirmasi']){
        $return['error']['PasswordRegist'] = 'Password dan konfirmasi password tidak sama';
        $return['error']['Konfirmasi'] = 'Password dan konfirmasi password tidak sama';
    }
}

if(!empty($return['error'])){
    $return['hasil'] = 'gagal';
}
else{
    $insert = [
        'id_profil'     => null,
        'username'      => $data['UsernameRegist'],
        'password'      => password_hash($data['PasswordRegist'], PASSWORD_BCRYPT),
        'email'         => $data['Email'],
        'level'         => '2',
        'session_start' => date('Y-m-d h:i:s'),
        'session_end'   => null
    ];

    if($con->insert('member', $insert)->execute()){
        $_SESSION['id'] = $con->lastInsertId();
        $_SESSION['username'] = $insert['username'];
        $_SESSION['level'] = $insert['level'];

        $return['hasil'] = 'sukses';
        //$return['notif'] = 'Gagal menginput data, periksa koneksi database';
    }
    else{
        $return['hasil'] = 'gagal';
        //$return['notif'] = 'Gagal menginput data, periksa koneksi database';
    }
}

echo json_encode($return);
?>
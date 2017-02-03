<?php
require '../config/config.php';
require '../model/Member.php';

$data = [
    'Username'   => $_POST['username'] ?: null,
    'Password'   => $_POST['password'] ?: null,
    'Konfirmasi' => $_POST['konfirmasi'] ?: null,
    'Email'      => $_POST['email'] ?: null
];

foreach($data as $key => $value){
    if(empty($value)){
        $return['error'][$key] = $key.' tidak boleh kosong';
    }
}

if(!empty($data['Username'])){
    $stmt = $con->select('member', ['username' => $data['Username']]);
    $stmt->execute();

    if($stmt->rowCount() > 0){
        $return['error']['Username'] = 'Username sudah terpakai';
    }
}

if(!empty($data['Email'])){
    $stmt = $con->select('member', ['email' => $data['Email']]);
    $stmt->execute();

    if($stmt->rowCount() > 0){
        $return['error']['Email'] = 'Email sudah terpakai';
    }
}

if(!empty($data['Password']) && !empty($data['Konfirmasi'])){
    if($data['Password'] != $data['Konfirmasi']){
        $return['error']['Password'] = 'Password dan konfirmasi password tidak sama';
        $return['error']['Konfirmasi'] = 'Password dan konfirmasi password tidak sama';
    }
}

if(!empty($return['error'])){
    $return['hasil'] = 'gagal';
}
else{
    $insert = [
        'id_profil'     => null,
        'username'      => $data['Username'],
        'password'      => password_hash($data['Password'], PASSWORD_BCRYPT),
        'email'         => $data['Email'],
        'session_start' => date('Y-m-d h:i:s'),
        'session_end'   => null
        //'level'         => 'user'
    ];

    if($con->insert('member', $insert)->execute()){
        //$_SESSION['id'] = '';
        //$_SESSION['username'] = '';

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
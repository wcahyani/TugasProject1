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
//require '../model/Profil.php';

$action = $_GET['action'] ?: '';

//ambil data satu foto
if($action == 'datafoto'){
    //$id = $_GET['id'] ?: null;

    $stmt = $con->select('tabel_profile', ['id_profile' => $_SESSION['id']]);
    $stmt->execute();

    $return = $stmt->fetch(PDO::FETCH_ASSOC);

    echo json_encode($return);
}
//update profil
elseif($action == 'editprofil'){
    $data = [
        'editNama'   => isset($_POST['editNama']) ? $_POST['editNama'] : null,
        'editAlamat' => isset($_POST['editAlamat']) ? $_POST['editAlamat'] : null,
        'editEmail'  => isset($_POST['editEmail']) ? $_POST['editEmail'] : null,
        'editTlp'    => isset($_POST['editTlp']) ? $_POST['editTlp'] : null
    ];

    foreach($data as $key => $value){
        if(empty($value)){
            $err = substr($key, 4);
            $return['error'][$key] = $err.' tidak boleh kosong';
        }
    }

    if(!empty($return['error'])){
        $return['hasil'] = 'gagal';
    }
    else{
        $update = [
            'nama_member'   => $data['editNama'],
            'alamat_member' => $data['editAlamat'],
            'email'         => $data['editEmail'],
            'tlp_member'    => $data['editTlp']
        ];

        $where = ['id_profile' => $_SESSION['id']];
        $stmt = $con->update('tabel_profile', $update, $where);
        $stmt->execute();

        $return['hasil'] = 'sukses';
        $return['update']['Nama']   = $update['nama_member'];
        $return['update']['Alamat'] = $update['alamat_member'];
        $return['update']['Email']  = $update['email'];
        $return['update']['Tlp']    = $update['tlp_member'];
    }

    echo json_encode($return);
}
//update foto profil
elseif($action == 'editfoto'){
    $profil = new Profil($con);
    //$id = isset($_SESSION['username']) ? $_SESSION['username'] : '';
    $foto = isset($_FILES['editFoto']) ? $_FILES['editFoto'] : [];

    //ambil data dari validate file, return array jika benar, selain itu false
    $datafoto = $profil->validateFile($foto);

    if($datafoto == false){
        $return['error']['file'] = 'file tidak boleh kosong'; 
    }

    if(!empty($return['error'])){
        $return['hasil'] = 'error';
    }
    else{
        $update = ['foto' => $datafoto['filename']];
        $where = ['id_profile' => $_SESSION['id']];
        $stmt = $con->update('tabel_profile', $update, $where);
        $stmt->execute();

        //pindahkan image
        move_uploaded_file($datafoto['filetmp'], '../images/profil/'.$datafoto['filename']);
        $return['hasil'] = 'sukses';
        $return['foto'] = $datafoto['filename'];
    }

    //ganti array ke json, dan echo sbg text html untuk dikembalikan ke ajax
    echo json_encode($return);
}
else{
    //error action kosong
}
?>
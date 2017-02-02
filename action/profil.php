<?php
require '../config/config.php';
//require '../model/Profil.php';

$action = $_GET['action'] ?: '';

if($action == 'editprofil'){
    $data = [
        //'id'               => isset($_POST['_token']) ? $_POST['_token'] : null,
        'nama_member'      => isset($_POST['editNama']) ? $_POST['editNama'] : null,
        'alamat_member'    => isset($_POST['editAlamat']) ? $_POST['editAlamat'] : null,
        'email'            => isset($_POST['editEmail']) ? $_POST['editEmail'] : null,
        'ttl_member'       => isset($_POST['editTtl']) ? $_POST['editTtl'] : null,
        'jk_member'        => isset($_POST['editJk']) ? $_POST['editJk'] : null,
        'hp_member'        => isset($_POST['editHp']) ? $_POST['editHp'] : null
    ];

    foreach($data as $key => $value){
        if(empty($value)){
            $return['error'][$key] = $key.' field tidak boleh kosong';
        }
    }

    if(!empty($return['error'])){
        $return['hasil'] = 'error';
    }
    else{
        $return['hasil'] = 'sukses';
        //belum diganti

        //$input bs diganti pake array $data
        $input = ['nm_barang' => 'costas'];
        $where = ['id' => 34];
        //$stmt = $con->update('barang', $input, $where);
        //$stmt->execute();
    }

    echo json_encode($return);
}
elseif($action == 'editfoto'){
    $profil = new Profil($con);
    //$id = isset($_SESSION['username']) ? $_SESSION['username'] : '';
    //post token itu apa ya?
    $id = isset($_POST['token']) ? $_POST['token'] : null;
    $foto = isset($_FILES['foto']) ? $_FILES['foto'] : [];

    //ambil data dari validate file, return array jika benar, selain itu false
    $datafoto = $profil->validateFile($foto);

    if($datafoto == false){
        $return['error']['file'] = 'file tidak boleh kosong'; 
    }

    if(!empty($return['error'])){
        $return['hasil'] = 'error';
    }
    else{
        $return['hasil'] = 'sukses';

        //update foto
        //blm diganti
        $input = ['nm_barang' => 'costas'];
        $where = ['id' => 34];
        $stmt = $con->update('barang', $input, $where);
        $stmt->execute();

        //pindahkan image
        //move_uploaded_file($datafoto['filetmp'], '../images/profil/'.$datafoto['filename']);
    }

    //ganti array ke json, dan echo sbg text html untuk dikembalikan ke ajax
    echo json_encode($return);
}
else{
    //error action kosong
}
?>
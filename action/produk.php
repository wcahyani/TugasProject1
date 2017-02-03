<?php
require '../config/config.php';
require '../model/Produk.php';

$produk = new Produk($con);

$action   = isset($_GET['action']) ? $_GET['action'] : null;

//insert produk baru
if($action == 'insert'){
    $data = [
        'NamaProduk'    => $_POST['NamaProduk'] ?: null,
        'Keterangan'    => $_POST['Keterangan'] ?: null,
        'Harga'         => $_POST['Harga'] ?: null,
        'Ukuran'        => $_POST['Ukuran'] ?: null,
        'Foto'          => $_FILES['Foto'] ?: []
    ];

    foreach($data as $key => $value){
        if(empty($value)){
            $return['error'][$key] = $key.' tidak boleh kosong';
        }
    }
    
    if( !$datafoto = $produk->validateFile($data['Foto']) ){
        $return['error']['Foto'] = 'Foto tidak boleh kosong';
    }

    if(!empty($return['error'])){
        $return['hasil'] = 'gagal';
    }
    else{
        $insert = [
            'id_produk'     => null,
            'nama_produk'   => $data['NamaProduk'],
            'foto_produk'   => $datafoto['filename'],
            'ket_produk'    => $data['Keterangan'],
            'harga_produk'  => $data['Harga'],
            'id_penjual'    => null,
            'ukuran'        => $data['Ukuran']
        ];

        $stmt = $con->insert('tabel_product', $insert);
        $stmt->execute();

        $return['hasil'] = 'sukses';
        move_uploaded_file($datafoto['filetmp'], '../images/produk/'.$datafoto['filename']);
    }

    echo json_encode($return);
}
//update produk baru
elseif($action == 'update'){
    $data = [
        'token'             => $_POST['_token'] ?: null,
        'editNamaProduk'    => $_POST['editNamaProduk'] ?: null,
        'editKeterangan'    => $_POST['editKeterangan'] ?: null,
        'editHarga'         => $_POST['editHarga'] ?: null,
        'editUkuran'        => $_POST['editUkuran'] ?: null,
        'Foto'              => $_FILES['editFoto'] ?: []
    ];

    foreach($data as $key => $value){
        if(empty($value)){
            $err = substr($key, 4);
            $return['error'][$key] = $err.' tidak boleh kosong';
        }
    }

    //boleh update foto kosong, trigger mysql
    if( !$datafoto = $produk->validateFile($data['Foto']) ){
        //$return['error']['editFoto'] = 'Foto tidak boleh kosong';
        $datafoto['filename'] = null;
    }

    if(!empty($data['editNamaProduk'])){
        $stmt = $con->select('tabel_product', ['nama_produk' => $data['editNamaProduk']]);
        $stmt->execute();

        if($stmt->rowCount() > 0){
            $return['error']['editNamaProduk'] = 'Nama Produk sudah terpakai';
        }
    }

    if(!empty($return['error'])){
        $return['hasil'] = 'gagal';
    }
    else{
        $update = [
            'nama_produk'   => $data['editNamaProduk'],
            'foto_produk'   => $datafoto['filename'],
            'ket_produk'    => $data['editKeterangan'],
            'harga_produk'  => $data['editHarga'],
            'id_penjual'    => null,
            'ukuran'        => $data['editUkuran']
        ];

        $where = ['id_produk' => $data['token']];

        $stmt = $con->update('tabel_product', $update, $where);
        $stmt->execute();

        if($datafoto['filename'] != null){
            move_uploaded_file($datafoto['filetmp'], '../images/produk/'.$datafoto['filename']);
        }
        
        $return['hasil'] = 'sukses';
    }

    echo json_encode($return);
}
//delete produk
elseif($action == 'delete'){
    if(isset($_GET['id'])){
        $stmt = $con->delete('tabel_product', ['id_produk' => $_GET['id']]);
        $stmt->execute();
    }
}
else{
    //error action kosong
}
?>
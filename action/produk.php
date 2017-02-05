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

$produk = new Produk($con);

$action   = isset($_GET['action']) ? $_GET['action'] : null;

//insert produk baru
if($action == 'insert'){
    $data = [
        'NamaProduk'  => $_POST['NamaProduk'] ?: null,
        'Deskripsi'   => $_POST['Deskripsi'] ?: null,
        'Harga'       => $_POST['Harga'] ?: null,
        'Ukuran'      => $_POST['Ukuran'] ?: null,
        'Kategori'    => $_POST['Kategori'] ?: null,
        'Foto'        => $_FILES['Foto'] ?: []
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
            'ket_produk'    => $data['Deskripsi'],
            'harga_produk'  => $data['Harga'],
            'id_penjual'    => null,
            'ukuran'        => $data['Ukuran'],
            'id_kategori'   => $data['Kategori']
        ];

        $stmt = $con->insert('tabel_product', $insert);
        $stmt->execute();

        $return['hasil'] = 'sukses';
        $return['data'] = $insert['nama_produk'];
        move_uploaded_file($datafoto['filetmp'], '../images/produk/'.$datafoto['filename']);
    }

    echo json_encode($return);
}
elseif($action == 'select'){
    $produk = new Produk($con);
    $data = $produk->getAllProduk();
	
	$no = 1;
	while($row = $data->fetch(PDO::FETCH_OBJ)){
    echo '<tr>
            <td>'. $no++ .'</td>
            <td class="text-center">
                <img src="images/produk/'. $row->foto_produk .'" width="88">
            </td>
            <td>'. $row->nama_produk   .'</td>
            <td>'. $row->nama_kategori .'</td>
            <td>'. $row->harga_produk  .'</td>
            <td>'. strtoupper($row->ukuran) .'</td>
            <td class="center">
                <button type="button" data-id="'. $row->id_produk .'" class="btn btn-primary btn-xs editProButton" data-toggle="modal" data-target="#myModal">Edit</button>
            </td>
            <td class="center">
                <button type="button" data-id="'. $row->id_produk .'" class="btn btn-primary btn-xs deleteProButton">Delete</button>
            </td>
        </tr>';
    }
}
//ambil satu data produk
elseif($action == 'selectid'){
    $id = $_GET['id'] ?: null;

	$stmt = $con->select('tabel_product', ['id_produk' => $id]);
	$stmt->execute();

	$return = $stmt->fetch(PDO::FETCH_ASSOC);

    echo json_encode($return);
}
//update produk baru
elseif($action == 'update'){
    $data = [
        'id'              => $_POST['editIdProduk'] ?: null,
        'editNamaProduk'  => $_POST['editNamaProduk'] ?: null,
        'editKategori'    => $_POST['editKategori'] ?: null,
        'editDeskripsi'   => $_POST['editDeskripsi'] ?: null,
        'editHarga'       => $_POST['editHarga'] ?: null,
        'editUkuran'      => $_POST['editUkuran'] ?: null,
        'Foto'            => $_FILES['editFoto'] ?: []
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

    /*if(!empty($data['editNamaProduk'])){
        $stmt = $con->select('tabel_product', ['nama_produk' => $data['editNamaProduk']]);
        $stmt->execute();

        if($stmt->rowCount() > 0){
            $return['error']['editNamaProduk'] = 'Nama Produk sudah terpakai';
        }
    }*/

    if(!empty($return['error'])){
        $return['hasil'] = 'gagal';
    }
    else{
        if($datafoto['filename'] != null){
            $update = [
                'nama_produk'   => $data['editNamaProduk'],
                'foto_produk'   => $datafoto['filename'],
                'ket_produk'    => $data['editDeskripsi'],
                'harga_produk'  => $data['editHarga'],
                'id_penjual'    => null,
                'ukuran'        => $data['editUkuran'],
                'id_kategori'   => $data['editKategori']
            ];

            move_uploaded_file($datafoto['filetmp'], '../images/produk/'.$datafoto['filename']);
        }
        else{
            $update = [
                'nama_produk'   => $data['editNamaProduk'],
                'ket_produk'    => $data['editDeskripsi'],
                'harga_produk'  => $data['editHarga'],
                'id_penjual'    => null,
                'ukuran'        => $data['editUkuran'],
                'id_kategori'   => $data['editKategori']
            ];
        }

        $where = ['id_produk' => $data['id']];
        $stmt = $con->update('tabel_product', $update, $where);
        $stmt->execute();
        
        $return['hasil'] = 'sukses';
        $return['data'] = $update['nama_produk'];
    }

    echo json_encode($return);
}
//delete produk
elseif($action == 'delete'){
    $id = $_GET['id'] ?: null;

    $stmt = $con->select('tabel_product', ['id_produk' => $id], 'nama_produk, foto_produk');
	$stmt->execute();
    $data = $stmt->fetch(PDO::FETCH_OBJ);
    
    $nama = $data->nama_produk;
    $foto = $data->foto_produk;
    
	$stmt = $con->delete('tabel_product', ['id_produk' => $id]);
	$stmt->execute();

    //hapus foto produk
    unlink("../images/produk/$foto");

	$return['hasil'] = 'sukses';
    $return['data'] = $nama;

    echo json_encode($return);
}
else{
    header('location: view/404.html');
}
?>
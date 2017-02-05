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

$action = $_GET['action'] ?: '';

// input category
if($action == 'insert'){
	$nama = isset($_POST['Nama']) ? $_POST['Nama'] : null;
	$ket  = isset($_POST['Ket']) ? $_POST['Ket'] : null;

	if(empty($nama)){
		$return['error']['nama'] = 'Kategori tidak boleh kosong';
	}
	else{
		$stmt = $con->select('kategori', ['nama_kategori' => $nama], 'id_kategori');
		$stmt->execute();

		if($stmt->rowCount() > 0){
			$return['error']['nama'] = 'Kategori sudah digunakan';
		}
	}

	if(!empty($return['error'])){
		$return['hasil'] = 'error';
	}
	else{
		$insert = [
			'id_kategori'   => null,
			'nama_kategori' => $nama,
			'ket_kategori'  => $ket
		];

		$stmt = $con->insert('kategori', $insert);
		$stmt->execute();

		$return['hasil'] = 'sukses';
		$return['data'] = $insert['nama_kategori'];
	}
	echo json_encode($return);
}
//select semua kategori
elseif($action == 'select'){
	$stmt = $con->select('kategori');
	$stmt->execute();
	
	$no = 1;
	while($row = $stmt->fetch(PDO::FETCH_OBJ)){
		$kat = $row->ket_kategori != null ? $row->ket_kategori : '-';
		echo '<tr>';
		echo 	'<td>'. $no++ .'</td>';
		echo 	'<td>'. $row->nama_kategori .'</td>';
		echo 	'<td>'. $kat .'</td>';
		echo 	'<td class="center"><button type="button" data-id="'. $row->id_kategori .'" class="btn btn-primary btn-xs editCatButton" data-toggle="modal" data-target="#myModalcat">Edit</button></td>';
		echo 	'<td class="center"><button type="button" data-id="'. $row->id_kategori .'" class="btn btn-primary btn-xs deleteCatButton">Delete</button></td>';
		echo '</tr>';
	}

	/*while($row = $stmt->fetch(PDO::FETCH_OBJ)){
		$return['data'][] = $row;
	}

	echo json_encode($return);*/
}
//ambil satu kategori
elseif($action == 'selectid'){
	$id = $_GET['id'] ?: null;

	$stmt = $con->select('kategori', ['id_kategori' => $id]);
	$stmt->execute();

	$return = $stmt->fetch(PDO::FETCH_ASSOC);

    echo json_encode($return);
}
// update category
elseif($action == 'update'){
	$id 	 = isset($_POST['editId']) ? $_POST['editId'] : null;
	$oldnama = isset($_POST['oldNama']) ? $_POST['oldNama'] : null;
	$nama 	 = isset($_POST['editNama']) ? $_POST['editNama'] : null;
	$ket 	 = isset($_POST['editKet']) ? $_POST['editKet'] : null;

	if(empty($nama)){
		$return['error']['nama'] = 'Kategori tidak boleh kosong';
	}
	else{
		if($oldnama != $nama){
			$stmt = $con->select('kategori', ['nama_kategori' => $nama], 'id_kategori');
			$stmt->execute();

			if($stmt->rowCount() > 0){
				$return['error']['nama'] = 'Kategori sudah digunakan';
			}
		}
	}

	if(!empty($return['error'])){
		$return['hasil'] = 'error';
	}
	else{
		$update = [
			'nama_kategori' => $nama,
			'ket_kategori'  => $ket
		];

		$where = ['id_kategori' => $id];

		$stmt = $con->update('kategori', $update, $where);
		$stmt->execute();

		$return['hasil'] = 'sukses';
		$return['data'] = $update['nama_kategori'];
	}
	echo json_encode($return);
}
// delete category
elseif($action == 'delete'){
	$id = $_GET['id'] ?: null;

	$stmt = $con->select('kategori', ['id_kategori' => $id], 'nama_kategori');
	$stmt->execute();
	$data = $stmt->fetch(PDO::FETCH_OBJ);
	
	$nama = $data->nama_kategori;

	$stmt = $con->delete('kategori', ['id_kategori' => $id]);
	$stmt->execute();

	$return['hasil'] = 'sukses';
	$return['data'] = $nama;
	
    echo json_encode($return);
}
else{
	header('location: ../view/404.html');
}


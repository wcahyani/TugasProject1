<?php
require '../config/config.php';

$aksi = $_GET['aksi'] ?: '';
// input category
if($aksi == 'inputcategory'){
	$nameCategory = isset($_POST['namacategory']) ? $_POST['namacategory'] : null;

	if(empty($nameCategory)){
		$return['error']['category'] = 'Nama category tidak boleh kosong';
	}
	if(!empty($return['error'])){
		$return['hasil'] = 'error';
	}
	else{
		$return['hasil'] = 'sukses';
	}
	echo json_encode($return);
}
// edit category
elseif($aksi == 'editcategory'){
	$nameCategory = isset($_POST['namacategory']) ? $_POST['namacategory'] : null;
	if(empty($nameCategory)){
		$return['error']['category'] = 'Nama category tidak boleh kosong';
	}
	if(!empty($return['error'])){
		$return['hasil'] = 'error';
	}
	else{
		$return['hasil'] = 'sukses';
	}
	echo json_encode($return);
}
// delete category
elseif($aksi == 'deletecategory'){
	if(isset($_GET['idCategory'])){
		//
	}
}


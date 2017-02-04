<?php

$konten = isset($_GET["konten"]) ? $_GET["konten"] : '';

if($konten == ""){
	//halaman pertama
	include "view/home.php";
}
elseif($konten == "login"){
	include "view/login.html";
}
elseif ($konten == "register"){
	include "view/regist.html";
}
elseif($konten == "profil"){
	include "view/regist.html";
}
elseif($konten == "dataproduk"){
	include "view/dataproduk.html";
}
elseif($konten == "datacategory"){
	include "view/datacategory.html";
}
else{
	include "view/404.html";
}
?>
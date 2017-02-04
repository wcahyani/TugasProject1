<?php

//$konten = isset($_GET["konten"]) ? $_GET["konten"] : '';

/*if($konten == ""){
	//halaman pertama
	include "view/home.php";
}
elseif($konten == "login"){
	include "view/login.php";
}
elseif ($konten == "register"){
	include "view/regist.html";
}
elseif($konten == "profil"){
	include "view/profil.php";
}
elseif($konten == "dataproduk"){
	include "view/dataproduk.html";
}
elseif($konten == "datacategory"){
	include "view/datacategory.html";
}
else{
	include "view/404.html";
}*/

if(isset($_GET['login'])){
	include "view/login.php";
}
elseif(isset($_GET['register'])){
	include "view/regist.html";
}
elseif(isset($_GET['profil'])){
	include "view/profil.php";
}
elseif(isset($_GET['databaju'])){
	include "view/databaju.php";
}
elseif(isset($_GET['kategori'])){
	include "view/kategori.php";
}
else{
	include "view/home.php";
}
?>
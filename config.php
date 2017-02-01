<?php
$host = 'localhost';
$db = 'test';
$user = 'root';
$pass = '';
$dsn = "mysql:host=$host;dbname=$db";

try
{
	$conn = new PDO($dsn, $user, $pass);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
}
catch(PDOException $e)
{
	echo "Error Dalam Memanggil Database </br>";
	echo "Error : ".$e->getMessage();
}
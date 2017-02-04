<?php
date_default_timezone_set('Asia/Jakarta');

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

$settings = Array(
   'driver'    => 'mysql',
   'host'      => 'localhost',
   'port'      => '3306',
   'schema'    => 'db_penjualan',
   'username'  => 'root',
   'password'  => ''
);

$dns = $settings['driver'] . ':host=' . $settings['host'] . 
                             ';port=' . $settings['port'] . 
                             ';dbname=' . $settings['schema'];

$con = new ConnectionPDO($dns, $settings['username'], $settings['password']);
?>
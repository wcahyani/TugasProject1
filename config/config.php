<?php
spl_autoload_register(function ($class)
{
    if (file_exists('../model/'. $class .'.php'))
        require '../model/'. $class . '.php';
    else
        exit('Couldn\'t open class '.$class.'!');
});

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

$settings = Array(
   'driver'    => 'mysql',
   'host'      => 'localhost',
   'port'      => '3306',
   'schema'    => 'test',
   'username'  => 'root',
   'password'  => ''
);

$dns = $settings['driver'] . ':host=' . $settings['host'] . 
                             ';port=' . $settings['port'] . 
                             ';dbname=' . $settings['schema'];

$con = new ConnectionPDO($dns, $settings['username'], $settings['password']);
?>
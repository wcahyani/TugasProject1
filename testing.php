<?php
//test panggil data dari model
//require 'config.php';

//pake autoload sbg pengganti require model
spl_autoload_register(function ($class)
{
    if (file_exists('model/'. $class .'.php'))
        require 'model/'. $class . '.php';
    else
        exit('Couldn\'t open class '.$class.'!');
});

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

//$stmt = NULL;

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

//$log = '';
//$con->insert('barang',Array('nm_barang' => 'Sexto123', 'harga' => '600 '))->execute();

//===================test area======================//

/*test panggil barang
 |
 |  $barang = new Produk($conn);
 |  $data = $barang->getAllProduk();
 |
 |  while($row = $data->fetch(PDO::FETCH_OBJ)){
 |      echo $row->id, '</br>';
 |      echo $row->nm_barang, '</br>';
 |      echo $row->harga, '</br></br>';
 |  }
*/

/*test login
 |
 | $user = new Member($con);
 | if($data = $user->authLogin('emon', 'admin')){
 |     print_r($data);
 | }
 | else{
 |     echo 'gagal login';
 | }
*/

/*test check duplikat
 |
 |  $user = new Member($conn);
 |  if($user->checkMember('baju2') == false){
 |      echo 'tidak duplikat';
 |  }
 |  else{
 |      echo 'duplikat';
 |  }
*/

/*test insert
 |  $user = new Member($conn);
 |  $data = [
 |      'nama'  => 'huawei',
 |      'harga' => '344444'
 |  ];
 |  
 |  if($user->insertMember($data)){
 |      echo 'berhasil';
 |  }
 |  else{
 |      echo 'gagal';
 |  }
*/
?>
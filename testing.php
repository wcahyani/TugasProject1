<?php
//test panggil data dari model
require 'config.php';
//require 'model/Produk.php';

//pake autoload sbg pengganti require model
spl_autoload_register(function ($class)
{
    require 'model/'. $class . '.php';
});

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
 |  $user = new Member($conn);
 |  if($user->authLogin('admin', 'admin')){
 |      echo 'berhasil login';
 |  }
 |  else{
 |      echo 'gagal login';
 |  }
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
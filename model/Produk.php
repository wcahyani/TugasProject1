<?php
Class Produk
{
    private $conn;

    /*
    |-------------------------------------------------
    | fungsi yg dieksekusi saat objek dibuat
    |--------------------------------------------------
    |
    | Parameter :
    | $db = Object (objek koneksi new PDO)
    |
    */
    public function __construct($db)
    {
        $this->conn = $db;
    }

    /*
    |-------------------------------------------------
    | ambil data produk dan kategori
    |--------------------------------------------------
    |
    | Return :
    | jika berhasil = Array data produk;
    |
    */
    public function getAllProduk()
    {
        $query = "SELECT id_produk, nama_produk, foto_produk, ukuran, harga_produk, nama_kategori FROM tabel_product
                  INNER JOIN kategori ON tabel_product.id_kategori = kategori.id_kategori";
        $data = $this->conn->prepare($query);
        $data->execute();
        return $data;
    }

    /*
    |-------------------------------------------------
    | validasi foto : cek empty file, nama file,
    | duplikat file.
    |--------------------------------------------------
    |
    | Parameter :
    | $data = Array ($_FILES['foto'])
    |
    | Return :
    | jika berhasil = Array ['filetmp' => 'tmp_name', 'filename' => 'name'];
    | jika gagal = FALSE
    |
    */
    public function validateFile(Array $data)
    {
        $filetmp = $data['tmp_name'];

        if(is_uploaded_file($filetmp)){
            $filename = $data['name'];

            //menghilangkan karakter yang tidak diinginkan
            $filename = preg_replace("/[^a-zA-Z0-9.]/", "_", $filename);

            //memisahkan nama dan ekstensi file
            $filename2 = pathinfo($filename, PATHINFO_FILENAME);
            $ext =  pathinfo($filename, PATHINFO_EXTENSION);

            //cek duplikat file
            $FileCounter = 1;
            while (file_exists('../images/produk/'.$filename ))
            {
                $filename = $filename2 .'_'. $FileCounter++ .'.'. $ext;
            }

            $array = ['filetmp' => $filetmp, 'filename' => $filename];
            return $array;
        }
        else{
            return false;
        }
    }
}
?>
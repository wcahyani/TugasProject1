<?php
Class Produk
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    //tampilkan semua produk
    public function getAllProduk()
    {
        $query = "SELECT * FROM barang";
        $data = $this->conn->prepare($query);
        $data->execute();
        return $data;
    }

    //ambil data produk berdasarkan id produk
    public function getProduk($id)
    {
        $query = "";
        $data = $this->conn->prepare($query);
        $data->execute();
        return $data;
    }

    //input data produk baru
    public function insertProduk(Array $data)
    {
        $query = "";
        $data = $this->conn->prepare($query);
        $data->execute();
        return true;
    }

    //simpan update produk
    public function updateProduk(Array $data)
    {
        $query = "";
        $data = $this->conn->prepare($query);
        $data->execute();
        return true;
    }

    //hapus produk
    public function deleteProduk($id)
    {
        $query = "";
        $data = $this->conn->prepare($query);
        $data->execute();
        return true;
    }

    //cek duplikat id produk
    public function checkProduk($id){
        $query = "";
        $data = $this->conn->prepare($query);
        $data->bindParam(':id', $id);
        $data->execute();

        //jika ada dupikat return true
        if($data->rowCount() > 0){
            return true;
        }
        else{
            return false;
        }
    }

    //validasi foto
    //cek empty file, nama file, duplikat file
    //return array ['filetmp' => 'tmp_name', 'filename' => 'name'];
    //false jika salah
    public function validateFile(Array $data)
    {
        $filetmp = $file['tmp_name'];

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
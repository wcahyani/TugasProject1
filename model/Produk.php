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
}
?>
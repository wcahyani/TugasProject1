<?php
Class Kategori
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    //tampilkan semua kategori
    public function getAllKategori()
    {
        $query = "";
        $data = $this->conn->prepare($query);
        $data->execute();
        return $data;
    }

    //ambil data kategori berdasarkan id
    public function getKategori($id)
    {
        $query = "";
        $data = $this->conn->prepare($query);
        $data->execute();
        return $data;
    }

    //simpan data kategori baru
    public function insertKategori(Array $data)
    {
        $query = "";
        $data = $this->conn->prepare($query);
        $data->execute();
        return $data;
    }

    //simpan data update kategori
    public function updateKategori(Array $data)
    {
        $query = "";
        $data = $this->conn->prepare($query);
        $data->execute();
        return $data;
    }

    //hapus kategori
    public function deleteKategori($id)
    {
        $query = "";
        $data = $this->conn->prepare($query);
        $data->execute();
        return $data;
    }
}
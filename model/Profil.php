<?php
Class Profil
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    /*public function getAllProfil()
    {
        $query = "";
        $data = $this->conn->prepare($query);
        $data->execute();
        return $data;
    }*/

    //ambil profil berdasarkan id
    public function getProfil($id)
    {
        $query = "";
        $data = $this->conn->prepare($query);
        $data->execute();
        return $data;
    }

    /*public function insertProfil(Array $data)
    {
        $query = "";
        $data = $this->conn->prepare($query);
        $data->execute();
        return $data;
    }*/

    //simpan update profil user baru
    public function updateProfil(Array $data)
    {
        $query = "";
        $data = $this->conn->prepare($query);
        $data->execute();
        return $data;
    }

    //hapus profil
    /*public function deleteProfil($id)
    {
        $query = "";
        $data = $this->conn->prepare($query);
        $data->execute();
        return $data;
    }*/
}
?>
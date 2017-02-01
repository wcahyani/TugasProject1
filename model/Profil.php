<?php
Class Profil
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    //ambil profil berdasarkan id
    public function getProfil($id)
    {
        $query = "";
        $data = $this->conn->prepare($query);
        $data->execute();
        return $data;
    }

    //simpan update profil user baru
    public function updateProfil(Array $data)
    {
        $query = "";
        $data = $this->conn->prepare($query);
        $data->execute();
        return true;
    }

    //simpan foto profil baru
    public function updateFoto($id, $file)
    {
        $query = "";
        $data = $this->conn->prepare($query);
        $data->execute();
        return true;
    }

    //cek duplikat id profil
    public function checkProfil($id){
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
            while (file_exists('../images/profil/'.$filename ))
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
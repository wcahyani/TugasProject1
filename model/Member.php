<?php
Class Member
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
    | validasi login
    |--------------------------------------------------
    |
    | Parameter :
    | $username = String (username)
    | $password = String (password)
    |
    | Return :
    | jika berhasil = Array ['id', 'username', 'level'];
    | jika gagal = FALSE
    |
    */
    public function authLogin($username, $password)
    {
        $query = "SELECT id_profil, username, password, level FROM member WHERE username = :username";
        $data = $this->conn->prepare($query);
        $data->bindParam(':username', $username);
        $data->execute();

        if($data->rowCount() > 0){
            $row = $data->fetch(PDO::FETCH_OBJ);

            if(password_verify($password, $row->password)){
                $this->username = $username;
                $array = [
                    'id'        => $row->id_profil,
                    'username'  => $row->username,
                    'level'     => $row->level
                ];
                
                return $array;
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }
    }
}
?>
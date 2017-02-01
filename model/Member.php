<?php
Class Member
{
    private $conn;
    private $username;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    //ambil data username member
    public function getUsername()
    {
        return $this->username;
    }

    //ambil seluruh data member
    public function getAllMember()
    {
        $query = "";
        $data = $this->conn->prepare($query);
        $data->execute();
        return $data;
    }

    //ambil data member berdasarkan id
    public function getMember($id)
    {
        $query = "";
        $data = $this->conn->prepare($query);
        $data->execute();
        return $data;
    }

    //insert data member baru
    public function insertMember(Array $data)
    {
        $query = "";
        $data = $this->conn->prepare($query);
        $data->execute();
        return true;
    }

    //update data member
    public function updateMember(Array $data)
    {
        $query = "";
        $data = $this->conn->prepare($query);
        $data->execute();
        return true;
    }

    //hapus member
    public function deleteMember($id)
    {
        $query = "";
        $data = $this->conn->prepare($query);
        $data->execute();
        return true;
    }

    //fungsi register jika seluruh validasi berhasil dilewatkan
    public function register(Array $data)
    {
        $username = $data['username'];
        $password = password_hash($data['password'], PASSWORD_BCRYPT);
        $email = $data['email'];

        $query = "INSERT INTO table VALUES()";
        $query->execute();
        return true;
    }

    //fungsi login jika seluruh validasi berhasil dilewati
    public function authLogin($username, $password)
    {
        $query = "SELECT id, name, password FROM users WHERE name = :username";
        $data = $this->conn->prepare($query);
        $data->bindParam(':username', $username);
        $data->execute();

        if($data->rowCount() > 0){
            $row = $data->fetch(PDO::FETCH_OBJ);

            if(password_verify($password, $row->password)){
                $this->username = $username;
                //$_SESSION['id'] = $row->id;
                //$_SESSION['username'] = $row->username;

                $date = date('d-m-Y');
                $this->conn->query("UPDATE users SET remember_token = '$date'");
                //$new->execute();
                return true;
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
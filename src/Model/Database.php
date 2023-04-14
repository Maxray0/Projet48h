<?php 
use FFI\Exception;

class DAO {
    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }
    function readtable($table){        
        $query = 'SELECT * FROM '.$table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    function AddUser($email, $pass, $schoolId, $userType){
        $query = ('INSERT INTO users (Email, EncryptedPassword, SchoolId, UserType,) VALUES (:email, :pass, :schoolId, :userType)');
            $stmt = $this->conn->prepare($query);
            $stmt->execute([':email'=>$email,':EncryptedPassword'=>$pass, ':SchoolId'=>$schoolId, ':UserType'=>$userType]);
        header('Location: http://localhost/Projet48h/home', true, 303);
        die();
    }
}
?>
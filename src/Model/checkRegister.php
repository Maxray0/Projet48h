<?php
$email = htmlspecialchars($_POST['email']);
$password = htmlspecialchars($_POST['password']);
$password2 = htmlspecialchars($_POST['password2']);
$schoolId = (int) htmlspecialchars($_POST['schoolCode']);
$userType = (int) htmlspecialchars($_POST['userType']);
function ReturnEncryptedPassword($password, $password2) {
    if (strcmp($password, $password2) == 0) {
        return password_hash($password, PASSWORD_DEFAULT);
    } else {
        return false;
    }
}

function AddUser($email, $pass, $schoolId, $userType) {
    $servername = "localhost"; 
    $database = "wokspacenow"; 
    $username = "root"; 
    $password = "";
    $sql = "mysql:host=$servername;dbname=$database;";
    $dsn_Options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
    try { 
      $my_Db_Connection = new PDO($sql, $username, $password, $dsn_Options);
      echo "Connexion réussie";
    } catch (PDOException $error) {
      echo 'Échec de la connexion : ' . $error->getMessage();
    }
    $my_Insert_Statement = $my_Db_Connection->prepare('INSERT INTO user (Email, EncryptedPassword, SchoolId, UserType) VALUES (:email, :pass, :schoolId, :userType)');
    $my_Insert_Statement->bindParam(':email', $email);
    $my_Insert_Statement->bindParam(':pass', $pass);
    $my_Insert_Statement->bindParam(':schoolId', $schoolId);
    $my_Insert_Statement->bindParam(':userType', $userType);
    if ($my_Insert_Statement->execute()) {
      echo "Nouveau enregistrement créé avec succès";
    } else {
      echo "Impossible de créer l'enregistrement";
    }
}

$userPass = ReturnEncryptedPassword($password, $password2);

if ($userPass == false) {
    header('Location: http://localhost/Projet48h/register');
    die();
} else {
    try {
        AddUser($email, $userPass, $schoolId, $userType);
        session_start();
        $_SESSION["email"]=$email;       
        $_SESSION["schoolId"]=$schoolId;
        header('Location: http://localhost/Projet48h/home');
        die();
    } catch (Exception $e) {
        header('Location: http://localhost/Projet48h/error');
        die();
    }
}


?>
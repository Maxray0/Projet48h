<?php
$email = htmlspecialchars($_POST['userEmail']);
$password = htmlspecialchars($_POST['userPassword']);


function IsUser($email, $pass) {
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
    $my_Insert_Statement = $my_Db_Connection->prepare('SELECT * FROM user WHERE Email = :email AND EncryptedPassword = :pass');
    $my_Insert_Statement->bindParam(':email', $email);
    $pass = password_hash($pass, PASSWORD_DEFAULT);
    $my_Insert_Statement->bindParam(':pass', $pass);
    if ($my_Insert_Statement->execute()) {
        echo "Nouveau enregistrement créé avec succès";
        return true;
    } else {
      echo "Impossible de créer l'enregistrement";
        return false;
    }
}

function GetSchoolIdByEmail($email) {
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
    $my_Insert_Statement = $my_Db_Connection->prepare('SELECT SchoolId FROM user WHERE Email = :email');
    $my_Insert_Statement->bindParam(':email', $email);
    $schoolId = $my_Insert_Statement->execute();
    return $schoolId;
}

if (IsUser($email, $password)) {
    session_start();
    if (isset($_SESSION["email"])) {
        session_destroy();
    }
    $_SESSION["SchoolId"]=GetSchoolIdByEmail($email);
    $_SESSION["email"]=$email;
    header('Location: http://localhost/Projet48h/home');
    die();
} else {
    header('Location: http://localhost/Projet48h/login');
    die();
}
?>
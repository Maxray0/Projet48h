<?php

session_start();

$host = 'localhost';
$dbname = 'workspacenow';
$username = 'root';
$password = 'root';

try {

   $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
} catch (PDOException $e) {

   die("Impossible de se connecter à la base de données $dbname :" . $e->getMessage());
}

function RequestData($request)
{

   $host = 'localhost';
   $dbname = 'workspacenow';
   $username = 'root';
   $password = 'root';
   $dsn = "mysql:host=$host;dbname=$dbname";
   $sql = $request;

   try {
      $pdo = new PDO($dsn, $username, $password);
      $stmt = $pdo->query($sql);

      if ($stmt === false) {
         die("Erreur");
      }
      return $stmt;
   } catch (PDOException $e) {
      echo $e->getMessage();
      return false;
   }
}

function UpdateData($request)
{
   $host = 'localhost';
   $dbname = 'workspacenow';
   $username = 'root';
   $password = 'root';
   $dsn = "mysql:host=$host;dbname=$dbname";
   $sql = $request;

   try {
      $pdo = new PDO($dsn, $username, $password);
      $stmt = $pdo->prepare($sql);
      $stmt->execute();

      if ($stmt === false) {
         die("Erreur");
      }
      return $stmt;
   } catch (PDOException $e) {
      echo $e->getMessage();
   }
}

<?php

include "db_connection.php";

$dataroom =  htmlspecialchars($_POST['roomId']);
$datadates = $_SESSION['dates'];
$datauser = $_SESSION['email'];

$salle = RequestData("SELECT * FROM Room WHERE Id = '$dataroom'");
$row3 = $salle->fetch(PDO::FETCH_ASSOC);
$dataSalle = $row3['Name'];
$userData = RequestData("SELECT * FROM User WHERE Email = '$datauser'");
$row = $userData->fetch(PDO::FETCH_ASSOC);
$idSchoolUser = $row['SchoolName'];
$ecole = RequestData("SELECT * FROM School WHERE Id = '$idSchoolUser'");
$row2 = $ecole->fetch(PDO::FETCH_ASSOC);
$dataEcole = $row2['Id'];
UpdateData("UPDATE Room SET Dates = CONCAT(Dates, '/', '$datadates') WHERE Id = '$dataroom'");
UpdateData("UPDATE User SET Reservations = CONCAT(Reservations, '$dataSalle', ',', '$datadates', ',', '$dataEcole', '/') WHERE Email = '$datauser'");

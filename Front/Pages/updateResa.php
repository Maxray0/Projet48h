<?php

include "db_connection.php";

$dataroom =  htmlspecialchars($_POST['roomId']);
$datadates = $_SESSION['dates'];
$datauser = $_SESSION['user'];

$salle = RequestData("SELECT Name FROM Room WHERE Id = $dataroom");
$userData = RequestData("SELECT * FROM User WHERE Email = $datauser");
$idSchoolUser = $userData['SchoolId'];
$ecole = RequestData("SELECT Name FROM School WHERE Id = $idSchoolUser");

UpdateData("UPDATE Room SET Dates = CONCAT(Dates, '/', '$datadates') WHERE Id = $dataroom");
UpdateData("UPDATE User SET Reservations = CONCAT(Reservations, '$salle', ',', '$datadates', ',', '$ecole', '/') WHERE Email = $datauser");

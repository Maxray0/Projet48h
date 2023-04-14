<?php

include "db_connection.php";

$dataroom =  htmlspecialchars($_POST['roomId']);
$datadates = '/' . $_SESSION['dates'];
$datauser;

UpdateData("UPDATE Room SET Dates = CONCAT(Dates, '$datadates') WHERE Id = $dataroom");
UpdateData("UPDATE User SET Reservations = CONCAT(Reservations, '$datadates') WHERE Email = $datauser");

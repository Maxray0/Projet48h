<?php

$dates = htmlspecialchars($_POST['trip-start']) . ' ' . htmlspecialchars($_POST['appt']);
if (isset($_SESSION["dates"])) {
    unset($_SESSION["dates"]);
}
$_SESSION["dates"] = $dates;

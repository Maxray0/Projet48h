<?php
// use Ecommerce\Model\Database;
// $database = new Database();
// $db = $database->connect();
// $dao = new DAO($db);
// try {
//     $cl = include('src\Model\checkLogin.php');

// } catch (Exception $e) {
//     print("no");
// }
$request = $_SERVER['REQUEST_URI'];
session_start();
if (isset($_SESSION['email'])) {
    switch ($request) {
        case '/Projet48h/home':
            require __DIR__ . '/Front/Pages/home.html';
            break;
        case '/Projet48h/validation':
            require __DIR__ . '/Front/Pages/validation.html';
            break;
        case '/Projet48h/checkreserv':
            require __DIR__ . '/Front/Pages/checkReserv.html';
            break;
        case '/Projet48h/reservation':
            require __DIR__ . '/Front/Pages/reservation.html';
            break;
        case '/Projet48h/dbconnect':
            require __DIR__ . '/Front/Pages/reservation.html';
            break;
        case '/Projet48h/profil':
            require __DIR__ . '/Front/Pages/profil.html';
            break;
            //---------------------------------------------------------------------------------
        default:
            require __DIR__ . '/Front/Pages/home.html';
            break;
    }
} else {
    switch ($request) {
            //---------------------------------------------------------------------------------
        case '/Projet48h/login':
            require __DIR__ . '/Front/Pages/login.html';
            break;

        case '/Projet48h/veryfLogin':
            require __DIR__ . '/src/Model/checkLogin.php';
            break;
            //---------------------------------------------------------------------------------
        case '/Projet48h/register':
            require __DIR__ . '/Front/Pages/signin.html';
            break;

        case '/Projet48h/veryfRegister':
            require __DIR__ . '/src/Model/checkRegister.php';
            break;

        default:
            require __DIR__ . '/Front/Pages/signin.html';
            break;
    }
}

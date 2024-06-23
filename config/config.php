<?php

ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

date_default_timezone_set('Asia/Kuala_Lumpur');

$target = 'https://'.$_SERVER['HTTP_HOST'];



session_start();



$env = parse_ini_string(file_get_contents(__DIR__.'/.env'));

$servername = $env['HOST'];

$username = $env['USER'];

$password = $env['PASSWORD'];

$dbname = $env['DB'];



try {

    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {

    echo $e->getMessage();
    session_destroy();

    exit;

}


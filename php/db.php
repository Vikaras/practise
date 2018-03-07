<?php
$server = "localhost";
$user = "root";
$db = "tool";
$password = "";

try {
    $conn = new PDO("mysql:host=$server; dbname=$db", $user, $password);
    $conn -> exec("set names utf8");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
    echo "Connection failed: " . $e->getMessage();
}

?>
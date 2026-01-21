<?php
// db_connect.php

$servername = "localhost";
$username = "root"; // muda se necessário
$password = ""; // muda se necessário
$dbname = "crisnoa";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8mb4", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Ligação estabelecida com sucesso!";
} catch(PDOException $e) {
    die("Ligação falhou: " . $e->getMessage());
}
?>

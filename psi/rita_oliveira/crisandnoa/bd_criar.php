<?php
// create_database.php

$servername = "localhost";
$username = "root"; // muda se necessário
$password = ""; // muda se necessário
$dbname = "crisnoa";

try {
    // Conectar ao MySQL
    $conn = new PDO("mysql:host=$servername", $username, $password);
    // Definir o modo de erro
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Criar a base de dados
    $sql = "CREATE DATABASE IF NOT EXISTS $dbname CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
    $conn->exec($sql);
    //echo "Base de dados criada com sucesso ou já existia.<br>";

    // Usar a base de dados
    $conn->exec("USE $dbname");

    // Criar tabelas

    // categorias
    $conn->exec("CREATE TABLE IF NOT EXISTS categorias (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nome VARCHAR(100) NOT NULL,
        descricao TEXT,
        slug VARCHAR(100) UNIQUE
    ) ENGINE=InnoDB;");

    // cores
    $conn->exec("CREATE TABLE IF NOT EXISTS cores (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nome VARCHAR(50) NOT NULL,
        codigo_hex VARCHAR(7)
    ) ENGINE=InnoDB;");

    // tamanhos
    $conn->exec("CREATE TABLE IF NOT EXISTS tamanhos (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nome VARCHAR(10) NOT NULL
    ) ENGINE=InnoDB;");

    // produtos
    $conn->exec("CREATE TABLE IF NOT EXISTS produtos (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nome VARCHAR(150) NOT NULL,
        descricao TEXT,
        preco DECIMAL(10,2) NOT NULL,
        categoria_id INT,
        imagem VARCHAR(255),
        slug VARCHAR(150) UNIQUE,
        criado_em DATETIME DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (categoria_id) REFERENCES categorias(id) ON DELETE SET NULL
    ) ENGINE=InnoDB;");

    // produto_cores
    $conn->exec("CREATE TABLE IF NOT EXISTS produto_cores (
        produto_id INT,
        cor_id INT,
        PRIMARY KEY (produto_id, cor_id),
        FOREIGN KEY (produto_id) REFERENCES produtos(id) ON DELETE CASCADE,
        FOREIGN KEY (cor_id) REFERENCES cores(id) ON DELETE CASCADE
    ) ENGINE=InnoDB;");

    // produto_tamanhos
    $conn->exec("CREATE TABLE IF NOT EXISTS produto_tamanhos (
        produto_id INT,
        tamanho_id INT,
        PRIMARY KEY (produto_id, tamanho_id),
        FOREIGN KEY (produto_id) REFERENCES produtos(id) ON DELETE CASCADE,
        FOREIGN KEY (tamanho_id) REFERENCES tamanhos(id) ON DELETE CASCADE
    ) ENGINE=InnoDB;");

    //echo "Todas as tabelas foram criadas com sucesso!";

} catch(PDOException $e) {
    echo "Erro: " . $e->getMessage();
}

$conn = null;
?>

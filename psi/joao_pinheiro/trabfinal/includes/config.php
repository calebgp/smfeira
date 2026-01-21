<?php
/**
 * Configurações do Sistema
 * Sistema de Gestão de Produtos e Fornecedores
 */

// URL do site (sem barra no final)
define('SITE_URL', 'http://localhost/PROJETO_CRUD_PHP');

// Configurações do Banco de Dados
define('DB_HOST', 'localhost');        // Host do servidor MySQL
define('DB_NAME', 'gestao_produtos');  // Nome do banco de dados
define('DB_USER', 'root');             // Usuário do banco de dados
define('DB_PASS', '');                 // Senha do banco de dados
define('DB_PORT', 3306);               // Porta do MySQL

// Conexão com o banco de dados
try {
    $pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";port=".DB_PORT, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $pdo->exec("SET NAMES utf8mb4");
} catch (PDOException $e) {
    die("Erro de conexão com o banco de dados: " . $e->getMessage());
}

// Configurações de sessão
define('SESSION_NAME', 'sistema_gestao');
ini_set('session.name', SESSION_NAME);
ini_set('session.cookie_httponly', 1);
ini_set('session.use_strict_mode', 1);


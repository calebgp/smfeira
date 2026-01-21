<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "formulario";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Conexão falhou: " . $conn->connect_error);
}

$nome = $_POST['nome'];
$email = $_POST['email'];
$mensagem = $_POST['mensagem'];

$sql = "INSERT INTO contatos (nome, email, mensagem)
VALUES ('$nome', '$email', '$mensagem')";

if ($conn->query($sql) === TRUE) {
  echo "Dados gravados com sucesso!";
} else {
  echo "Erro: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

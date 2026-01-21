<?php
// Array de citações
$quotes = [
    "O sucesso nasce do querer, da determinação e persistência em se chegar a um objetivo. - Fernando Pessoa",
    "A persistência realiza o impossível. - Provérbio Chinês",
    "O que não provoca minha morte faz com que eu fique mais forte. - Friedrich Nietzsche",
    "No meio da dificuldade encontra-se a oportunidade. - Albert Einstein",
    "Coragem é saber o que não temer. - Platão"
];

// Escolhe uma citação aleatória
$randomQuote = $quotes[array_rand($quotes)];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Citação Aleatória</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
        }
        .container {
            text-align: center;
            background: white;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        h1 {
            font-size: 1.5em;
        }
        button {
            margin-top: 15px;
            padding: 10px 20px;
            font-size: 1em;
            cursor: pointer;
            border: none;
            background-color: #007BFF;
            color: white;
            border-radius: 5px;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<header>
    <h1>CGP Conversor</h1>
</header>
<div class="container">
    <h1>"<?php echo $randomQuote; ?>"</h1>
    <button onclick="window.location.reload();">Nova Citação</button>
</div>
</body>
</html>
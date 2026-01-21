<?php
// #1 Criar o socket
$sock_serv = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

// #2 Associar IP e Porta
socket_bind($sock_serv, "10.24.45.1", 52620);

// #3 Escutar 1 cliente (lista de espera de 1)
socket_listen($sock_serv, 1);
echo "Servidor espera cliente!\n";

// #4 Aceitar conexão
$sock_cliente = socket_accept($sock_serv);

// #5, #6, #7 Ler dados enviados pelo cliente
$op1 = socket_read($sock_cliente, 30);
$op2 = socket_read($sock_cliente, 30);
$oper = socket_read($sock_cliente, 30);

echo "Dados recebidos do cliente:\n";
// #8 Mostrar dados recebidos
echo "$op1\n$op2\n$oper\n";

// #9 Estrutura de decisão (switch)
switch ($oper) { // #10
    case 1: // Soma
        $res = $op1 + $op2; // #11-12
        break; // #13
    case 2: // Subtração
        $res = $op1 - $op2; // #14-15
        break; // #16
    case 3: // Multiplicação
        $res = $op1 * $op2; // #17-18
        break; // #19
    case 4: // Divisão
        $res = $op1 / $op2; // #20-21
        break; // #22
    default: // Erro
        $res = "(Erro: operador inválido!)"; // #23-24
}

// #25 Mostrar e enviar resultado
echo "Resultado enviado para o cliente: ".$res;
socket_write($sock_cliente, $res); // #26
?>

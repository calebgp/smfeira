<?php
// #1 Criar socket
$sock_cliente = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

// #2 Obter erro (inicialmente nenhum)
$erro_num = socket_last_error();

// #3 Se houve erro
if ($erro_num)
    echo "Erro: " . socket_strerror($erro_num); // #4
else {
    // #5 Conectar ao servidor
    socket_connect($sock_cliente, "10.24.45.1", 52620);

    // #6 Atualiza erro
    $erro_num = socket_last_error();

    if ($erro_num)
        echo "Erro: " . socket_strerror($erro_num); // #7
    else { // #8

        echo "Primeiro operando: ";
        $op1 = readline(); // #9
        socket_write($sock_cliente, $op1); // #10-11
        echo "Segundo operando: "; // #12
        $op2 = readline(); // #13
        socket_write($sock_cliente, $op2); // #14

        echo "Operador (1:+ 2:- 3:* 4:/): ";
        $oper = readline(); // #15
        socket_write($sock_cliente, $oper); // #16

        // #17 Ler resposta
        $resp = socket_read($sock_cliente, 30);
        echo "Resultado recebido do servidor: ".$resp; // #18
    }
}
?>

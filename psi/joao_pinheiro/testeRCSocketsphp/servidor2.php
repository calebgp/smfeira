<?php
// #1 Criar o socket
$server = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

// #5 Associar IP/porta
$result = socket_bind($server,  "192.168.1.136", 45600);

// #10 Continuar se não houve erro
if ($result === TRUE) {
    // #11 Escutar até 8 clientes
    socket_listen( $server,  8);

    // #14 Aceitar cliente
    $at_cliente = socket_accept($server);
}
?>

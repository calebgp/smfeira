<?php
// #1 Criar socket
$server = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);

// #5 Associar endereço/porta
$result = socket_bind($server, "0.0.0.0", 100);

// #10 Repetir enquanto verdadeiro
while (1) {
    // #11 Receber dados do cliente
    $bytes_rec = socket_recvfrom($server, $buf, 65536, 0, $from, $port);
    
    // #15 Mostrar mensagem recebida
    echo "\nMensagem recebida: " . $buf . " do cliente " . $from . ":" . $port . "\n"; // #16
}

// #17 Destruir socket
socket_shutdown($server, 2);
socket_close($server);
?>

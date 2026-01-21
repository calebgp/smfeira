<?php
/**
 * Página Inicial do Sistema
 * Sistema de Gestão de Produtos e Fornecedores
 */

require_once __DIR__ . '/includes/config.php';

iniciar_sessao();

if (esta_logado()) {
    redirecionar('/dashboard.php');
} else {
    redirecionar('/auth/login.php');
}

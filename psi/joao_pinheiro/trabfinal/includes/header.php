<!DOCTYPE html>
<html lang="pt-BR" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Sistema de Gestão de Produtos e Fornecedores">
    <title>Sistema de Gestão - <?php echo $titulo_pagina ?? 'Dashboard'; ?></title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo SITE_URL; ?>/css/style.css" rel="stylesheet">
</head>
<body class="bg-light">
    <?php 
    // Obter informações do usuário de forma segura
    $usuario = esta_logado() ? obter_usuario() : null;
    ?>
    <?php if (esta_logado()): ?>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold d-flex align-items-center" href="<?php echo SITE_URL; ?>/dashboard.php">
                <i class="bi bi-box-seam me-2 fs-4"></i>
                <span class="d-none d-sm-inline">Sistema de Gestão</span>
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <i class="bi bi-three-dots-vertical"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) === 'dashboard.php' ? 'active' : ''; ?>" href="<?php echo SITE_URL; ?>/dashboard.php">
                            <i class="bi bi-speedometer2 me-1"></i><span class="d-inline d-lg-none">Dashboard</span><span class="d-none d-lg-inline">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?php echo strpos($_SERVER['PHP_SELF'], 'fornecedores') !== false ? 'active' : ''; ?>" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-people me-1"></i>Fornecedores
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?php echo SITE_URL; ?>/fornecedores/"><i class="bi bi-list me-2"></i>Listar Fornecedores</a></li>
                            <li><a class="dropdown-item" href="<?php echo SITE_URL; ?>/fornecedores/criar.php"><i class="bi bi-plus-circle me-2"></i>Novo Fornecedor</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?php echo strpos($_SERVER['PHP_SELF'], 'produtos') !== false ? 'active' : ''; ?>" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-box me-1"></i>Produtos
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?php echo SITE_URL; ?>/produtos/"><i class="bi bi-list me-2"></i>Listar Produtos</a></li>
                            <li><a class="dropdown-item" href="<?php echo SITE_URL; ?>/produtos/criar.php"><i class="bi bi-plus-circle me-2"></i>Novo Produto</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle me-1 fs-5"></i>
                            <span class="d-none d-md-inline"><?php echo htmlspecialchars($usuario['username'] ?? 'Usuário'); ?></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><h6 class="dropdown-header"><i class="bi bi-person-badge me-2"></i><?php echo htmlspecialchars($usuario['username'] ?? 'Usuário'); ?></h6></li>
                            <li><span class="dropdown-item-text text-muted small"><?php echo htmlspecialchars($usuario['email'] ?? ''); ?></span></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?php echo SITE_URL; ?>/auth/logout.php"><i class="bi bi-box-arrow-right me-2"></i>Sair</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <?php endif; ?>
    
    <!-- Toast Container for Notifications -->
    <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 9999;">
        <?php if (isset($_SESSION['sucesso'])): ?>
        <div class="toast align-items-center border-0 success-toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    <i class="bi bi-check-circle me-2"></i><?php echo $_SESSION['sucesso']; ?>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
        <?php unset($_SESSION['sucesso']); endif; ?>
        
        <?php if (isset($_SESSION['erro'])): ?>
        <div class="toast align-items-center border-0 danger-toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    <i class="bi bi-exclamation-triangle me-2"></i><?php echo $_SESSION['erro']; ?>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
        <?php unset($_SESSION['erro']); endif; ?>
    </div>
    
    <!-- Main Content -->
    <main class="py-4">


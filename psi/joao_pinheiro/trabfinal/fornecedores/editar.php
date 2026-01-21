<?php
/**
 * Editar Fornecedor
 * Sistema de Gestão de Produtos e Fornecedores
 */

require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/functions.php';

// Verificar autenticação
if (!esta_logado()) {
    redirecionar('/auth/login.php');
}

$titulo_pagina = 'Editar Fornecedor';
$erro = '';

// Obter ID do fornecedor
$id = intval($_GET['id'] ?? 0);

if ($id <= 0) {
    $_SESSION['erro'] = 'Fornecedor não encontrado.';
    redirecionar('/fornecedores/');
}

// Obter fornecedor existente
$fornecedor = obter_fornecedor_por_id($id);

if (!$fornecedor) {
    $_SESSION['erro'] = 'Fornecedor não encontrado.';
    redirecionar('/fornecedores/');
}

// Gerar token CSRF
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validar token CSRF
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $erro = 'Erro de validação. Por favor, tente novamente.';
    } else {
        $dados = [
            'nome' => sanitizar($_POST['nome'] ?? ''),
            'contato' => sanitizar($_POST['contato'] ?? ''),
            'email' => sanitizar($_POST['email'] ?? ''),
            'telefone' => sanitizar($_POST['telefone'] ?? ''),
            'endereco' => sanitizar($_POST['endereco'] ?? ''),
            'cidade' => sanitizar($_POST['cidade'] ?? ''),
            'estado' => sanitizar($_POST['estado'] ?? ''),
            'pais' => sanitizar($_POST['pais'] ?? 'Brasil'),
            'observacoes' => sanitizar($_POST['observacoes'] ?? ''),
            'status' => sanitizar($_POST['status'] ?? 'ativo')
        ];
        
        if (empty($dados['nome'])) {
            $erro = 'O nome do fornecedor é obrigatório.';
        } elseif (!empty($dados['email']) && !validar_email($dados['email'])) {
            $erro = 'Por favor, insira um e-mail válido.';
        } else {
            if (atualizar_fornecedor($id, $dados)) {
                $_SESSION['sucesso'] = 'Fornecedor atualizado com sucesso!';
                redirecionar('/fornecedores/');
            } else {
                $erro = 'Erro ao atualizar fornecedor. Por favor, tente novamente.';
            }
        }
        
        // Regenerar token CSRF após submissão
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
}
?>

<?php include_once __DIR__ . '/../includes/header.php'; ?>

<div class="container-fluid px-4">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="h3 mb-0">
                    <i class="bi bi-pencil me-2"></i>Editar Fornecedor
                </h1>
                <p class="text-white-50 mb-0">Atualize as informações do fornecedor</p>
            </div>
            <div class="col-auto">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="<?php echo SITE_URL; ?>/dashboard.php" class="text-white">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo SITE_URL; ?>/fornecedores/" class="text-white">Fornecedores</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Editar</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    
    <?php if (!empty($erro)): ?>
        <div class="alert alert-danger fade-in" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i><?php echo $erro; ?>
        </div>
    <?php endif; ?>
    
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white">
            <h5 class="mb-0"><i class="bi bi-info-circle me-2"></i>Informações do Fornecedor</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="" id="fornecedor-form">
                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                
                <div class="row g-4">
                    <!-- Nome (obrigatório) -->
                    <div class="col-md-6">
                        <label for="nome" class="form-label">
                            <i class="bi bi-building me-1"></i>Nome do Fornecedor *
                        </label>
                        <input type="text" class="form-control" id="nome" name="nome" 
                               placeholder="Digite o nome do fornecedor" required 
                               value="<?php echo htmlspecialchars($fornecedor['nome']); ?>">
                    </div>
                    
                    <!-- Contato -->
                    <div class="col-md-6">
                        <label for="contato" class="form-label">
                            <i class="bi bi-person me-1"></i>Pessoa de Contato
                        </label>
                        <input type="text" class="form-control" id="contato" name="contato" 
                               placeholder="Nome da pessoa de contato"
                               value="<?php echo htmlspecialchars($fornecedor['contato']); ?>">
                    </div>
                    
                    <!-- E-mail -->
                    <div class="col-md-6">
                        <label for="email" class="form-label">
                            <i class="bi bi-envelope me-1"></i>E-mail
                        </label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                            <input type="email" class="form-control" id="email" name="email" 
                                   placeholder="email@fornecedor.com"
                                   value="<?php echo htmlspecialchars($fornecedor['email']); ?>">
                        </div>
                    </div>
                    
                    <!-- Telefone -->
                    <div class="col-md-6">
                        <label for="telefone" class="form-label">
                            <i class="bi bi-phone me-1"></i>Telefone
                        </label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-phone"></i></span>
                            <input type="text" class="form-control" id="telefone" name="telefone" 
                                   placeholder="(00) 00000-0000"
                                   value="<?php echo htmlspecialchars($fornecedor['telefone']); ?>">
                        </div>
                    </div>
                    
                    <!-- Endereço -->
                    <div class="col-12">
                        <label for="endereco" class="form-label">
                            <i class="bi bi-geo-alt me-1"></i>Endereço
                        </label>
                        <input type="text" class="form-control" id="endereco" name="endereco" 
                               placeholder="Rua, número, complemento..."
                               value="<?php echo htmlspecialchars($fornecedor['endereco']); ?>">
                    </div>
                    
                    <!-- Cidade -->
                    <div class="col-md-5">
                        <label for="cidade" class="form-label">
                            <i class="bi bi-pin-map me-1"></i>Cidade
                        </label>
                        <input type="text" class="form-control" id="cidade" name="cidade" 
                               placeholder="Digite a cidade"
                               value="<?php echo htmlspecialchars($fornecedor['cidade']); ?>">
                    </div>
                    
                    <!-- Estado -->
                    <div class="col-md-4">
                        <label for="estado" class="form-label">
                            <i class="bi bi-map me-1"></i>Estado
                        </label>
                        <input type="text" class="form-control" id="estado" name="estado" 
                               placeholder="UF"
                               value="<?php echo htmlspecialchars($fornecedor['estado']); ?>" maxlength="2">
                    </div>
                    
                    <!-- País -->
                    <div class="col-md-3">
                        <label for="pais" class="form-label">
                            <i class="bi bi-globe me-1"></i>País
                        </label>
                        <input type="text" class="form-control" id="pais" name="pais" 
                               value="<?php echo htmlspecialchars($fornecedor['pais']); ?>">
                    </div>
                    
                    <!-- Observações -->
                    <div class="col-12">
                        <label for="observacoes" class="form-label">
                            <i class="bi bi-text-paragraph me-1"></i>Observações
                        </label>
                        <textarea class="form-control" id="observacoes" name="observacoes" rows="4" 
                                  placeholder="Informações adicionais sobre o fornecedor..."><?php echo htmlspecialchars($fornecedor['observacoes']); ?></textarea>
                    </div>
                    
                    <!-- Status -->
                    <div class="col-md-4">
                        <label for="status" class="form-label">
                            <i class="bi bi-circle-fill me-1"></i>Status
                        </label>
                        <select class="form-select" id="status" name="status">
                            <option value="ativo" <?php echo $fornecedor['status'] === 'ativo' ? 'selected' : ''; ?>>Ativo</option>
                            <option value="inativo" <?php echo $fornecedor['status'] === 'inativo' ? 'selected' : ''; ?>>Inativo</option>
                        </select>
                    </div>
                    
                    <!-- Botões -->
                    <div class="col-12 mt-2">
                        <button type="submit" class="btn btn-success me-2">
                            <i class="bi bi-check-lg me-2"></i>Salvar Alterações
                        </button>
                        <a href="<?php echo SITE_URL; ?>/fornecedores/" class="btn btn-secondary">
                            <i class="bi bi-x-lg me-2"></i>Cancelar
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>


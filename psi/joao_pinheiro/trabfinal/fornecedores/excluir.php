<?php
/**
 * Excluir Fornecedor
 * Sistema de Gestão de Produtos e Fornecedores
 */

require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/functions.php';

// Verificar autenticação
if (!esta_logado()) {
    redirecionar('/auth/login.php');
}

$titulo_pagina = 'Excluir Fornecedor';
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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $confirmar = sanitizar($_POST['confirmar'] ?? '');
    
    if ($confirmar !== $fornecedor['nome']) {
        $erro = 'O nome não confere. Por favor, digite o nome do fornecedor para confirmar.';
    } else {
        if (excluir_fornecedor($id)) {
            $_SESSION['sucesso'] = 'Fornecedor excluído com sucesso!';
            redirecionar('/fornecedores/');
        } else {
            $erro = 'Erro ao excluir fornecedor. Por favor, tente novamente.';
        }
    }
}
?>

<?php include_once __DIR__ . '/../includes/header.php'; ?>

<div class="container-fluid px-4">
    <!-- Page Header -->
    <div class="page-header bg-danger">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="h3 mb-0">
                    <i class="bi bi-trash me-2"></i>Excluir Fornecedor
                </h1>
                <p class="text-white-50 mb-0">Esta ação não pode ser desfeita</p>
            </div>
            <div class="col-auto">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="<?php echo SITE_URL; ?>/dashboard.php" class="text-white">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo SITE_URL; ?>/fornecedores/" class="text-white">Fornecedores</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Excluir</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    
    <?php if (!empty($erro)): ?>
        <div class="alert alert-danger fade-in">
            <i class="bi bi-exclamation-triangle me-2"></i><?php echo $erro; ?>
        </div>
    <?php endif; ?>
    
    <div class="card border-danger mb-4">
        <div class="card-header bg-danger text-white">
            <i class="bi bi-exclamation-triangle me-2"></i>Atenção!
        </div>
        <div class="card-body">
            <h5 class="card-title">Você está prestes a excluir o seguinte fornecedor:</h5>
            
            <div class="row g-3 mt-2">
                <div class="col-md-6">
                    <div class="p-3 bg-light rounded">
                        <strong><i class="bi bi-building me-2"></i><?php echo htmlspecialchars($fornecedor['nome']); ?></strong>
                        <?php if ($fornecedor['email']): ?>
                            <br><small class="text-muted"><?php echo htmlspecialchars($fornecedor['email']); ?></small>
                        <?php endif; ?>
                        <br>
                        <span class="badge <?php echo $fornecedor['status'] === 'ativo' ? 'badge-ativo' : 'badge-inativo'; ?>">
                            <?php echo ucfirst($fornecedor['status']); ?>
                        </span>
                    </div>
                </div>
            </div>
            
            <div class="alert alert-warning mt-3">
                <i class="bi bi-info-circle me-2"></i>
                <strong>Os seguintes produtos terão seu fornecedor removido:</strong>
                <?php
                global $pdo;
                $stmt = $pdo->prepare("SELECT nome FROM produtos WHERE fornecedor_id = ?");
                $stmt->execute([$id]);
                $produtos = $stmt->fetchAll();
                
                if (empty($produtos)) {
                    echo '<p class="mb-0 mt-2">Nenhum produto vinculado a este fornecedor.</p>';
                } else {
                    echo '<ul class="mb-0 mt-2">';
                    foreach ($produtos as $produto) {
                        echo '<li>' . htmlspecialchars($produto['nome']) . '</li>';
                    }
                    echo '</ul>';
                }
                ?>
            </div>
            
            <hr class="my-4">
            
            <form method="POST" action="">
                <div class="mb-4">
                    <label for="confirmar" class="form-label">
                        Para confirmar, digite o nome do fornecedor: <strong><?php echo htmlspecialchars($fornecedor['nome']); ?></strong>
                    </label>
                    <input type="text" class="form-control" id="confirmar" name="confirmar" 
                           placeholder="Digite o nome exatamente como aparece acima" required>
                </div>
                
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash me-2"></i>Confirmar Exclusão
                    </button>
                    <a href="<?php echo SITE_URL; ?>/fornecedores/" class="btn btn-secondary">
                        <i class="bi bi-x-lg me-2"></i>Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>


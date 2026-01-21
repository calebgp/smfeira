<?php
/**
 * Listar Fornecedores
 * Sistema de Gestão de Produtos e Fornecedores
 */

require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/functions.php';

// Verificar autenticação
if (!esta_logado()) {
    redirecionar('/auth/login.php');
}

$titulo_pagina = 'Fornecedores';
$usuario = obter_usuario();

// Obter parâmetros de busca e filtro
$busca = sanitizar($_GET['busca'] ?? '');
$status = sanitizar($_GET['status'] ?? 'todos');

// Obter fornecedores
$fornecedores = obter_fornecedores($busca, $status);

// Processar exclusão se necessário
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['excluir'])) {
    $id = intval($_POST['id'] ?? 0);
    if ($id > 0 && excluir_fornecedor($id)) {
        $_SESSION['sucesso'] = 'Fornecedor excluído com sucesso!';
        redirecionar('/fornecedores/');
    } else {
        $_SESSION['erro'] = 'Erro ao excluir fornecedor.';
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
                    <i class="bi bi-people me-2"></i>Fornecedores
                </h1>
                <p class="text-white-50 mb-0">Gerencie seus fornecedores e parceiros</p>
            </div>
            <div class="col-auto">
                <a href="<?php echo SITE_URL; ?>/fornecedores/criar.php" class="btn btn-light">
                    <i class="bi bi-person-plus me-2"></i>Novo Fornecedor
                </a>
            </div>
        </div>
    </div>
    
    <!-- Filters -->
    <div class="card mb-4 border-0 shadow-sm">
        <div class="card-body">
            <form method="GET" action="" class="row g-3">
                <div class="col-lg-5">
                    <label for="busca" class="form-label">
                        <i class="bi bi-search me-1"></i>Buscar
                    </label>
                    <input type="text" class="form-control" id="busca" name="busca" 
                           placeholder="Nome, e-mail ou contato..." value="<?php echo $busca; ?>">
                </div>
                <div class="col-lg-3">
                    <label for="status" class="form-label">
                        <i class="bi bi-circle-fill me-1"></i>Status
                    </label>
                    <select class="form-select" id="status" name="status">
                        <option value="todos" <?php echo $status === 'todos' ? 'selected' : ''; ?>>Todos</option>
                        <option value="ativo" <?php echo $status === 'ativo' ? 'selected' : ''; ?>>Ativo</option>
                        <option value="inativo" <?php echo $status === 'inativo' ? 'selected' : ''; ?>>Inativo</option>
                    </select>
                </div>
                <div class="col-lg-4 d-flex align-items-end gap-2">
                    <button type="submit" class="btn btn-primary flex-grow-1">
                        <i class="bi bi-search me-1"></i>Filtrar
                    </button>
                    <a href="<?php echo SITE_URL; ?>/fornecedores/" class="btn btn-outline-secondary" title="Limpar filtros">
                        <i class="bi bi-arrow-clockwise"></i>
                    </a>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Results -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div class="d-flex align-items-center">
                <i class="bi bi-list me-2 text-success"></i>
                <h5 class="mb-0">Lista de Fornecedores</h5>
            </div>
            <div class="d-flex align-items-center gap-2">
                <span class="badge bg-success-subtle text-success"><?php echo count($fornecedores); ?> fornecedores</span>
                <?php if (!empty($busca) || $status !== 'todos'): ?>
                    <span class="badge bg-warning-subtle text-warning" title="Filtros ativos">
                        <i class="bi bi-funnel-fill"></i>
                    </span>
                <?php endif; ?>
            </div>
        </div>
        <div class="card-body p-0">
            <?php if (empty($fornecedores)): ?>
                <div class="empty-state">
                    <i class="bi bi-inbox text-muted"></i>
                    <h5 class="mt-3 mb-2">Nenhum fornecedor encontrado</h5>
                    <p class="text-muted mb-3">
                        <?php if (!empty($busca) || $status !== 'todos'): ?>
                            Tente ajustar seus filtros de busca
                        <?php else: ?>
                            Comece cadastrando seu primeiro fornecedor
                        <?php endif; ?>
                    </p>
                    <a href="<?php echo SITE_URL; ?>/fornecedores/criar.php" class="btn btn-success">
                        <i class="bi bi-person-plus me-2"></i>Cadastrar Fornecedor
                    </a>
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th class="ps-4">Fornecedor</th>
                                <th>Contato</th>
                                <th>Localização</th>
                                <th>Status</th>
                                <th class="text-end pe-4">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($fornecedores as $fornecedor): ?>
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="bg-success-subtle rounded p-2">
                                                    <i class="bi bi-building text-success"></i>
                                                </div>
                                            </div>
                                            <div>
                                                <strong><?php echo htmlspecialchars($fornecedor['nome']); ?></strong>
                                                <?php if ($fornecedor['email']): ?>
                                                    <br><small class="text-muted"><?php echo htmlspecialchars($fornecedor['email']); ?></small>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <?php if ($fornecedor['contato']): ?>
                                            <div class="d-flex align-items-center">
                                                <i class="bi bi-person text-muted me-2"></i>
                                                <span><?php echo htmlspecialchars($fornecedor['contato']); ?></span>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($fornecedor['telefone']): ?>
                                            <div class="d-flex align-items-center mt-1">
                                                <i class="bi bi-phone text-muted me-2"></i>
                                                <span class="text-muted"><?php echo htmlspecialchars($fornecedor['telefone']); ?></span>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if ($fornecedor['cidade'] || $fornecedor['estado']): ?>
                                            <div class="d-flex align-items-center">
                                                <i class="bi bi-geo-alt text-muted me-2"></i>
                                                <span><?php echo htmlspecialchars($fornecedor['cidade'] . ' - ' . $fornecedor['estado']); ?></span>
                                            </div>
                                            <?php if ($fornecedor['pais'] && $fornecedor['pais'] !== 'Brasil'): ?>
                                                <small class="text-muted"><?php echo htmlspecialchars($fornecedor['pais']); ?></small>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <span class="text-muted">-</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <span class="badge <?php echo $fornecedor['status'] === 'ativo' ? 'bg-success-subtle text-success' : 'bg-secondary-subtle text-secondary'; ?>">
                                            <i class="bi <?php echo $fornecedor['status'] === 'ativo' ? 'bi-check-circle' : 'bi-x-circle'; ?> me-1"></i>
                                            <?php echo ucfirst($fornecedor['status']); ?>
                                        </span>
                                    </td>
                                    <td class="text-end pe-4">
                                        <div class="btn-group btn-group-sm">
                                            <a href="editar.php?id=<?php echo $fornecedor['id']; ?>" class="btn btn-outline-primary" title="Editar">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#excluirModal<?php echo $fornecedor['id']; ?>" title="Excluir">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                        
                                        <!-- Modal de Exclusão -->
                                        <div class="modal fade" id="excluirModal<?php echo $fornecedor['id']; ?>" tabindex="-1" aria-labelledby="excluirModalLabel<?php echo $fornecedor['id']; ?>" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="excluirModalLabel<?php echo $fornecedor['id']; ?>">
                                                            <i class="bi bi-exclamation-triangle text-danger me-2"></i>Confirmar Exclusão
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Tem certeza que deseja excluir o fornecedor <strong><?php echo htmlspecialchars($fornecedor['nome']); ?></strong>?</p>
                                                        <div class="alert alert-warning mb-0">
                                                            <i class="bi bi-info-circle me-2"></i>
                                                            Os produtos vinculados a este fornecedor ficarão sem fornecedor.
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                            <i class="bi bi-x-lg me-1"></i>Cancelar
                                                        </button>
                                                        <form method="POST" class="d-inline">
                                                            <input type="hidden" name="id" value="<?php echo $fornecedor['id']; ?>">
                                                            <input type="hidden" name="excluir" value="1">
                                                            <button type="submit" class="btn btn-danger">
                                                                <i class="bi bi-trash me-1"></i>Confirmar Exclusão
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>


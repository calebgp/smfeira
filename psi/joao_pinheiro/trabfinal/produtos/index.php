<?php
/**
 * Listar Produtos
 * Sistema de Gestão de Produtos e Fornecedores
 */

require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/functions.php';

// Verificar autenticação
if (!esta_logado()) {
    redirecionar('/auth/login.php');
}

$titulo_pagina = 'Produtos';
$usuario = obter_usuario();

// Obter parâmetros de busca e filtro
$busca = sanitizar($_GET['busca'] ?? '');
$fornecedor_id = sanitizar($_GET['fornecedor_id'] ?? 'todos');
$status = sanitizar($_GET['status'] ?? 'todos');

// Obter produtos
$produtos = obter_produtos($busca, $fornecedor_id, $status);

// Obter fornecedores para o filtro
$fornecedores = obter_fornecedores_select();

// Processar exclusão se necessário
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['excluir'])) {
    $id = intval($_POST['id'] ?? 0);
    if ($id > 0 && excluir_produto($id)) {
        $_SESSION['sucesso'] = 'Produto excluído com sucesso!';
        redirecionar('/produtos/');
    } else {
        $_SESSION['erro'] = 'Erro ao excluir produto.';
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
                    <i class="bi bi-box me-2"></i>Produtos
                </h1>
                <p class="text-white-50 mb-0">Gerencie seus produtos e estoque</p>
            </div>
            <div class="col-auto">
                <a href="<?php echo SITE_URL; ?>/produtos/criar.php" class="btn btn-light">
                    <i class="bi bi-plus-circle me-2"></i>Novo Produto
                </a>
            </div>
        </div>
    </div>
    
    <!-- Filters -->
    <div class="card mb-4 border-0 shadow-sm">
        <div class="card-body">
            <form method="GET" action="" class="row g-3">
                <div class="col-lg-4">
                    <label for="busca" class="form-label">
                        <i class="bi bi-search me-1"></i>Buscar
                    </label>
                    <input type="text" class="form-control" id="busca" name="busca" 
                           placeholder="Nome ou descrição..." value="<?php echo $busca; ?>">
                </div>
                <div class="col-lg-3">
                    <label for="fornecedor_id" class="form-label">
                        <i class="bi bi-people me-1"></i>Fornecedor
                    </label>
                    <select class="form-select" id="fornecedor_id" name="fornecedor_id">
                        <option value="todos">Todos os fornecedores</option>
                        <?php foreach ($fornecedores as $f): ?>
                            <option value="<?php echo $f['id']; ?>" <?php echo $fornecedor_id == $f['id'] ? 'selected' : ''; ?>>
                                <?php echo e($f['nome']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-lg-2">
                    <label for="status" class="form-label">
                        <i class="bi bi-circle-fill me-1"></i>Status
                    </label>
                    <select class="form-select" id="status" name="status">
                        <option value="todos" <?php echo $status === 'todos' ? 'selected' : ''; ?>>Todos</option>
                        <option value="ativo" <?php echo $status === 'ativo' ? 'selected' : ''; ?>>Ativo</option>
                        <option value="inativo" <?php echo $status === 'inativo' ? 'selected' : ''; ?>>Inativo</option>
                        <option value="estoque_baixo" <?php echo $status === 'estoque_baixo' ? 'selected' : ''; ?>>Estoque Baixo</option>
                    </select>
                </div>
                <div class="col-lg-3 d-flex align-items-end gap-2">
                    <button type="submit" class="btn btn-primary flex-grow-1">
                        <i class="bi bi-search me-1"></i>Filtrar
                    </button>
                    <a href="<?php echo SITE_URL; ?>/produtos/" class="btn btn-outline-secondary" title="Limpar filtros">
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
                <i class="bi bi-list me-2 text-primary"></i>
                <h5 class="mb-0">Lista de Produtos</h5>
            </div>
            <div class="d-flex align-items-center gap-2">
                <span class="badge bg-primary-subtle text-primary"><?php echo count($produtos); ?> produtos</span>
                <?php if (!empty($busca) || $fornecedor_id !== 'todos' || $status !== 'todos'): ?>
                    <span class="badge bg-warning-subtle text-warning" title="Filtros ativos">
                        <i class="bi bi-funnel-fill"></i>
                    </span>
                <?php endif; ?>
            </div>
        </div>
        <div class="card-body p-0">
            <?php if (empty($produtos)): ?>
                <div class="empty-state">
                    <i class="bi bi-inbox text-muted"></i>
                    <h5 class="mt-3 mb-2">Nenhum produto encontrado</h5>
                    <p class="text-muted mb-3">
                        <?php if (!empty($busca) || $fornecedor_id !== 'todos' || $status !== 'todos'): ?>
                            Tente ajustar seus filtros de busca
                        <?php else: ?>
                            Comece cadastrando seu primeiro produto
                        <?php endif; ?>
                    </p>
                    <a href="<?php echo SITE_URL; ?>/produtos/criar.php" class="btn btn-primary">
                        <i class="bi bi-plus-lg me-2"></i>Cadastrar Produto
                    </a>
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th class="ps-4">Produto</th>
                                <th>Preço</th>
                                <th>Quantidade</th>
                                <th>Fornecedor</th>
                                <th>Status</th>
                                <th class="text-end pe-4">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($produtos as $produto): ?>
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="bg-primary-subtle rounded p-2">
                                                    <i class="bi bi-box text-primary"></i>
                                                </div>
                                            </div>
                                            <div>
                                                <strong><?php echo e($produto['nome']); ?></strong>
                                                <?php if ($produto['categoria']): ?>
                                                    <br><small class="text-muted"><?php echo e($produto['categoria']); ?></small>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-medium"><?php echo formatar_moeda($produto['preco']); ?></span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="<?php echo $produto['quantidade'] <= 10 ? 'text-warning fw-bold' : ''; ?>">
                                                <?php echo number_format($produto['quantidade'], 0, ',', '.'); ?>
                                            </span>
                                            <span class="text-muted ms-1 small"><?php echo e($produto['unidade']); ?></span>
                                            <?php if ($produto['quantidade'] <= 10): ?>
                                                <i class="bi bi-exclamation-triangle text-warning ms-2" title="Estoque baixo"></i>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                    <td>
                                        <?php if ($produto['fornecedor_nome']): ?>
                                            <a href="<?php echo SITE_URL; ?>/fornecedores/editar.php?id=<?php echo $produto['fornecedor_id']; ?>" class="text-decoration-none">
                                                <?php echo e($produto['fornecedor_nome']); ?>
                                            </a>
                                        <?php else: ?>
                                            <span class="text-muted">-</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php
                                        $badge_class = 'bg-success-subtle text-success';
                                        $badge_icon = 'bi-check-circle';
                                        if ($produto['status'] == 'inativo') {
                                            $badge_class = 'bg-secondary-subtle text-secondary';
                                            $badge_icon = 'bi-x-circle';
                                        }
                                        if ($produto['status'] == 'estoque_baixo') {
                                            $badge_class = 'bg-warning-subtle text-warning';
                                            $badge_icon = 'bi-exclamation-triangle';
                                        }
                                        ?>
                                        <span class="badge <?php echo $badge_class; ?>">
                                            <i class="bi <?php echo $badge_icon; ?> me-1"></i>
                                            <?php echo ucfirst(str_replace('_', ' ', $produto['status'])); ?>
                                        </span>
                                    </td>
                                    <td class="text-end pe-4">
                                        <div class="btn-group btn-group-sm">
                                            <a href="editar.php?id=<?php echo $produto['id']; ?>" class="btn btn-outline-primary" title="Editar">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#excluirModal<?php echo $produto['id']; ?>" title="Excluir">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                
                                <!-- Modal de Exclusão -->
                                <div class="modal fade" id="excluirModal<?php echo $produto['id']; ?>" tabindex="-1" aria-labelledby="excluirModalLabel<?php echo $produto['id']; ?>" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="excluirModalLabel<?php echo $produto['id']; ?>">
                                                    <i class="bi bi-exclamation-triangle text-danger me-2"></i>Confirmar Exclusão
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Tem certeza que deseja excluir o produto <strong><?php echo e($produto['nome']); ?></strong>?</p>
                                                <p class="text-muted mb-0">Esta ação não pode ser desfeita.</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    <i class="bi bi-x-lg me-1"></i>Cancelar
                                                </button>
                                                <form method="POST" class="d-inline">
                                                    <input type="hidden" name="id" value="<?php echo $produto['id']; ?>">
                                                    <input type="hidden" name="excluir" value="1">
                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="bi bi-trash me-1"></i>Confirmar Exclusão
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>


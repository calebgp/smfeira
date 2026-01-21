<?php
/**
 * Dashboard - Página Principal
 * Sistema de Gestão de Produtos e Fornecedores
 */

require_once __DIR__ . '/../includes/config.php';

// Verificar autenticação
if (!esta_logado()) {
    redirecionar('/auth/login.php');
}

require_once __DIR__ . '/../includes/functions.php';

$usuario = obter_usuario();
$stats = obter_estatisticas();
$produtos_recentes = obter_produtos();
$produtos_recentes = array_slice($produtos_recentes, 0, 5);
$fornecedores_recentes = obter_fornecedores();
$fornecedores_recentes = array_slice($fornecedores_recentes, 0, 5);

?>

<?php include_once __DIR__ . '/../includes/header.php'; ?>

<div class="container-fluid px-4">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="h3 mb-0">
                    <i class="bi bi-speedometer2 me-2"></i>Dashboard
                </h1>
                <p class="text-white-50 mb-0">Visão geral do sistema</p>
            </div>
            <div class="col-auto">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    
    <!-- Welcome Message -->
    <div class="alert alert-primary fade-in mb-4">
        <i class="bi bi-person-circle me-2"></i>
        <strong>Bem-vindo, <?php echo htmlspecialchars($usuario['username'] ?? 'Usuário'); ?>!</strong> 
        Utilize o menu acima para navegar pelo sistema.
    </div>
    
    <!-- Stats Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-6 col-lg-3">
            <div class="stat-card primary">
                <div class="stat-icon-wrapper">
                    <i class="bi bi-people stat-icon"></i>
                </div>
                <div class="stat-value"><?php echo number_format($stats['total_fornecedores'], 0, ',', '.'); ?></div>
                <div class="stat-label">Fornecedores</div>
            </div>
        </div>
        
        <div class="col-md-6 col-lg-3">
            <div class="stat-card success">
                <div class="stat-icon-wrapper">
                    <i class="bi bi-box stat-icon"></i>
                </div>
                <div class="stat-value"><?php echo number_format($stats['total_produtos'], 0, ',', '.'); ?></div>
                <div class="stat-label">Produtos</div>
            </div>
        </div>
        
        <div class="col-md-6 col-lg-3">
            <div class="stat-card warning">
                <div class="stat-icon-wrapper">
                    <i class="bi bi-exclamation-triangle stat-icon"></i>
                </div>
                <div class="stat-value"><?php echo number_format($stats['estoque_baixo'], 0, ',', '.'); ?></div>
                <div class="stat-label">Estoque Baixo</div>
            </div>
        </div>
        
        <div class="col-md-6 col-lg-3">
            <div class="stat-card info">
                <div class="stat-icon-wrapper">
                    <i class="bi bi-currency-dollar stat-icon"></i>
                </div>
                <div class="stat-value"><?php echo formatar_moeda($stats['valor_estoque']); ?></div>
                <div class="stat-label">Valor do Estoque</div>
            </div>
        </div>
    </div>
    
    <!-- Quick Actions -->
    <div class="row g-4 mb-4">
        <div class="col-lg-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="bi bi-lightning me-2"></i>Ações Rápidas</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="<?php echo SITE_URL; ?>/produtos/criar.php" class="btn btn-primary">
                            <i class="bi bi-plus-circle me-2"></i>Novo Produto
                        </a>
                        <a href="<?php echo SITE_URL; ?>/fornecedores/criar.php" class="btn btn-success">
                            <i class="bi bi-person-plus me-2"></i>Novo Fornecedor
                        </a>
                        <a href="<?php echo SITE_URL; ?>/produtos/" class="btn btn-info text-white">
                            <i class="bi bi-box-seam me-2"></i>Ver Produtos
                        </a>
                        <a href="<?php echo SITE_URL; ?>/fornecedores/" class="btn btn-outline-secondary">
                            <i class="bi bi-people me-2"></i>Ver Fornecedores
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-8">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="bi bi-bar-chart me-2"></i>Produtos por Fornecedor</h5>
                </div>
                <div class="card-body">
                    <?php if (empty($stats['produtos_por_fornecedor'])): ?>
                        <div class="empty-state">
                            <i class="bi bi-inbox display-4"></i>
                            <p class="mt-2 mb-0 text-muted">Nenhum fornecedor com produtos cadastrados.</p>
                        </div>
                    <?php else: ?>
                        <?php foreach ($stats['produtos_por_fornecedor'] as $fornecedor): ?>
                            <div class="mb-3">
                                <div class="d-flex justify-content-between mb-1">
                                    <span><?php echo htmlspecialchars($fornecedor['nome'] ?? 'Sem fornecedor'); ?></span>
                                    <span class="badge bg-primary"><?php echo $fornecedor['total']; ?> produtos</span>
                                </div>
                                <div class="progress" style="height: 8px;">
                                    <div class="progress-bar bg-primary" role="progressbar" 
                                         style="width: <?php echo ($fornecedor['total'] / max($stats['total_produtos'], 1)) * 100; ?>%"
                                         aria-valuenow="<?php echo $fornecedor['total']; ?>" 
                                         aria-valuemax="<?php echo $stats['total_produtos']; ?>"></div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Recent Data -->
    <div class="row g-4">
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="bi bi-clock-history me-2"></i>Produtos Recentes</h5>
                    <a href="<?php echo SITE_URL; ?>/produtos/" class="btn btn-sm btn-outline-primary">
                        Ver todos <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
                <div class="card-body p-0">
                    <?php if (empty($produtos_recentes)): ?>
                        <div class="empty-state">
                            <i class="bi bi-box display-4"></i>
                            <p class="mt-2 mb-0 text-muted">Nenhum produto cadastrado.</p>
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Produto</th>
                                        <th>Preço</th>
                                        <th>Estoque</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($produtos_recentes as $produto): ?>
                                        <tr>
                                            <td>
                                                <strong><?php echo htmlspecialchars($produto['nome']); ?></strong>
                                                <?php if ($produto['fornecedor_nome']): ?>
                                                    <br><small class="text-muted"><?php echo htmlspecialchars($produto['fornecedor_nome']); ?></small>
                                                <?php endif; ?>
                                            </td>
                                            <td><?php echo formatar_moeda($produto['preco']); ?></td>
                                            <td>
                                                <span class="<?php echo $produto['quantidade'] <= 10 ? 'text-warning fw-bold' : ''; ?>">
                                                    <?php echo $produto['quantidade']; ?>
                                                </span>
                                            </td>
                                            <td>
                                                <?php
                                                $badge_class = 'bg-success';
                                                if ($produto['status'] == 'inativo') $badge_class = 'bg-secondary';
                                                if ($produto['status'] == 'estoque_baixo') $badge_class = 'bg-warning text-dark';
                                                ?>
                                                <span class="badge <?php echo $badge_class; ?>">
                                                    <?php echo ucfirst(str_replace('_', ' ', $produto['status'])); ?>
                                                </span>
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
        
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="bi bi-people me-2"></i>Fornecedores Recentes</h5>
                    <a href="<?php echo SITE_URL; ?>/fornecedores/" class="btn btn-sm btn-outline-primary">
                        Ver todos <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
                <div class="card-body p-0">
                    <?php if (empty($fornecedores_recentes)): ?>
                        <div class="empty-state">
                            <i class="bi bi-people display-4"></i>
                            <p class="mt-2 mb-0 text-muted">Nenhum fornecedor cadastrado.</p>
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Contato</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($fornecedores_recentes as $fornecedor): ?>
                                        <tr>
                                            <td>
                                                <strong><?php echo htmlspecialchars($fornecedor['nome']); ?></strong>
                                                <?php if ($fornecedor['cidade']): ?>
                                                    <br><small class="text-muted"><?php echo htmlspecialchars($fornecedor['cidade']); ?> - <?php echo htmlspecialchars($fornecedor['estado']); ?></small>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if ($fornecedor['email']): ?>
                                                    <a href="mailto:<?php echo htmlspecialchars($fornecedor['email']); ?>" class="text-decoration-none">
                                                        <?php echo htmlspecialchars($fornecedor['email']); ?>
                                                    </a>
                                                <?php else: ?>
                                                    <span class="text-muted">-</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <span class="badge <?php echo $fornecedor['status'] == 'ativo' ? 'bg-success' : 'bg-secondary'; ?>">
                                                    <?php echo ucfirst($fornecedor['status']); ?>
                                                </span>
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
    </div>
</div>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>

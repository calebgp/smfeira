<?php
/**
 * Criar Novo Produto
 * Sistema de Gestão de Produtos e Fornecedores
 */

require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/functions.php';

// Verificar autenticação
if (!esta_logado()) {
    redirecionar('/auth/login.php');
}

$titulo_pagina = 'Novo Produto';
$erro = '';

// Gerar token CSRF apenas se não existir
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validar token CSRF
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $erro = 'Erro de validação. Por favor, tente novamente.';
    } else {
        $preco_str = $_POST['preco'] ?? '0';
        $preco_str = str_replace(['.', ','], ['', '.'], $preco_str);
        
        $dados = [
            'nome' => sanitizar($_POST['nome'] ?? ''),
            'categoria' => sanitizar($_POST['categoria'] ?? ''),
            'descricao' => sanitizar($_POST['descricao'] ?? ''),
            'preco' => floatval($preco_str),
            'quantidade' => intval($_POST['quantidade'] ?? 0),
            'unidade' => sanitizar($_POST['unidade'] ?? 'un'),
            'fornecedor_id' => !empty($_POST['fornecedor_id']) ? intval($_POST['fornecedor_id']) : null,
            'status' => sanitizar($_POST['status'] ?? 'ativo')
        ];
        
        if (empty($dados['nome'])) {
            $erro = 'O nome do produto é obrigatório.';
        } elseif ($dados['preco'] < 0) {
            $erro = 'O preço não pode ser negativo.';
        } elseif ($dados['quantidade'] < 0) {
            $erro = 'A quantidade não pode ser negativa.';
        } else {
            $id = criar_produto($dados);
            if ($id > 0) {
                $_SESSION['sucesso'] = 'Produto criado com sucesso!';
                redirecionar('/produtos/');
            } else {
                $erro = 'Erro ao criar produto. Por favor, tente novamente.';
            }
        }
    }
}

// Obter fornecedores para o select
$fornecedores = obter_fornecedores_select();
?>

<?php include_once __DIR__ . '/../includes/header.php'; ?>

<div class="container-fluid px-4">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="h3 mb-0">
                    <i class="bi bi-plus-circle me-2"></i>Novo Produto
                </h1>
                <p class="text-white-50 mb-0">Adicione um novo produto ao sistema</p>
            </div>
            <div class="col-auto">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="<?php echo SITE_URL; ?>/dashboard.php" class="text-white">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo SITE_URL; ?>/produtos/" class="text-white">Produtos</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Novo</li>
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
            <h5 class="mb-0"><i class="bi bi-box me-2"></i>Informações do Produto</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="" id="produto-form">
                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                
                <div class="row g-4">
                    <!-- Nome (obrigatório) -->
                    <div class="col-md-6">
                        <label for="nome" class="form-label">
                            <i class="bi bi-tag me-1"></i>Nome do Produto *
                        </label>
                        <input type="text" class="form-control" id="nome" name="nome" 
                               placeholder="Digite o nome do produto" required 
                               value="<?php echo e($dados['nome'] ?? ''); ?>">
                    </div>
                    
                    <!-- Categoria -->
                    <div class="col-md-3">
                        <label for="categoria" class="form-label">
                            <i class="bi bi-collection me-1"></i>Categoria
                        </label>
                        <input type="text" class="form-control" id="categoria" name="categoria" 
                               placeholder="Ex: Eletrônicos"
                               value="<?php echo e($dados['categoria'] ?? ''); ?>">
                    </div>
                    
                    <!-- Fornecedor -->
                    <div class="col-md-3">
                        <label for="fornecedor_id" class="form-label">
                            <i class="bi bi-building me-1"></i>Fornecedor
                        </label>
                        <select class="form-select" id="fornecedor_id" name="fornecedor_id">
                            <option value="">Nenhum</option>
                            <?php foreach ($fornecedores as $f): ?>
                                <option value="<?php echo $f['id']; ?>" <?php echo ($dados['fornecedor_id'] ?? '') == $f['id'] ? 'selected' : ''; ?>>
                                    <?php echo e($f['nome']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <!-- Preço (obrigatório) -->
                    <div class="col-md-4">
                        <label for="preco" class="form-label">
                            <i class="bi bi-currency-dollar me-1"></i>Preço (R$) *
                        </label>
                        <div class="input-group">
                            <span class="input-group-text">R$</span>
                            <input type="text" class="form-control" id="preco" name="preco" 
                                   placeholder="0,00" required
                                   value="<?php echo isset($dados['preco']) ? number_format($dados['preco'], 2, ',', '') : '0,00'; ?>">
                        </div>
                    </div>
                    
                    <!-- Quantidade (obrigatório) -->
                    <div class="col-md-4">
                        <label for="quantidade" class="form-label">
                            <i class="bi bi-hash me-1"></i>Quantidade *
                        </label>
                        <input type="number" class="form-control" id="quantidade" name="quantidade" 
                               placeholder="0" required min="0"
                               value="<?php echo $dados['quantidade'] ?? 0; ?>">
                        <div class="form-text">
                            <i class="bi bi-info-circle me-1"></i>Se quantidade ≤ 10, status será "Estoque Baixo"
                        </div>
                    </div>
                    
                    <!-- Unidade -->
                    <div class="col-md-4">
                        <label for="unidade" class="form-label">
                            <i class="bi bi-box me-1"></i>Unidade
                        </label>
                        <select class="form-select" id="unidade" name="unidade">
                            <option value="un" <?php echo ($dados['unidade'] ?? '') === 'un' ? 'selected' : ''; ?>>Unidade (un)</option>
                            <option value="kg" <?php echo ($dados['unidade'] ?? '') === 'kg' ? 'selected' : ''; ?>>Quilograma (kg)</option>
                            <option value="g" <?php echo ($dados['unidade'] ?? '') === 'g' ? 'selected' : ''; ?>>Grama (g)</option>
                            <option value="l" <?php echo ($dados['unidade'] ?? '') === 'l' ? 'selected' : ''; ?>>Litro (l)</option>
                            <option value="ml" <?php echo ($dados['unidade'] ?? '') === 'ml' ? 'selected' : ''; ?>>Mililitro (ml)</option>
                            <option value="cx" <?php echo ($dados['unidade'] ?? '') === 'cx' ? 'selected' : ''; ?>>Caixa (cx)</option>
                            <option value="pc" <?php echo ($dados['unidade'] ?? '') === 'pc' ? 'selected' : ''; ?>>Peça (pc)</option>
                            <option value="mt" <?php echo ($dados['unidade'] ?? '') === 'mt' ? 'selected' : ''; ?>>Metro (mt)</option>
                            <option value="pct" <?php echo ($dados['unidade'] ?? '') === 'pct' ? 'selected' : ''; ?>>Pacote (pct)</option>
                        </select>
                    </div>
                    
                    <!-- Descrição -->
                    <div class="col-12">
                        <label for="descricao" class="form-label">
                            <i class="bi bi-text-paragraph me-1"></i>Descrição
                        </label>
                        <textarea class="form-control" id="descricao" name="descricao" rows="4" 
                                  placeholder="Descrição detalhada do produto..."><?php echo e($dados['descricao'] ?? ''); ?></textarea>
                    </div>
                    
                    <!-- Status -->
                    <div class="col-md-4">
                        <label for="status" class="form-label">
                            <i class="bi bi-circle-fill me-1"></i>Status
                        </label>
                        <select class="form-select" id="status" name="status">
                            <option value="ativo" <?php echo ($dados['status'] ?? '') === 'ativo' ? 'selected' : ''; ?>>Ativo</option>
                            <option value="inativo" <?php echo ($dados['status'] ?? '') === 'inativo' ? 'selected' : ''; ?>>Inativo</option>
                        </select>
                    </div>
                    
                    <!-- Botões -->
                    <div class="col-12 mt-2">
                        <button type="submit" class="btn btn-primary me-2">
                            <i class="bi bi-check-lg me-2"></i>Salvar Produto
                        </button>
                        <a href="<?php echo SITE_URL; ?>/produtos/" class="btn btn-secondary">
                            <i class="bi bi-x-lg me-2"></i>Cancelar
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>


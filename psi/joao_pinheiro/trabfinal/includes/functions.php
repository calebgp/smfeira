<?php
/**
 * Funções do Sistema
 * Sistema de Gestão de Produtos e Fornecedores
 */

require_once __DIR__ . '/config.php';

/**
 * Iniciar sessão de forma segura
 */
function iniciar_sessao() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
}

/**
 * Verificar se usuário está logado
 */
function esta_logado() {
    iniciar_sessao();
    return isset($_SESSION['usuario_id']);
}

/**
 * Redirecionar para uma página
 */
function redirecionar($url) {
    header("Location: " . SITE_URL . $url);
    exit;
}

/**
 * Obter usuário logado
 */
function obter_usuario() {
    if (!esta_logado()) {
        return null;
    }
    
    global $pdo;
    $stmt = $pdo->prepare("SELECT id, username, email, created_at FROM usuarios WHERE id = ?");
    $stmt->execute([$_SESSION['usuario_id']]);
    return $stmt->fetch();
}

/**
 * Gerar token CSRF
 */
function gerar_csrf_token() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/**
 * Validar token CSRF
 */
function validar_csrf_token($token) {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (empty($_SESSION['csrf_token']) || empty($token)) {
        return false;
    }
    return hash_equals($_SESSION['csrf_token'], $token);
}

/**
 * Regenerar token CSRF
 */
function regenerar_csrf_token() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    return $_SESSION['csrf_token'];
}

/**
 * Obter todos os fornecedores
 */
function obter_fornecedores($busca = '', $status = '') {
    global $pdo;
    
    $sql = "SELECT * FROM fornecedores WHERE 1=1";
    $params = [];
    
    if (!empty($busca)) {
        $sql .= " AND (nome LIKE ? OR email LIKE ? OR contato LIKE ?)";
        $params[] = "%$busca%";
        $params[] = "%$busca%";
        $params[] = "%$busca%";
    }
    
    if (!empty($status) && $status !== 'todos') {
        $sql .= " AND status = ?";
        $params[] = $status;
    }
    
    $sql .= " ORDER BY nome ASC";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll();
}

/**
 * Obter fornecedor por ID
 */
function obter_fornecedor_por_id($id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM fornecedores WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch();
}

/**
 * Criar novo fornecedor
 */
function criar_fornecedor($dados) {
    global $pdo;
    
    $sql = "INSERT INTO fornecedores (nome, contato, email, telefone, endereco, cidade, estado, pais, observacoes, status) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $dados['nome'],
        $dados['contato'] ?? '',
        $dados['email'] ?? '',
        $dados['telefone'] ?? '',
        $dados['endereco'] ?? '',
        $dados['cidade'] ?? '',
        $dados['estado'] ?? '',
        $dados['pais'] ?? '',
        $dados['observacoes'] ?? '',
        $dados['status'] ?? 'ativo'
    ]);
    
    return $pdo->lastInsertId();
}

/**
 * Atualizar fornecedor
 */
function atualizar_fornecedor($id, $dados) {
    
    global $pdo;
    
    $sql = "UPDATE fornecedores SET 
            nome = ?, contato = ?, email = ?, telefone = ?, endereco = ?, 
            cidade = ?, estado = ?, pais = ?, observacoes = ?, status = ?
            WHERE id = ?";
    error_log("Tentando atualizar fornecedor no banco de dados com ID: $id, sql: $sql");
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $dados['nome'],
        $dados['contato'] ?? '',
        $dados['email'] ?? '',
        $dados['telefone'] ?? '',
        $dados['endereco'] ?? '',
        $dados['cidade'] ?? '',
        $dados['estado'] ?? '',
        $dados['pais'] ?? '',
        $dados['observacoes'] ?? '',
        $dados['status'] ?? 'ativo',
        $id
    ]);
    
    return $stmt->rowCount() > 0;
}

/**
 * Excluir fornecedor
 */
function excluir_fornecedor($id) {
    global $pdo;
    
    // Atualizar produtos para não ter fornecedor
    $stmt = $pdo->prepare("UPDATE produtos SET fornecedor_id = NULL WHERE fornecedor_id = ?");
    $stmt->execute([$id]);
    
    // Excluir fornecedor
    $stmt = $pdo->prepare("DELETE FROM fornecedores WHERE id = ?");
    $stmt->execute([$id]);
    
    return $stmt->rowCount() > 0;
}

/**
 * Obter todos os produtos
 */
function obter_produtos($busca = '', $fornecedor_id = '', $status = '') {
    global $pdo;
    
    $sql = "SELECT p.*, f.nome as fornecedor_nome 
            FROM produtos p 
            LEFT JOIN fornecedores f ON p.fornecedor_id = f.id 
            WHERE 1=1";
    $params = [];
    
    if (!empty($busca)) {
        $sql .= " AND (p.nome LIKE ? OR p.descricao LIKE ?)";
        $params[] = "%$busca%";
        $params[] = "%$busca%";
    }
    
    if (!empty($fornecedor_id) && $fornecedor_id !== 'todos') {
        $sql .= " AND p.fornecedor_id = ?";
        $params[] = $fornecedor_id;
    }
    
    if (!empty($status) && $status !== 'todos') {
        $sql .= " AND p.status = ?";
        $params[] = $status;
    }
    
    $sql .= " ORDER BY p.nome ASC";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll();
}

/**
 * Obter produto por ID
 */
function obter_produto_por_id($id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT p.*, f.nome as fornecedor_nome FROM produtos p LEFT JOIN fornecedores f ON p.fornecedor_id = f.id WHERE p.id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch();
}

/**
 * Criar novo produto
 */
function criar_produto($dados) {
    global $pdo;
    
    // Determinar status automaticamente
    $quantidade = intval($dados['quantidade'] ?? 0);
    $status = $quantidade <= 10 ? 'estoque_baixo' : ($dados['status'] ?? 'ativo');
    
    $sql = "INSERT INTO produtos (nome, categoria, descricao, preco, quantidade, unidade, fornecedor_id, status) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $dados['nome'],
        $dados['categoria'] ?? '',
        $dados['descricao'] ?? '',
        $dados['preco'] ?? 0,
        $quantidade,
        $dados['unidade'] ?? 'un',
        $dados['fornecedor_id'] ?? null,
        $status
    ]);
    
    return $pdo->lastInsertId();
}

/**
 * Atualizar produto
 */
function atualizar_produto($id, $dados) {
    global $pdo;
    
    // Determinar status automaticamente
    $quantidade = intval($dados['quantidade'] ?? 0);
    $status = $quantidade <= 10 ? 'estoque_baixo' : ($dados['status'] ?? 'ativo');
    
    $sql = "UPDATE produtos SET 
            nome = ?, categoria = ?, descricao = ?, preco = ?, quantidade = ?, 
            unidade = ?, fornecedor_id = ?, status = ?
            WHERE id = ?";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $dados['nome'],
        $dados['categoria'] ?? '',
        $dados['descricao'] ?? '',
        $dados['preco'] ?? 0,
        $quantidade,
        $dados['unidade'] ?? 'un',
        $dados['fornecedor_id'] ?? null,
        $status,
        $id
    ]);
    
    return $stmt->rowCount() > 0;
}

/**
 * Excluir produto
 */
function excluir_produto($id) {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM produtos WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->rowCount() > 0;
}

/**
 * Obter estatísticas para dashboard
 */
function obter_estatisticas() {
    global $pdo;
    
    $stats = [
        'total_fornecedores' => 0,
        'total_produtos' => 0,
        'estoque_baixo' => 0,
        'valor_estoque' => 0,
        'produtos_por_fornecedor' => []
    ];
    
    // Total de fornecedores
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM fornecedores WHERE status = 'ativo'");
    $stats['total_fornecedores'] = $stmt->fetch()['total'];
    
    // Total de produtos
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM produtos WHERE status != 'inativo'");
    $stats['total_produtos'] = $stmt->fetch()['total'];
    
    // Produtos com estoque baixo
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM produtos WHERE quantidade <= 10 AND status != 'inativo'");
    $stats['estoque_baixo'] = $stmt->fetch()['total'];
    
    // Valor total do estoque
    $stmt = $pdo->query("SELECT SUM(preco * quantidade) as total FROM produtos WHERE status != 'inativo'");
    $stats['valor_estoque'] = $stmt->fetch()['total'] ?? 0;
    
    // Produtos por fornecedor
    $stmt = $pdo->query("SELECT f.nome, COUNT(p.id) as total FROM fornecedores f LEFT JOIN produtos p ON f.id = p.fornecedor_id AND p.status != 'inativo' WHERE f.status = 'ativo' GROUP BY f.id ORDER BY total DESC");
    $stats['produtos_por_fornecedor'] = $stmt->fetchAll();
    
    return $stats;
}

/**
 * Formatar valor monetário
 */
function formatar_moeda($valor) {
    return 'R$ ' . number_format($valor, 2, ',', '.');
}

/**
 * Sanitizar entrada
 */
function sanitizar($dado) {
    return htmlspecialchars(trim($dado ?? ''), ENT_QUOTES, 'UTF-8');
}

/**
 * Escape para HTML (trata null)
 */
function e($dado) {
    return htmlspecialchars($dado ?? '', ENT_QUOTES, 'UTF-8');
}

/**
 * Validar e-mail
 */
function validar_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

/**
 * Mostrar mensagem de alerta
 */
function mostrar_alerta($tipo, $mensagem) {
    echo "<div class='alert alert-$tipo alert-dismissible fade show' role='alert'>
            $mensagem
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
}

/**
 * Obter lista de fornecedores para select
 */
function obter_fornecedores_select() {
    global $pdo;
    $stmt = $pdo->query("SELECT id, nome FROM fornecedores WHERE status = 'ativo' ORDER BY nome ASC");
    return $stmt->fetchAll();
}


<?php
/**
 * Login - Sistema de Autenticação
 * Sistema de Gestão de Produtos e Fornecedores
 */

require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/functions.php';

iniciar_sessao();

// Se já estiver logado, redirecionar para dashboard
if (esta_logado()) {
    redirecionar('/dashboard.php');
}

$titulo_pagina = 'Login';
$erro = '';
$username = '';

// Gerar token CSRF apenas se não existir
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validar token CSRF
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $erro = 'Erro de validação. Por favor, tente novamente.';
    } else {
        $username = sanitizar($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';
        
        if (empty($username) || empty($password)) {
            $erro = 'Por favor, preencha todos os campos.';
        } else {
            // Buscar usuário no banco de dados
            $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE username = ?");
            $stmt->execute([$username]);
            $usuario = $stmt->fetch();
            
            if ($usuario && password_verify($password, $usuario['password'])) {
                // Login bem-sucedido
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['username'] = $usuario['username'];
                $_SESSION['email'] = $usuario['email'];
                $_SESSION['login_at'] = time();
                
                // Regenerar ID da sessão por segurança
                session_regenerate_id(true);
                
                redirecionar('/dashboard.php');
            } else {
                $erro = 'Usuário ou senha incorretos.';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Login - Sistema de Gestão de Produtos e Fornecedores">
    <title>Login - Sistema de Gestão</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo SITE_URL; ?>/css/style.css" rel="stylesheet">
    <style>
        .auth-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 50%, #ec4899 100%);
            padding: 1rem;
            position: relative;
            overflow: hidden;
        }
        
        .auth-container::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: pulse 15s ease-in-out infinite;
        }
        
        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 0.5; }
            50% { transform: scale(1.1); opacity: 0.3; }
        }
        
        .auth-card {
            background: white;
            border-radius: 1rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            width: 100%;
            max-width: 450px;
            position: relative;
            z-index: 1;
            overflow: hidden;
        }
        
        .auth-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(90deg, #4f46e5, #7c3aed, #ec4899);
        }
        
        .auth-card .card-header {
            background: transparent;
            color: #1e293b;
            text-align: center;
            padding: 2.5rem 2rem 1.5rem;
            border-bottom: none;
        }
        
        .auth-card .card-header i {
            font-size: 4rem;
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
            display: block;
        }
        
        .auth-card .card-header h3 {
            margin: 0;
            font-weight: 700;
            font-size: 1.5rem;
            color: #1e293b;
        }
        
        .auth-card .card-header p {
            color: #64748b;
            margin-top: 0.5rem;
            font-size: 0.95rem;
        }
        
        .auth-card .card-body {
            padding: 1.5rem 2rem 2rem;
        }
        
        .form-control, .form-select {
            border-radius: 0.5rem;
            border: 1px solid #e2e8f0;
            padding: 0.75rem 1rem;
            font-size: 0.95rem;
            transition: all 0.2s ease;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: #4f46e5;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }
        
        .input-group-text {
            border-radius: 0.5rem 0 0 0.5rem;
            border: 1px solid #e2e8f0;
            border-right: none;
            background: #f8fafc;
            color: #64748b;
        }
        
        .form-control.has-prefix {
            border-radius: 0 0.5rem 0.5rem 0;
            border-left: none;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            border: none;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(79, 70, 229, 0.3);
        }
        
        .btn-outline-primary {
            border-color: #4f46e5;
            color: #4f46e5;
            font-weight: 500;
            border-radius: 0.5rem;
        }
        
        .btn-outline-primary:hover {
            background: #4f46e5;
            border-color: #4f46e5;
        }
        
        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 1.5rem 0;
        }
        
        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .divider span {
            padding: 0 1rem;
            color: #64748b;
            font-size: 0.875rem;
        }
        
        .demo-credentials {
            background: #f8fafc;
            border-radius: 0.5rem;
            padding: 1rem;
            margin-bottom: 1.5rem;
            border: 1px dashed #cbd5e1;
        }
        
        .demo-credentials small {
            color: #64748b;
        }
        
        .demo-credentials code {
            background: #e2e8f0;
            padding: 0.15rem 0.4rem;
            border-radius: 0.25rem;
            font-size: 0.85rem;
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="auth-card">
            <div class="card-header">
                <i class="bi bi-box-seam"></i>
                <h3>Sistema de Gestão</h3>
                <p class="mb-0">Faça login para continuar</p>
            </div>
            <div class="card-body">
                <?php if (!empty($erro)): ?>
                    <div class="alert alert-danger fade-in" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i><?php echo $erro; ?>
                    </div>
                <?php endif; ?>
                
                <form method="POST" action="" id="login-form">
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                    
                    <div class="mb-3">
                        <label for="username" class="form-label">Usuário</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-person"></i></span>
                            <input type="text" class="form-control" id="username" name="username" 
                                   placeholder="Digite seu usuário" required 
                                   value="<?php echo e($username); ?>" autocomplete="username">
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label for="password" class="form-label">Senha</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-lock"></i></span>
                            <input type="password" class="form-control" id="password" name="password" 
                                   placeholder="Digite sua senha" required autocomplete="current-password">
                        </div>
                    </div>
                    
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="bi bi-box-arrow-in-right me-2"></i>Entrar
                        </button>
                    </div>
                </form>
                
                <div class="divider">
                    <span>ou</span>
                </div>
                
                <div class="demo-credentials">
                    <small class="d-block mb-2"><i class="bi bi-info-circle me-1"></i>Credenciais de demonstração:</small>
                    <small>Usuário: <code>admin</code></small><br>
                    <small>Senha: <code>admin123</code></small>
                </div>
                
                <div class="text-center">
                    <p class="mb-2 text-muted">Não tem uma conta?</p>
                    <a href="<?php echo SITE_URL; ?>/auth/register.php" class="btn btn-outline-primary">
                        <i class="bi bi-person-plus me-2"></i>Cadastre-se
                    </a>
                </div>
                
                <div class="text-center mt-4">
                    <a href="<?php echo SITE_URL; ?>/index.php" class="text-muted text-decoration-none">
                        <i class="bi bi-arrow-left me-1"></i>Voltar para a página inicial
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


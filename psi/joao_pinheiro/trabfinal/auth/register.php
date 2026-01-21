<?php
/**
 * Registro de Novos Usuários
 * Sistema de Gestão de Produtos e Fornecedores
 */

require_once __DIR__ . '/../includes/config.php';

iniciar_sessao();

// Se já estiver logado, redirecionar para dashboard
if (esta_logado()) {
    redirecionar('/dashboard.php');
}

$titulo_pagina = 'Cadastre-se';
$erro = '';
$sucesso = '';

// Gerar token CSRF
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validar token CSRF
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $erro = 'Erro de validação. Por favor, tente novamente.';
    } else {
        $username = sanitizar($_POST['username'] ?? '');
        $email = sanitizar($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $confirmar_password = $_POST['confirmar_password'] ?? '';
        
        // Validações
        if (empty($username) || empty($email) || empty($password) || empty($confirmar_password)) {
            $erro = 'Por favor, preencha todos os campos.';
        } elseif (strlen($username) < 3) {
            $erro = 'O nome de usuário deve ter pelo menos 3 caracteres.';
        } elseif (!validar_email($email)) {
            $erro = 'Por favor, insira um e-mail válido.';
        } elseif (strlen($password) < 6) {
            $erro = 'A senha deve ter pelo menos 6 caracteres.';
        } elseif ($password !== $confirmar_password) {
            $erro = 'As senhas não coincidem.';
        } else {
            // Verificar se usuário já existe
            $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE username = ? OR email = ?");
            $stmt->execute([$username, $email]);
            
            if ($stmt->fetch()) {
                $erro = 'Nome de usuário ou e-mail já está em uso.';
            } else {
                // Criar novo usuário
                $password_hash = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $pdo->prepare("INSERT INTO usuarios (username, email, password) VALUES (?, ?, ?)");
                $stmt->execute([$username, $email, $password_hash]);
                
                $sucesso = 'Conta criada com sucesso! Agora você pode fazer login.';
                
                // Regenerar token após sucesso
                $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
            }
        }
        
        // Regenerar token CSRF após submissão
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Cadastre-se - Sistema de Gestão de Produtos e Fornecedores">
    <title>Cadastre-se - Sistema de Gestão</title>
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
            background: linear-gradient(135deg, #10b981 0%, #059669 50%, #047857 100%);
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
            max-width: 500px;
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
            background: linear-gradient(90deg, #10b981, #059669, #047857);
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
            background: linear-gradient(135deg, #10b981, #059669);
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
            border-color: #10b981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
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
        
        .btn-success {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            border: none;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
        }
        
        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(16, 185, 129, 0.3);
        }
        
        .btn-outline-primary {
            border-color: #10b981;
            color: #10b981;
            font-weight: 500;
            border-radius: 0.5rem;
        }
        
        .btn-outline-primary:hover {
            background: #10b981;
            border-color: #10b981;
            color: white;
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
        
        .password-strength {
            height: 4px;
            border-radius: 2px;
            margin-top: 0.5rem;
            transition: all 0.3s ease;
        }
        
        .password-strength.weak {
            background: #ef4444;
            width: 33%;
        }
        
        .password-strength.medium {
            background: #f59e0b;
            width: 66%;
        }
        
        .password-strength.strong {
            background: #10b981;
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="auth-card">
            <div class="card-header">
                <i class="bi bi-person-plus"></i>
                <h3>Criar Conta</h3>
                <p class="mb-0">Sistema de Gestão de Produtos</p>
            </div>
            <div class="card-body">
                <?php if (!empty($erro)): ?>
                    <div class="alert alert-danger fade-in" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i><?php echo $erro; ?>
                    </div>
                <?php endif; ?>
                
                <?php if (!empty($sucesso)): ?>
                    <div class="alert alert-success fade-in" role="alert">
                        <div class="d-flex align-items-center mb-3">
                            <i class="bi bi-check-circle-fill fs-4 me-2"></i>
                            <div>
                                <strong>Conta criada com sucesso!</strong>
                                <p class="mb-0 small"><?php echo $sucesso; ?></p>
                            </div>
                        </div>
                        <a href="<?php echo SITE_URL; ?>/auth/login.php" class="btn btn-success">
                            <i class="bi bi-box-arrow-in-right me-2"></i>Ir para Login
                        </a>
                    </div>
                <?php else: ?>
                    <form method="POST" action="" id="register-form">
                        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                        
                        <div class="mb-3">
                            <label for="username" class="form-label">
                                <i class="bi bi-person me-1"></i>Nome de Usuário
                            </label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-person"></i></span>
                                <input type="text" class="form-control" id="username" name="username" 
                                       placeholder="Escolha um nome de usuário" required 
                                       value="<?php echo htmlspecialchars($username ?? ''); ?>" autocomplete="username">
                            </div>
                            <div class="form-text">Mínimo de 3 caracteres</div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">
                                <i class="bi bi-envelope me-1"></i>E-mail
                            </label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                <input type="email" class="form-control" id="email" name="email" 
                                       placeholder="Seu melhor e-mail" required 
                                       value="<?php echo htmlspecialchars($email ?? ''); ?>" autocomplete="email">
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="password" class="form-label">
                                <i class="bi bi-lock me-1"></i>Senha
                            </label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                <input type="password" class="form-control" id="password" name="password" 
                                       placeholder="Crie uma senha" required autocomplete="new-password"
                                       oninput="checkPasswordStrength(this.value)">
                            </div>
                            <div class="password-strength" id="password-strength"></div>
                            <div class="form-text">Mínimo de 6 caracteres</div>
                        </div>
                        
                        <div class="mb-4">
                            <label for="confirmar_password" class="form-label">
                                <i class="bi bi-lock-fill me-1"></i>Confirmar Senha
                            </label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                                <input type="password" class="form-control" id="confirmar_password" name="confirmar_password" 
                                       placeholder="Confirme sua senha" required autocomplete="new-password">
                            </div>
                        </div>
                        
                        <div class="d-grid">
                            <button type="submit" class="btn btn-success btn-lg">
                                <i class="bi bi-check-lg me-2"></i>Cadastrar
                            </button>
                        </div>
                    </form>
                    
                    <div class="divider">
                        <span>ou</span>
                    </div>
                    
                    <div class="text-center">
                        <p class="mb-2 text-muted">Já tem uma conta?</p>
                        <a href="<?php echo SITE_URL; ?>/auth/login.php" class="btn btn-outline-primary">
                            <i class="bi bi-box-arrow-in-right me-2"></i>Fazer Login
                        </a>
                    </div>
                <?php endif; ?>
                
                <div class="text-center mt-4">
                    <a href="<?php echo SITE_URL; ?>/index.php" class="text-muted text-decoration-none">
                        <i class="bi bi-arrow-left me-1"></i>Voltar para a página inicial
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <script>
    function checkPasswordStrength(password) {
        const strengthBar = document.getElementById('password-strength');
        let strength = 0;
        
        if (password.length >= 6) strength++;
        if (password.length >= 10) strength++;
        if (/[A-Z]/.test(password)) strength++;
        if (/[0-9]/.test(password)) strength++;
        if (/[^A-Za-z0-9]/.test(password)) strength++;
        
        strengthBar.className = 'password-strength';
        if (password.length === 0) {
            strengthBar.style.width = '0';
        } else if (strength <= 2) {
            strengthBar.classList.add('weak');
        } else if (strength <= 4) {
            strengthBar.classList.add('medium');
        } else {
            strengthBar.classList.add('strong');
        }
    }
    </script>
    
    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


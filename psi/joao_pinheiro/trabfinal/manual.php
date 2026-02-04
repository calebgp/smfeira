<?php
/**
 * Manual de Utilização do Sistema
 * Sistema de Gestão de Produtos e Fornecedores
 */

require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/functions.php';

// Verificar autenticação
if (!esta_logado()) {
    redirecionar('/auth/login.php');
}

$titulo_pagina = 'Manual de Utilização';
?>

<?php include_once __DIR__ . '/includes/header.php'; ?>

<div class="container-fluid px-4">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="h3 mb-0">
                    <i class="bi bi-book me-2"></i>Manual de Utilização
                </h1>
                <p class="text-secondary mb-0">Guia completo para utilização do sistema</p>
            </div>
            <div class="col-auto">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="<?php echo SITE_URL; ?>/dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Manual</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- Índice -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0"><i class="bi bi-list-ol me-2"></i>Índice</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 mb-2">
                    <a href="#introducao" class="text-decoration-none">
                        <i class="bi bi-arrow-right-short me-1"></i>1. Introdução
                    </a>
                </div>
                <div class="col-md-4 mb-2">
                    <a href="#login" class="text-decoration-none">
                        <i class="bi bi-arrow-right-short me-1"></i>2. Login e Registro
                    </a>
                </div>
                <div class="col-md-4 mb-2">
                    <a href="#dashboard" class="text-decoration-none">
                        <i class="bi bi-arrow-right-short me-1"></i>3. Dashboard
                    </a>
                </div>
                <div class="col-md-4 mb-2">
                    <a href="#fornecedores" class="text-decoration-none">
                        <i class="bi bi-arrow-right-short me-1"></i>4. Gestão de Fornecedores
                    </a>
                </div>
                <div class="col-md-4 mb-2">
                    <a href="#produtos" class="text-decoration-none">
                        <i class="bi bi-arrow-right-short me-1"></i>5. Gestão de Produtos
                    </a>
                </div>
                <div class="col-md-4 mb-2">
                    <a href="#dicas" class="text-decoration-none">
                        <i class="bi bi-arrow-right-short me-1"></i>6. Dicas e Boas Práticas
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Seção 1: Introdução -->
    <section id="introducao" class="mb-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="bi bi-info-circle me-2"></i>1. Introdução</h5>
            </div>
            <div class="card-body">
                <h4 class="text-white">Bem-vindo ao Sistema de Gestão!</h4>
                <p class="lead text-white">Este sistema foi desenvolvido para facilitar a gestão de produtos e fornecedores de forma eficiente e intuitiva.</p>
                
                <h6 class="mt-4 mb-3 text-white">Principais Funcionalidades:</h6>
                <div class="row">
                    <div class="col-md-6">
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <i class="bi bi-check-circle-fill text-success me-2"></i>
                                Cadastro e gestão de fornecedores
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-check-circle-fill text-success me-2"></i>
                                Cadastro e gestão de produtos
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-check-circle-fill text-success me-2"></i>
                                Controle de estoque
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-check-circle-fill text-success me-2"></i>
                                Visualização de estatísticas
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <i class="bi bi-check-circle-fill text-success me-2"></i>
                                Interface moderna e responsiva
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-check-circle-fill text-success me-2"></i>
                                Ações rápidas no dashboard
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-check-circle-fill text-success me-2"></i>
                                Histórico de produtos recentes
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-check-circle-fill text-success me-2"></i>
                                Sistema de notificações
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="alert alert-info mt-4">
                    <i class="bi bi-lightbulb me-2"></i>
                    <strong>Dica:</strong> Navegue pelo menu superior para acessar as diferentes funcionalidades do sistema.
                </div>
            </div>
        </div>
    </section>

    <!-- Seção 2: Login e Registro -->
    <section id="login" class="mb-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="bi bi-box-arrow-in-right me-2"></i>2. Login e Registro</h5>
            </div>
            <div class="card-body">
                <h4 class="text-white">2.1 Criar uma Conta</h4>
                <p class="text-light">Para acessar o sistema, você precisa criar uma conta. Siga os passos abaixo:</p>
                
                <div class="row mt-3">
                    <div class="col-lg-8">
                        <div class="steps-indicator">
                            <div class="step mb-3">
                                <div class="step-number bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center me-3" style="width: 32px; height: 32px; font-weight: bold;">1</div>
                                <div class="step-content d-inline-block">
                                    <strong class="text-white">Acesse a página de registro</strong>
                                    <p class="text-light mb-0 small">Clique em "Registrar" na página de login ou acesse diretamente <code>auth/register.php</code></p>
                                </div>
                            </div>
                            <div class="step mb-3">
                                <div class="step-number bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center me-3" style="width: 32px; height: 32px; font-weight: bold;">2</div>
                                <div class="step-content d-inline-block">
                                    <strong class="text-white">Preencha os dados</strong>
                                    <p class="text-light mb-0 small">Informe: Nome de usuário, Email e Senha (mínimo 6 caracteres)</p>
                                </div>
                            </div>
                            <div class="step mb-3">
                                <div class="step-number bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center me-3" style="width: 32px; height: 32px; font-weight: bold;">3</div>
                                <div class="step-content d-inline-block">
                                    <strong class="text-white">Confirme o registro</strong>
                                    <p class="text-light mb-0 small">Clique em "Registrar" e você será redirecionado para o Dashboard</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="alert alert-warning">
                            <i class="bi bi-exclamation-triangle me-2"></i>
                            <strong>Importante:</strong>
                            <ul class="mb-0 mt-2 text-light">
                                <li>Use um email válido</li>
                                <li>Escolha uma senha segura</li>
                                <li>Guarde suas credenciais</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                <h4 class="text-white">2.2 Fazer Login</h4>
                <p class="text-light">Após criar sua conta, você pode fazer login:</p>
                
                <div class="row mt-3">
                    <div class="col-lg-6">
                        <div class="steps-indicator">
                            <div class="step mb-3">
                                <div class="step-number bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center me-3" style="width: 32px; height: 32px; font-weight: bold;">1</div>
                                <div class="step-content d-inline-block">
                                    <strong class="text-white">Acesse a página de login</strong>
                                    <p class="text-light mb-0 small">Acesse <code>auth/login.php</code> ou clique em "Entrar"</p>
                                </div>
                            </div>
                            <div class="step mb-3">
                                <div class="step-number bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center me-3" style="width: 32px; height: 32px; font-weight: bold;">2</div>
                                <div class="step-content d-inline-block">
                                    <strong class="text-white">Informe suas credenciais</strong>
                                    <p class="text-light mb-0 small">Digite seu email e senha cadastrados</p>
                                </div>
                            </div>
                            <div class="step mb-3">
                                <div class="step-number bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center me-3" style="width: 32px; height: 32px; font-weight: bold;">3</div>
                                <div class="step-content d-inline-block">
                                    <strong class="text-white">Clique em Entrar</strong>
                                    <p class="text-light mb-0 small">Você será redirecionado para o Dashboard</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card bg-dark">
                            <div class="card-body">
                                <h6 class="text-white"><i class="bi bi-shield-lock me-2"></i>Segurança</h6>
                                <p class="small mb-0 text-light">Suas credenciais são criptografadas e armazenadas de forma segura. Nunca solicitamos sua senha por email ou outros canais.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                <h4 class="text-white">2.3 Sair do Sistema</h4>
                <p class="text-light">Para sair do sistema, clique no menu do usuário (canto superior direito) e selecione "Sair".</p>
                <div class="alert alert-success">
                    <i class="bi bi-check-circle me-2"></i>
                    Sempre faça logout quando terminar de usar o sistema, especialmente em computadores compartilhados.
                </div>
            </div>
        </div>
    </section>

    <!-- Seção 3: Dashboard -->
    <section id="dashboard" class="mb-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="bi bi-speedometer2 me-2"></i>3. Dashboard</h5>
            </div>
            <div class="card-body">
                <h4 class="text-white">Visão Geral</h4>
                <p class="text-light">O Dashboard é a página principal do sistema, onde você encontra uma visão consolidada de todas as informações importantes.</p>

                <h5 class="mt-4 text-white">3.1 Cards de Estatística</h5>
                <p class="text-light">Os cards de estatísticas mostram métricas importantes do seu negócio:</p>
                
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-white">Card</th>
                                <th class="text-white">Descrição</th>
                                <th class="text-white">Ícone</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-white"><strong>Fornecedores</strong></td>
                                <td class="text-light">Total de fornecedores cadastrados no sistema</td>
                                <td><i class="bi bi-people text-primary"></i></td>
                            </tr>
                            <tr>
                                <td class="text-white"><strong>Produtos</strong></td>
                                <td class="text-light">Total de produtos cadastrados</td>
                                <td><i class="bi bi-box text-success"></i></td>
                            </tr>
                            <tr>
                                <td class="text-white"><strong>Estoque Baixo</strong></td>
                                <td class="text-light">Quantidade de produtos com estoque abaixo de 10 unidades</td>
                                <td><i class="bi bi-exclamation-triangle text-warning"></i></td>
                            </tr>
                            <tr>
                                <td class="text-white"><strong>Valor do Estoque</strong></td>
                                <td class="text-light">Valor total do estoque calculado pelo preço dos produtos</td>
                                <td><i class="bi bi-currency-dollar text-info"></i></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <h5 class="mt-4 text-white">3.2 Ações Rápidas</h5>
                <p class="text-light">O painel de ações rápidas permite acessar as funcionalidades mais utilizadas com um único clique:</p>
                
                <div class="row mt-3">
                    <div class="col-md-6 col-lg-3 mb-3">
                        <div class="card text-center h-100">
                            <div class="card-body">
                                <i class="bi bi-plus-circle text-primary fs-1"></i>
                                <h6 class="mt-3 mb-0 text-white">Novo Produto</h6>
                                <p class="small text-light mb-0">Cadastrar um novo produto</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 mb-3">
                        <div class="card text-center h-100">
                            <div class="card-body">
                                <i class="bi bi-person-plus text-success fs-1"></i>
                                <h6 class="mt-3 mb-0 text-white">Novo Fornecedor</h6>
                                <p class="small text-light mb-0">Cadastrar um novo fornecedor</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 mb-3">
                        <div class="card text-center h-100">
                            <div class="card-body">
                                <i class="bi bi-box-seam text-info fs-1"></i>
                                <h6 class="mt-3 mb-0 text-white">Ver Produtos</h6>
                                <p class="small text-light mb-0">Lista completa de produtos</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 mb-3">
                        <div class="card text-center h-100">
                            <div class="card-body">
                                <i class="bi bi-people text-secondary fs-1"></i>
                                <h6 class="mt-3 mb-0 text-white">Ver Fornecedores</h6>
                                <p class="small text-light mb-0">Lista completa de fornecedores</p>
                            </div>
                        </div>
                    </div>
                </div>

                <h5 class="mt-4 text-white">3.3 Produtos por Fornecedor</h5>
                <p class="text-light">Este gráfico visual mostra a distribuição de produtos por fornecedor, facilitando a identificação dos principais parceiros.</p>

                <h5 class="mt-4 text-white">3.4 Dados Recentes</h5>
                <p class="text-light">As tabelas de produtos e fornecedores recentes mostram os últimos cadastros realizados, permitindo acompanhamento rápido das últimas atividades.</p>

                <div class="alert alert-info mt-4">
                    <i class="bi bi-arrow-up-circle me-2"></i>
                    <strong>Dica:</strong> O Dashboard é atualizado automaticamente cada vez que você acessa a página, refletindo os dados mais recentes do sistema.
                </div>
            </div>
        </div>
    </section>

    <!-- Seção 4: Gestão de Fornecedores -->
    <section id="fornecedores" class="mb-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="bi bi-people me-2"></i>4. Gestão de Fornecedores</h5>
            </div>
            <div class="card-body">
                <h4 class="text-white">4.1 Listar Fornecedores</h4>
                <p class="text-light">Para visualizar todos os fornecedores cadastrados:</p>
                <ol class="mt-2 text-light">
                    <li>Acesse o menu <span class="text-white">Fornecedores</span> no menu superior</li>
                    <li>Selecione <span class="text-white">Listar Fornecedores</span></li>
                </ol>
                <p class="text-light">Você verá uma tabela com todos os fornecedores, contendo informações como nome, email, telefone, cidade, estado e status.</p>

                <h5 class="mt-4 text-white">4.2 Criar Novo Fornecedor</h5>
                <p class="text-light">Para cadastrar um novo fornecedor:</p>
                <ol class="mt-2 text-light">
                    <li>Acesse o menu <span class="text-white">Fornecedores</span> no menu superior</li>
                    <li>Selecione <span class="text-white">Novo Fornecedor</span></li>
                    <li>Preencha os campos obrigatórios (<span class="text-danger">*</span>):
                        <ul class="text-light">
                            <li><span class="text-white">Nome/Razão Social</span> (<span class="text-danger">*</span>) - Nome do fornecedor</li>
                            <li><span class="text-white">Email</span> - Email de contato</li>
                            <li><span class="text-white">Telefone</span> - Número de telefone</li>
                            <li><span class="text-white">CNPJ/CPF</span> - Documento de identificação</li>
                            <li><span class="text-white">Endereço</span> - Endereço completo</li>
                            <li><span class="text-white">Cidade</span> - Cidade do fornecedor</li>
                            <li><span class="text-white">Estado</span> - UF do fornecedor</li>
                            <li><span class="text-white">Status</span> - Ativo ou Inativo</li>
                        </ul>
                    </li>
                    <li>Clique em <span class="text-white">Salvar Fornecedor</span></li>
                </ol>

                <div class="alert alert-success mt-3">
                    <i class="bi bi-check-circle me-2"></i>
                    Fornecedor cadastrado com sucesso! Você será redirecionado para a lista de fornecedores.
                </div>

                <h5 class="mt-4 text-white">4.3 Editar Fornecedor</h5>
                <p class="text-light">Para atualizar informações de um fornecedor:</p>
                <ol class="mt-2 text-light">
                    <li>Acesse a lista de fornecedores</li>
                    <li>Clique no botão <span class="text-white"><i class="bi bi-pencil"></i> Editar</span> correspondente ao fornecedor</li>
                    <li>Modifique as informações desejadas</li>
                    <li>Clique em <span class="text-white">Salvar Alterações</span></li>
                </ol>

                <h5 class="mt-4 text-white">4.4 Excluir Fornecedor</h5>
                <div class="alert alert-danger">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    <strong>Atenção:</strong> Ao excluir um fornecedor, todos os produtos associados a ele também serão afetados. Verifique se não há produtos ativos vinculados antes de excluir.
                </div>
                <p class="text-light">Para excluir um fornecedor:</p>
                <ol class="mt-2 text-light">
                    <li>Acesse a lista de fornecedores</li>
                    <li>Clique no botão <span class="text-white"><i class="bi bi-trash"></i> Excluir</span> correspondente ao fornecedor</li>
                    <li>Confirme a exclusão na janela de confirmação</li>
                </ol>

                <h5 class="mt-4 text-white">4.5 Status do Fornecedor</h5>
                <p class="text-light">Os fornecedores podem ter dois status:</p>
                <ul class="text-light">
                    <li><span class="badge bg-success">Ativo</span> - Fornecedor em operação normal</li>
                    <li><span class="badge bg-secondary">Inativo</span> - Fornecedor temporariamente suspenso</li>
                </ul>
                <p class="text-light">Manter fornecedores inativos é útil quando você não deseja excluir permanentemente o registro, mas também não quer usá-lo temporariamente.</p>
            </div>
        </div>
    </section>

    <!-- Seção 5: Gestão de Produtos -->
    <section id="produtos" class="mb-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="bi bi-box me-2"></i>5. Gestão de Produtos</h5>
            </div>
            <div class="card-body">
                <h4 class="text-white">5.1 Listar Produtos</h4>
                <p class="text-light">Para visualizar todos os produtos cadastrados:</p>
                <ol class="mt-2 text-light">
                    <li>Acesse o menu <span class="text-white">Produtos</span> no menu superior</li>
                    <li>Selecione <span class="text-white">Listar Produtos</span></li>
                </ol>
                <p class="text-light">A tabela de produtos exibe: nome, fornecedor, preço, quantidade em estoque, status e ações disponíveis.</p>

                <h5 class="mt-4 text-white">5.2 Criar Novo Produto</h5>
                <p class="text-light">Para cadastrar um novo produto:</p>
                <ol class="mt-2 text-light">
                    <li>Acesse o menu <span class="text-white">Produtos</span> no menu superior</li>
                    <li>Selecione <span class="text-white">Novo Produto</span></li>
                    <li>Preencha os campos obrigatórios (<span class="text-danger">*</span>):
                        <ul class="text-light">
                            <li><span class="text-white">Nome</span> (<span class="text-danger">*</span>) - Nome do produto</li>
                            <li><span class="text-white">Descrição</span> - Detalhes sobre o produto</li>
                            <li><span class="text-white">Preço</span> (<span class="text-danger">*</span>) - Preço de venda (use ponto para decimais)</li>
                            <li><span class="text-white">Quantidade</span> (<span class="text-danger">*</span>) - Quantidade em estoque</li>
                            <li><span class="text-white">Fornecedor</span> (<span class="text-danger">*</span>) - Selecione o fornecedor associado</li>
                            <li><span class="text-white">Status</span> - Ativo ou Inativo</li>
                        </ul>
                    </li>
                    <li>Clique em <span class="text-white">Salvar Produto</span></li>
                </ol>

                <div class="alert alert-success mt-3">
                    <i class="bi bi-check-circle me-2"></i>
                    Produto cadastrado com sucesso! Você será redirecionado para a lista de produtos.
                </div>

                <h5 class="mt-4 text-white">5.3 Status do Produto</h5>
                <p class="text-light">Os produtos podem ter diferentes status automáticos:</p>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-white">Status</th>
                                <th class="text-white">Condição</th>
                                <th class="text-white">Descrição</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><span class="badge bg-success">Em Estoque</span></td>
                                <td class="text-light">Quantidade > 10</td>
                                <td class="text-light">Estoque saudável</td>
                            </tr>
                            <tr>
                                <td><span class="badge bg-warning text-dark">Estoque Baixo</span></td>
                                <td class="text-light">Quantidade ≤ 10</td>
                                <td class="text-light">Necessita reposição</td>
                            </tr>
                            <tr>
                                <td><span class="badge bg-danger">Sem Estoque</span></td>
                                <td class="text-light">Quantidade = 0</td>
                                <td class="text-light">Sem unidades disponíveis</td>
                            </tr>
                            <tr>
                                <td><span class="badge bg-secondary">Inativo</span></td>
                                <td class="text-light">Status = Inativo</td>
                                <td class="text-light">Produto desativado manualmente</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <h5 class="mt-4 text-white">5.4 Editar Produto</h5>
                <p class="text-light">Para atualizar informações de um produto:</p>
                <ol class="mt-2 text-light">
                    <li>Acesse a lista de produtos</li>
                    <li>Clique no botão <span class="text-white"><i class="bi bi-pencil"></i> Editar</span> correspondente ao produto</li>
                    <li>Modifique as informações desejadas (preço, quantidade, fornecedor, etc.)</li>
                    <li>Clique em <span class="text-white">Salvar Alterações</span></li>
                </ol>

                <div class="alert alert-info mt-3">
                    <i class="bi bi-info-circle me-2"></i>
                    <strong>Observação:</strong> Ao alterar a quantidade de um produto, o status pode mudar automaticamente com base nos novos valores de estoque.
                </div>

                <h5 class="mt-4 text-white">5.5 Excluir Produto</h5>
                <div class="alert alert-warning">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    <strong>Atenção:</strong> A exclusão de um produto é permanente e não pode ser desfeita. Certifique-se de que realmente deseja excluir o registro.
                </div>
                <p class="text-light">Para excluir um produto:</p>
                <ol class="mt-2 text-light">
                    <li>Acesse a lista de produtos</li>
                    <li>Clique no botão <span class="text-white"><i class="bi bi-trash"></i> Excluir</span> correspondente ao produto</li>
                    <li>Confirme a exclusão na janela de confirmação</li>
                </ol>

                <h5 class="mt-4 text-white">5.6 Produtos por Fornecedor</h5>
                <p class="text-light">Cada produto está vinculado a um fornecedor. Isso permite:</p>
                <ul class="text-light">
                    <li>Organização lógica dos produtos</li>
                    <li>Relatórios por fornecedor</li>
                    <li>Facilidade na gestão de compras</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Seção 6: Dicas e Boas Práticas -->
    <section id="dicas" class="mb-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="bi bi-lightbulb me-2"></i>6. Dicas e Boas Práticas</h5>
            </div>
            <div class="card-body">
                <h4 class="text-white">Sugestões para otimizar o uso do sistema</h4>

                <div class="row mt-4">
                    <div class="col-lg-6 mb-4">
                        <div class="card h-100 border-success">
                            <div class="card-header bg-success text-white">
                                <h6 class="mb-0"><i class="bi bi-person-plus me-2"></i>Cadastre fornecedores primeiro</h6>
                            </div>
                            <div class="card-body">
                                <p class="mb-0 text-light">Sempre cadastre os fornecedores antes de criar produtos associados a eles. Isso garante uma organização correta dos dados desde o início.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-4">
                        <div class="card h-100 border-info">
                            <div class="card-header bg-info text-white">
                                <h6 class="mb-0"><i class="bi bi-arrow-repeat me-2"></i>Mantenha o estoque atualizado</h6>
                            </div>
                            <div class="card-body">
                                <p class="mb-0 text-light">Regularmente atualize as quantidades de estoque para ter uma visão realista do seu inventário e evitar problemas de fornecimento.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-4">
                        <div class="card h-100 border-warning">
                            <div class="card-header bg-warning text-dark">
                                <h6 class="mb-0"><i class="bi bi-exclamation-triangle me-2"></i>Monitore o estoque baixo</h6>
                            </div>
                            <div class="card-body">
                                <p class="mb-0 text-light">Fique atento aos produtos com status de "Estoque Baixo". O dashboard exibe essa informação de forma destacada para facilitar o acompanhamento.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-4">
                        <div class="card h-100 border-secondary">
                            <div class="card-header bg-secondary text-white">
                                <h6 class="mb-0"><i class="bi bi-pause-circle me-2"></i>Use status inativo estrategicamente</h6>
                            </div>
                            <div class="card-body">
                                <p class="mb-0 text-light">Ao invés de excluir, use o status inativo para produtos ou fornecedores temporariamente fora de uso. Os dados são preservados para referência futura.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>

                <h5 class="mt-4 text-white"><i class="bi bi-keyboard me-2"></i>Atalhos Úteis</h5>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-white">Ação</th>
                                <th class="text-white">Atalho</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-white">Voltar ao Dashboard</td>
                                <td class="text-light">Clique no logo "Sistema de Gestão" no menu superior</td>
                            </tr>
                            <tr>
                                <td class="text-white">Acessar lista de produtos</td>
                                <td class="text-light">Menu Produtos → Listar Produtos</td>
                            </tr>
                            <tr>
                                <td class="text-white">Acessar lista de fornecedores</td>
                                <td class="text-light">Menu Fornecedores → Listar Fornecedores</td>
                            </tr>
                            <tr>
                                <td class="text-white">Fazer logout</td>
                                <td class="text-light">Menu do usuário (canto superior direito) → Sair</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <hr>

                <h5 class="mt-4 text-white"><i class="bi bi-question-circle me-2"></i>Precisa de Ajuda?</h5>
                <div class="alert alert-secondary">
                    <p class="mb-0 text-light">Este manual cobre todas as funcionalidades principais do sistema. Se você tiver dúvidas adicionais ou encontrar problemas, consulte a documentação técnica ou entre em contato com o suporte responsável pelo sistema.</p>
                </div>

                <div class="text-center mt-5 mb-3">
                    <div class="card d-inline-block" style="max-width: 400px;">
                        <div class="card-body">
                            <i class="bi bi-box-seam text-primary fs-1"></i>
                            <h5 class="mt-2 mb-0 text-white">Sistema de Gestão</h5>
                            <p class="text-muted">Versão 1.0</p>
                            <p class="small text-light mb-0">Desenvolvido para fins educacionais</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Botão Voltar ao Topo -->
    <div class="text-end mb-4">
        <a href="#" class="btn btn-outline-primary" onclick="window.scrollTo({top: 0, behavior: 'smooth'}); return false;">
            <i class="bi bi-arrow-up me-1"></i>Voltar ao topo
        </a>
    </div>
</div>

<?php include_once __DIR__ . '/includes/footer.php'; ?>


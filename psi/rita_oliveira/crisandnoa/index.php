<?php

// Opcional: criar a base de dados se ainda não existir
include 'bd_criar.php';

// ligar à base de dados
include 'bd_ligar.php';



?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>cris&noa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    
    <link href="css/estilos.css" rel="stylesheet">
</head>
<body>

    <!-- TOP BAR -->
    <div class="top-bar">
        <div class="logo"><a href="index.php">cris&noa</a></div>
        <div>
            <a href="#" id="openSearch" class="me-3 text-dark text-decoration-none">
                Pesquisar
            </a>
            <a href="login.php" class="btn btn-dark btn-sm">Login</a>
        </div>
    </div>

    <!-- NAV -->
    <nav class="navbar navbar-expand-lg border-bottom">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainnav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainnav">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="index.php">Início</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Categoria 1</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Categoria 2</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Contactos</a></li>
                </ul>
            </div>
        </div>
    </nav>
 
  
   <!-- SEARCH DIV ESCONDIDA -->
    <div id="searchDiv" class="search-div py-4" style="display:none; background:#f8f8f8; position:relative;">
        <div class="container text-center">
            <form method="GET" action="pesquisa.php" class="w-50 mx-auto">
                 <input type="text" name="q" class="form-control form-control-lg text-center" placeholder="Pesquisar...">
            </form>
            <button id="closeSearch" class="btn btn-link position-absolute" style="top:10px; right:10px; font-size:28px; color:#000;">
                <i class="bi bi-x"></i>
            </button>
        </div>
    </div>

    <!-- CONTENT -->
    <div class="container my-5">
        <h2 class="mb-4">Últimas Roupinhas</h2>
        <div class="row">
            <?php
            // Mostrar últimos 3 produtos da categoria Roupinhas (id = 1)
            $stmt = $conn->prepare("SELECT * FROM produtos WHERE categoria_id = 1 ORDER BY criado_em DESC LIMIT 3");
            $stmt->execute();
            $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach($produtos as $produto):
            ?>
            <!-- imagem -->
            <div class="col-md-4 mb-4">
                <div class="card border-0 text-center">
                    <!-- A imagem agora abre a modal -->
                    <img src="imagens_produtos/roupinhas/<?php echo htmlspecialchars($produto['imagem']); ?>" 
                        class="card-img-top" 
                        alt="<?php echo htmlspecialchars($produto['nome']); ?>" 
                        data-bs-toggle="modal" 
                        data-bs-target="#produtoModal<?php echo $produto['id']; ?>">

                    <div class="card-body">
                        <a href="#" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#produtoModal<?php echo $produto['id']; ?>">Comprar</a>
                    </div>
                </div>
            </div>

            <!-- Modal do produto -->
            <div class="modal fade" id="produtoModal<?php echo $produto['id']; ?>" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo htmlspecialchars($produto['nome']); ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body text-center">
                    <img src="imagens_produtos/roupinhas/<?php echo htmlspecialchars($produto['imagem']); ?>" class="img-fluid mb-3" alt="<?php echo htmlspecialchars($produto['nome']); ?>">
                    <p><?php echo htmlspecialchars($produto['descricao']); ?></p>
                    <p><strong>Preço: €<?php echo number_format($produto['preco'], 2); ?></strong></p>

                    <?php
                    // Buscar tamanhos disponíveis
                    $stmtT = $conn->prepare("SELECT t.nome FROM tamanhos t
                                            INNER JOIN produto_tamanhos pt ON t.id = pt.tamanho_id
                                            WHERE pt.produto_id = ?");
                    $stmtT->execute([$produto['id']]);
                    $tamanhos = $stmtT->fetchAll(PDO::FETCH_ASSOC);
                    ?>

                    <div class="mb-3">
                    <label for="tamanho<?php echo $produto['id']; ?>" class="form-label">Escolher tamanho:</label>
                    <select class="form-select" id="tamanho<?php echo $produto['id']; ?>">
                        <?php foreach($tamanhos as $t): ?>
                        <option value="<?php echo htmlspecialchars($t['nome']); ?>"><?php echo htmlspecialchars($t['nome']); ?></option>
                        <?php endforeach; ?>
                    </select>
                    </div>
                    <button class="btn btn-dark">Adicionar ao carrinho</button>
                </div>
                </div>
            </div>
            </div>

            <?php endforeach; ?>
        </div>
        <div class="text-center mt-4">
            <a href="categoria.php?id=1" class="btn btn-dark">Ver Mais Roupinhas</a>
        </div>
    </div>

    <!-- FOOTER -->
    <footer class="text-center py-4 border-top">
        <small>&copy; 2025 cris&noa — criado por RitaCris&Noa</small>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
   <script>
        const searchDiv = document.getElementById('searchDiv');
        document.getElementById('openSearch').onclick = (e) => {
            e.preventDefault();
            searchDiv.style.display = searchDiv.style.display === 'none' ? 'block' : 'none';
        };
        document.getElementById('closeSearch').onclick = () => searchDiv.style.display = 'none';
    </script>
</body>
</html>

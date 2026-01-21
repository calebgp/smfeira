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
        <?php
        if(isset($_GET['id']) && is_numeric($_GET['id'])) {
            $categoria_id = $_GET['id'];

            // Buscar informações da categoria
            $stmtCat = $conn->prepare("SELECT nome FROM categorias WHERE id = ?");
            $stmtCat->execute([$categoria_id]);
            $categoria = $stmtCat->fetch(PDO::FETCH_ASSOC);

            if($categoria):
        ?>
            <!-- Título dinâmico -->
            <h2 class="mb-4"><?php echo htmlspecialchars($categoria['nome']); ?></h2>
        

            <div class="row">
                <?php
                $stmt = $conn->prepare("SELECT * FROM produtos WHERE categoria_id = ? ORDER BY criado_em DESC");
                $stmt->execute([$categoria_id]);
                $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach($produtos as $produto):
                ?>
                <div class="col-md-4 mb-4">
                    <div class="card border-0 text-center">
                        <img src="imagens_produtos/roupinhas/<?php echo htmlspecialchars($produto['imagem']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($produto['nome']); ?>">
                        <div class="card-body">
                            <a href="#" class="btn btn-dark">Comprar</a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        <?php
            else:
                echo "<p>Categoria não encontrada.</p>";
            endif;
        } else {
            echo "<p>Categoria inválida.</p>";
        }
        ?>
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

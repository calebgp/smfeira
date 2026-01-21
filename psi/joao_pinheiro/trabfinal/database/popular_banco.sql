-- Popular Banco de Dados com dados iniciais
-- Sistema de Gestão de Produtos e Fornecedores
-- PHP com MySQL

USE gestao_produtos;

-- Inserir usuário administrador padrão
INSERT INTO usuarios (username, email, password) VALUES 
('admin', 'admin@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

-- Inserir fornecedores de exemplo
INSERT INTO fornecedores (nome, contato, email, telefone, endereco, cidade, estado, pais, status) VALUES
('Fornecedor A', 'João Silva', 'joao@fornecedora.com', '(11) 99999-1111', 'Rua A, 100', 'São Paulo', 'SP', 'Brasil', 'ativo'),
('Fornecedor B', 'Maria Santos', 'maria@fornecedorb.com', '(21) 98888-2222', 'Avenida B, 200', 'Rio de Janeiro', 'RJ', 'Brasil', 'ativo'),
('Fornecedor C', 'Pedro Oliveira', 'pedro@fornecedorc.com', '(31) 97777-3333', 'Rua C, 300', 'Belo Horizonte', 'MG', 'Brasil', 'ativo'),
('Fornecedor Inativo', 'Carlos Souza', 'carlos@inativo.com', '(41) 96666-4444', 'Rua D, 400', 'Curitiba', 'PR', 'Brasil', 'inativo');

-- Inserir produtos de exemplo
INSERT INTO produtos (nome, categoria, descricao, preco, quantidade, unidade, fornecedor_id, status) VALUES
('Produto 1', 'Eletrônicos', 'Descrição do Produto 1', 99.99, 50, 'un', 1, 'ativo'),
('Produto 2', 'Eletrônicos', 'Descrição do Produto 2', 149.99, 5, 'un', 1, 'estoque_baixo'),
('Produto 3', 'Roupas', 'Descrição do Produto 3', 79.99, 100, 'un', 2, 'ativo'),
('Produto 4', 'Roupas', 'Descrição do Produto 4', 199.99, 8, 'un', 2, 'estoque_baixo'),
('Produto 5', 'Alimentos', 'Descrição do Produto 5', 29.99, 200, 'kg', 3, 'ativo'),
('Produto 6', 'Alimentos', 'Descrição do Produto 6', 9.99, 3, 'un', 3, 'estoque_baixo'),
('Produto 7', 'Móveis', 'Descrição do Produto 7', 599.99, 15, 'un', 1, 'ativo'),
('Produto 8', 'Móveis', 'Descrição do Produto 8', 299.99, 2, 'un', 2, 'estoque_baixo'),
('Produto Sem Fornecedor', 'Outros', 'Produto sem fornecedor vinculado', 49.99, 25, 'un', NULL, 'ativo'),
('Produto Inativo', 'Eletrônicos', 'Produto inativo', 999.99, 0, 'un', 1, 'inativo');


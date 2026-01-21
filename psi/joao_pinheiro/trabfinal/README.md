# Sistema de Gestão de Produtos e Fornecedores

## 📋 Visão Geral

Sistema CRUD completo para gestão de produtos e fornecedores desenvolvido em PHP com MySQL/XAMPP.

## ✨ Funcionalidades

- 🔐 **Sistema de Autenticação**: Login, Logout e Registro de usuários
- 👥 **Gestão de Fornecedores**: Criar, Ler, Atualizar e Excluir fornecedores
- 📦 **Gestão de Produtos**: Criar, Ler, Atualizar e Excluir produtos (vinculados a fornecedores)
- 🔗 **Relacionamento**: Produtos vinculados a fornecedores via foreign key
- 🎨 **Interface**: Design moderno, responsivo e com animações suaves

## 🚀 Melhorias Recentes (UI/UX)

### Design Moderno

- ✅ **Paleta de Cores Moderna**: Cores mais vibrantes e agradáveis
- ✅ **Animações Suaves**: Transições e efeitos de hover em todos os elementos
- ✅ **Cards Aprimorados**: Bordas arredondadas, sombras sutis e efeitos de hover
- ✅ **Ícones Aprimorados**: Badges com ícones e cores contextualizadas
- ✅ **Typography Aprimorada**: Fonte Inter e melhor hierarquia visual

### Funcionalidades de Interface

- ✅ **Toast Notifications**: Mensagens de feedback modernas e não intrusivas
- ✅ **Empty States**: Telas vazias informativas com Call-to-Action
- ✅ **Formatação de Preço**: Input com prefixo R$ e formatação automática
- ✅ **Máscara de Telefone**: Formatação automática de telefones
- ✅ **Indicador de Força de Senha**: Barra de progresso 强弱

### Segurança

- ✅ **Proteção CSRF**: Tokens de segurança em todos os formulários
- ✅ **Session Regeneration**: Regeneração de ID de sessão no login
- ✅ **Validação de Entrada**: Sanitização e validação aprimorada

### Performance

- ✅ **JavaScript Leve**: Removida dependência do jQuery
- ✅ **Scripts Otimizados**: Scripts desnecessários removidos
- ✅ **CDN Atualizado**: Bootstrap 5.3.3 e ícones mais recentes

## 📁 Estrutura de Arquivos

```
PROJETO_CRUD_PHP/
├── database/
│   ├── criar_banco.sql
│   └── popular_banco.sql
├── includes/
│   ├── config.php
│   ├── functions.php      (inclui funções CSRF)
│   ├── header.php         (com toast notifications)
│   └── footer.php         (scripts otimizados)
├── css/
│   └── style.css          (design moderno completo)
├── js/
│   └── main.js            (JavaScript moderno, sem jQuery)
├── auth/
│   ├── login.php          (design moderno + CSRF)
│   ├── register.php       (design moderno + CSRF)
│   └── logout.php
├── fornecedores/
│   ├── index.php          (lista moderna)
│   ├── criar.php          (formulário moderno)
│   ├── editar.php         (formulário moderno + CSRF)
│   └── excluir.php
├── produtos/
│   ├── index.php          (lista moderna)
│   ├── criar.php          (formulário moderno)
│   ├── editar.php         (formulário moderno + CSRF)
│   └── excluir.php
├── dashboard.php          (dashboard moderno)
├── index.php
└── manual.md
```

## 🚀 Instalação Rápida

### Passo 1: Instalar XAMPP

1. Baixe o XAMPP em https://www.apachefriends.org
2. Instale seguindo as instruções do instalador
3. Inicie os serviços Apache e MySQL no XAMPP Control Panel

### Passo 2: Criar o Banco de Dados

1. Acesse http://localhost/phpmyadmin
2. Crie um novo banco de dados chamado `gestao_produtos`
3. Execute os scripts SQL:
   - Primeiro: `database/criar_banco.sql`
   - Depois: `database/popular_banco.sql`

### Passo 3: Configurar o Projeto

1. Copie a pasta `PROJETO_CRUD_PHP` para `C:\xampp\htdocs\` (Windows) ou `/Applications/XAMPP/htdocs/` (macOS)
2. Configure as credenciais no arquivo `includes/config.php`

### Passo 4: Acessar o Sistema

1. Abra o navegador
2. Acesse: http://localhost/PROJETO_CRUD_PHP/
3. Faça login com:
   - Usuário: **admin**
   - Senha: **admin123**

## 🔐 Credenciais de Demonstração

```
Usuário: admin
Senha: admin123
```

## 📝 Manual de Utilização

Consulte o arquivo `manual.md` para instruções detalhadas.

## 🎨 Capturas de Tela

### Login Moderno

- Design gradient atrativo
- Campos com ícones
- Credenciais de demonstração visíveis
- Validação de força de senha

### Dashboard

- Cards de estatísticas com ícones
- Gráficos de produtos por fornecedor
- Tabelas com último produtos/fornecedores
- Empty states informativos

### Lista de Produtos/Fornecedores

- Filtros avançados
- Badges coloridos com ícones
- Modal de confirmação de exclusão
- Empty states com CTA

## 👨‍💻 Autor

Desenvolvido para fins educacionais

## 📄 Licença

Livre para uso educacional

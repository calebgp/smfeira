// Função para carregar o conteúdo de cada página na div "content"
function loadContent(page) {
    fetch(page)
        .then(response => response.text())
        .then(data => {
            document.getElementById('content').innerHTML = data;
            updateActiveLink(page);
        })
        .catch(error => console.error('Erro ao carregar a página:', error));
}

// Função para atualizar o link ativo na navegação
function updateActiveLink(path) {
    const navLinks = document.querySelectorAll('.topnav a');
    navLinks.forEach(link => link.classList.remove('active'));

    document.querySelector(`.topnav a[href='${path}']`).classList.add('active');
}

// Função para navegar sem recarregar a página e atualizar o URL
function navigateTo(event, path) {
    event.preventDefault();
    loadPageFromPath(path); // Carrega o conteúdo correto baseado no novo URL
}

// Função para determinar o conteúdo a ser carregado baseado no caminho
function loadPageFromPath(path) {
    switch (path) {
        case "/contatos":
            loadContent("/contatos");
            break;
        case "/fundacao":
            console.log("Fundacao");
            loadContent("/fundacao");
            break;
        case "/home":
            loadContent("/home");
            break;
        default:
            loadContent("/home");
            break;
    }
}

// Manipula o evento de navegação do navegador (ex: botão "Voltar")
window.onpopstate = () => {
    loadPageFromPath(window.location.pathname);
};

const path = window.location.pathname;
loadPageFromPath(path);

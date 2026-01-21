document.getElementById('formHabilidade').addEventListener('submit', function(e) {
    e.preventDefault();
    const habilidade = document.getElementById('inputHabilidade').value;
    const li = document.createElement('li');
    li.textContent = habilidade;
    document.getElementById('listaHabilidades').appendChild(li);
    document.getElementById('inputHabilidade').value = '';
});

document.getElementById('formProjeto').addEventListener('submit', function(e) {
    e.preventDefault();
    const nomeProjeto = document.getElementById('inputNomeProjeto').value;
    const descricaoProjeto = document.getElementById('inputDescricaoProjeto').value;
    const linkProjeto = document.getElementById('inputLinkProjeto').value;
    const div = document.createElement('div');
    div.classList.add('projeto');
    div.innerHTML = `<h3>${nomeProjeto}</h3><p>${descricaoProjeto}</p><a href="${linkProjeto}" target="_blank">Ver Projeto</a>`;
    document.getElementById('listaProjetos').appendChild(div);
    document.getElementById('inputNomeProjeto').value = '';
    document.getElementById('inputDescricaoProjeto').value = '';
    document.getElementById('inputLinkProjeto').value = '';
});

document.getElementById('formContato').addEventListener('submit', function(e) {
    e.preventDefault();
    const nomeContato = document.getElementById('inputNomeContato').value;
    const linkContato = document.getElementById('inputLinkContato').value;
    const li = document.createElement('li');
    li.innerHTML = `<a href="${linkContato}" target="_blank">${nomeContato}</a>`;
    document.getElementById('listaContatosAdicionados').appendChild(li);
    document.getElementById('inputNomeContato').value = '';
    document.getElementById('inputLinkContato').value = '';
});
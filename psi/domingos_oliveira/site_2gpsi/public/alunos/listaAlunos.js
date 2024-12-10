document.addEventListener('DOMContentLoaded', function() {
    fetch('alunos.json')
        .then(response => response.json())
        .then(alunos => {
            console.log(alunos);
            const alunosLista = document.getElementById('lista-alunos');
            alunos.sort((a, b) => a.name.localeCompare(b.name));
            alunos.forEach(aluno => {
                const alunoDiv = document.createElement('div');
                alunoDiv.classList.add('aluno');
                alunoDiv.setAttribute('data-id', aluno.id);

                alunoDiv.innerHTML = `
                    <img src="${aluno.picturePath}" alt="Foto de ${aluno.name}">
                    <h3>${aluno.name}</h3>
                `;

                alunoDiv.addEventListener('click', function() {
                    // Redirecionar para a página de detalhes do aluno
                    window.location.href = `../aluno/?id=${aluno.id}`;
                });

                alunosLista.appendChild(alunoDiv);
            });
        })
        .catch(error => {
            console.error('Erro ao carregar os dados dos alunos:', error);
        });
});

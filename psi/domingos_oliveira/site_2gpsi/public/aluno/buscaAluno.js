document.addEventListener("DOMContentLoaded", function () {
    const params = new URLSearchParams(window.location.search);
    const alunoId = params.get("id");

    fetch("../alunos/alunos.json")
        .then((response) => response.json())
        .then((alunos) => {
            const aluno = alunos.find((a) => a.id == alunoId);

            if (aluno) {
                document.getElementById("detalhes-alunos").innerHTML = `
                    <img src="${aluno.picturePath}" alt="Foto de ${aluno.name}">
                    <h2>${aluno.name}</h2>
                    <p><strong>Email:</strong> <a href="mailto:${aluno.email}">${aluno.email}</a></p>
                    <p><strong>Idade:</strong> ${aluno.age} anos</p>
                    <p><strong>Descrição:</strong> ${aluno.info}</p>
                `;
            } else {
                document.getElementById("detalhes-alunos").innerHTML = `
                    <h2>Aluno não encontrado</h2>
                    <p>Desculpe, não encontramos esse aluno. Por favor, tente novamente.</p>
                `;
            }
        })
        .catch((error) => {
            console.error("Erro ao carregar os dados do aluno:", error);
        });
});

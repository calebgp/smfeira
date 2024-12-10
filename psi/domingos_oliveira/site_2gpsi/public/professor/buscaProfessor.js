document.addEventListener("DOMContentLoaded", function () {
    const params = new URLSearchParams(window.location.search);
    const profId = params.get("id");

    fetch("../professores/professores.json")
        .then((response) => response.json())
        .then((profs) => {
            const prof = profs.find((a) => a.id == profId);

            if (prof) {
                document.getElementById("detalhes-profs").innerHTML = `
                    <img src="${prof.picturePath}" alt="Foto de ${prof.name}">
                    <h2>${prof.name}</h2>
                    <p><strong>Disciplina:</strong> ${prof.subject}</p>
                    <p><strong>Email:</strong> <a href="mailto:${prof.email}">${prof.email}</a></p>
                    <p><strong>Descrição:</strong> ${prof.info}</p>
                `;
            } else {
                document.getElementById("detalhes-profs").innerHTML = `
                    <h2>prof não encontrado</h2>
                    <p>Desculpe, não encontramos esse prof. Por favor, tente novamente.</p>
                `;
            }
        })
        .catch((error) => {
            console.error("Erro ao carregar os dados do prof:", error);
        });
});

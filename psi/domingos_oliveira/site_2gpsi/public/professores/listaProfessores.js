document.addEventListener('DOMContentLoaded', function() {
    console.log('DOMContentLoaded');
    // Carregar os dados dos profs do arquivo JSON
    fetch('professores.json')
        .then(response => response.json())
        .then(profs => {
            profs.sort((a, b) => a.name.localeCompare(b.name));
            const profsLista = document.getElementById('lista-profs');

            // Gerar os cards dos profs
            profs.forEach(prof => {
                const profDiv = document.createElement('div');
                profDiv.classList.add('prof');
                profDiv.setAttribute('data-id', prof.id);

                profDiv.innerHTML = `
                    <img src="${prof.picturePath}" alt="Foto de ${prof.name}">
                    <h3>${prof.name}</h3>
                `;

                profDiv.addEventListener('click', function() {
                    // Redirecionar para a página de detalhes do prof
                    window.location.href = `../professor/?id=${prof.id}`;
                });

                profsLista.appendChild(profDiv);
            });
        })
        .catch(error => {
            console.error('Erro ao carregar os dados dos profs:', error);
        });
});

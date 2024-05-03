// Sélection du formulaire
const statsForm = document.getElementById('stats-form');

// Sélection du conteneur des statistiques
const statsContainer = document.getElementById('stats-container');

// Écouteur d'événement pour soumettre le formulaire
statsForm.addEventListener('submit', function(event) {
    // Empêche le comportement par défaut du formulaire
    event.preventDefault();

    // Récupère les valeurs des champs du formulaire
    const map = statsForm.elements['map'].value;
    const result = statsForm.elements['result'].value;
    const kills = statsForm.elements['kills'].value;
    const deaths = statsForm.elements['deaths'].value;

    // Crée un nouvel élément div pour afficher les résultats
    const statItem = document.createElement('div');
    statItem.classList.add('stat-item');
    
    // Génère le texte à afficher en fonction des valeurs soumises
    let statText = `${map}, `;
    switch(result) {
        case 'win':
            statText += 'Victoire';
            break;
        case 'loss':
            statText += 'Défaite';
            break;
        case 'draw':
            statText += 'Match nul';
            break;
        default:
            statText += 'Résultat inconnu';
    }

    // Ajoute le nombre de kills au texte si une valeur est saisie
    if (kills) {
        statText += `, ${kills} kills`;
    }

    // Ajoute le nombre de kills au texte si une valeur est saisie
    if (deaths) {
        statText += `, ${deaths} morts`;
    }

    // Ajoute le texte généré à l'élément div
    statItem.textContent = statText;

    // Ajoute l'élément div au conteneur des statistiques
    statsContainer.appendChild(statItem);
});

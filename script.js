// Sélection du formulaire
const statsForm = document.getElementById('stats-form');

// Sélection du conteneur des statistiques
const statsContainer = document.getElementById('stats-container');

// Écouteur d'événement pour soumettre le formulaire
statsForm.addEventListener('submit', function(event) {
    // Empêche le comportement par défaut du formulaire
    event.preventDefault();

    // Récupère les valeurs des champs du formulaire
    const result = statsForm.elements['result'].value;
    const map = statsForm.elements['map'].value;
    const agent = statsForm.elements['agent'].value;
    const kills = parseInt(statsForm.elements['kills'].value);
    const deaths = parseInt(statsForm.elements['deaths'].value);

    // Calculer les pourcentages de kills et de morts
    const totalKills = kills;
    const totalDeaths = deaths;
    const total = totalKills + totalDeaths;
    const killsPercentage = (totalKills / total) * 100;
    const deathsPercentage = (totalDeaths / total) * 100;

    // Mettre à jour les barres de progression
    document.getElementById('kills-progress').value = killsPercentage;
    document.getElementById('deaths-progress').value = deathsPercentage;

    // Crée un nouvel élément div pour afficher les résultats
    const statItem = document.createElement('div');
    statItem.classList.add('stat-item');

    // Génère le texte à afficher en fonction des valeurs soumises
    let statText = ``;
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
    statText += ` sur ${map}`;
    statText += ` avec ${agent}`;
    
    // Ajoute le nombre de kills au texte si une valeur est saisie
    if (!isNaN(kills)) {
        statText += `, ${kills} kills`;
    }

    // Ajoute le nombre de morts au texte si une valeur est saisie
    if (!isNaN(deaths)) {
        statText += `, ${deaths} morts`;
    }

    // Ajoute le texte généré à l'élément div
    statItem.textContent = statText;

    // Sélectionne l'élément qui est actuellement en haut (après les barres de progression)
    const firstStatItem = document.querySelector('.stat-item');

    // Ajoute l'élément div avant cet élément (après les barres de progression)
    statsContainer.insertBefore(statItem, firstStatItem);
});

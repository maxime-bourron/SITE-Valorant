// Sélection du formulaire
const statsForm = document.getElementById('stats-form');

// Sélection du conteneur des statistiques
const statsContainer = document.getElementById('stats-container');

// Sélection du corps du tableau
const statsTableBody = document.getElementById('stats-table-body');

// Écouteur d'événement pour soumettre le formulaire
statsForm.addEventListener('submit', function(event) {
    // Empêche le comportement par défaut du formulaire
    event.preventDefault();

    // Récupère les valeurs des champs du formulaire
    const result = statsForm.elements['result'].value;
    const roundwin = parseInt(statsForm.elements['roundwin'].value);
    const roundlose = parseInt(statsForm.elements['roundlose'].value);
    const map = statsForm.elements['map'].value;
    const agent = statsForm.elements['agent'].value;
    const kills = parseInt(statsForm.elements['kills'].value);
    const deaths = parseInt(statsForm.elements['deaths'].value);
    const assists = parseInt(statsForm.elements['assists'].value);

    // Crée une nouvelle ligne de tableau
    const newRow = statsTableBody.insertRow(0);

    // Ajoute des cellules à la ligne de tableau et y insère les valeurs du formulaire
    newRow.insertCell().textContent = result;
    newRow.insertCell().textContent = roundwin;
    newRow.insertCell().textContent = roundlose;
    newRow.insertCell().textContent = agent;
    newRow.insertCell().textContent = kills;
    newRow.insertCell().textContent = deaths;
    newRow.insertCell().textContent = assists;
    newRow.insertCell().textContent = map;

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
});

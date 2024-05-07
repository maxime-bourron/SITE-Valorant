// Récupérer les données depuis la base de données
function afficherDonnees() {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'recuperer_donnees.php', true);

    xhr.onload = function() {
        if(xhr.status === 200) {
            const donnees = JSON.parse(xhr.responseText);
            afficherDonneesDansPage(donnees);
        }
    };

    xhr.send();
}

// Afficher les données dans la page web
function afficherDonneesDansPage(donnees) {
    const tbody = document.getElementById('stats-table-body');
    tbody.innerHTML = ''; // Effacer le contenu précédent du tableau

    donnees.forEach(function(donnee) {
        const newRow = tbody.insertRow();
        newRow.insertCell().textContent = donnee.result;
        newRow.insertCell().textContent = donnee.roundwin;
        newRow.insertCell().textContent = donnee.roundlose;
        newRow.insertCell().textContent = donnee.kills;
        newRow.insertCell().textContent = donnee.deaths;
        newRow.insertCell().textContent = donnee.assists;
        newRow.insertCell().textContent = donnee.agent;
        newRow.insertCell().textContent = donnee.map;
    });
}

// Appeler la fonction pour afficher les données lors du chargement de la page
window.onload = function() {
    afficherDonnees();
};

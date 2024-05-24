<?php
// C'est le calendrier dynamique de l'interface utilisateur.

// Démarre une session et redirige vers la page de connexion si l'utilisateur n'est pas connecté.
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: /my-app/login.php");
    exit();
}

// Inclut les fichiers de navigation et de pied de page.
include($_SERVER['DOCUMENT_ROOT'] . "/my-app/ressources/nav.php");
include($_SERVER['DOCUMENT_ROOT'] . "/my-app/ressources/footer.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendrier Jeunesse T-C</title>
    <link rel="stylesheet" href="/my-app/ressources/styles.css">
    <link href="/my-app/bootstrap/bootstrap.min.css" rel="stylesheet">
    <script src="/my-app/bootstrap/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container">
        <br/>
        <h2>Jeunesse Treycovagnes - Chamblon 2024</h2>
        <br/>

        <!-- Intégration d'un flux RSS personnalisé -->
        <?php include($_SERVER['DOCUMENT_ROOT'] . "/my-app/fluxrss.php");?>
   
        <!-- Boutons de navigation du calendrier -->
        <div class="nav-buttons">
            <button class="btn btn-sm btn-primary" onclick="prevMonth()">Mois précédent</button>
            <b><span id="monthYear"></span></b>
            <button class="btn btn-sm btn-primary" onclick="nextMonth()">Mois suivant</button>
        </div>
        
        <!-- Tableau du calendrier dynamique -->
        <table id="calendar"></table>

        <script>
            var currentDate = new Date();
            var currentYear = currentDate.getFullYear();
            var currentMonth = currentDate.getMonth();
            var currentView = 'month'; 

            // Chargement des événements depuis une source de données backend
            fetch('/my-app/DB/calendrier.php')
                .then(response => response.json())
                .then(data => {
                    events = data;
                    updateCalendar();
                });

            document.addEventListener('DOMContentLoaded', function() {
                // Initialisation du calendrier à la fin du chargement de la page
            });

            // Génère et affiche le calendrier pour un mois donné
            function generateCalendar(year, month) {
                var firstDay = new Date(year, month, 1).getDay();
                var lastDate = new Date(year, month + 1, 0).getDate();

                var table = document.getElementById("calendar");
                table.innerHTML = "";

                // Entêtes des jours de la semaine
                var headerRow = table.insertRow();
                var daysOfWeek = ["DIM", "LUN", "MAR", "MER", "JEU", "VEN", "SAM"];
                for (var i = 0; i < 7; i++) {
                    var th = document.createElement("th");
                    th.textContent = daysOfWeek[i];
                    headerRow.appendChild(th);
                }

                // Remplissage des jours du mois dans le calendrier
                var date = 1;
                for (var i = 0; i < 6; i++) {
                    var row = table.insertRow();

                    for (var j = 0; j < 7; j++) {
                        var cell = row.insertCell();
                        if ((i === 0 && j < firstDay) || date > lastDate) {
                            cell.textContent = "";
                        } else {
                            cell.textContent = date;
                            // Recherche d'événements pour la date courante et ajout au calendrier
                            var cellDate = new Date(year, month, date +1);
                            var dateString = cellDate.toISOString().split('T')[0];
                            if (events[dateString]) {
                                cell.classList.add("event-day");  
                                var eventList = events[dateString].join(', ');
                                var eventDiv = document.createElement("div");
                                eventDiv.innerHTML = eventList;
                                cell.appendChild(eventDiv);
                            }       
                            date++;
                        }
                    }
                }
                // Mise à jour de l'affichage du mois et de l'année en cours
                document.getElementById("monthYear").textContent = new Intl.DateTimeFormat('fr-FR', { month: 'long', year: 'numeric' }).format(new Date(year, month));
            }

            function updateCalendar() {
                // Met à jour le calendrier avec les nouvelles données
                generateCalendar(currentYear, currentMonth);
            }

            // Fonctions pour naviguer entre les mois
            function prevMonth() {
                currentMonth--;
                if (currentMonth < 0) {
                    currentMonth = 11;
                    currentYear--;
                }
                updateCalendar();
            }

            function nextMonth() {
                currentMonth++;
                if (currentMonth > 11) {
                    currentMonth = 0;
                    currentYear++;
                }
                updateCalendar();
            }

            // Mise à jour initiale du calendrier
            updateCalendar();
        </script>
    </div>
</body>
</html>

<?php
include ('ressources/nav.php');
include ('ressources/footer.php');

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="images/logo.png" />
    <title>Calendrier Jeunesse T-C</title>
    <link rel="stylesheet" href="ressources/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</head>
<body>
    <div class="container">
        <br/>
            <h2>Jeunesse Treycovagnes - Chamblon 2024</h2>
        <br/>

        <?php include('fluxrss.php'); ?>
   
        <div class="nav-buttons">
            <button class="btn btn-sm btn-primary" onclick="prevMonth()">Mois précédent</button>
            <b><span id="monthYear"></span></b>
            <button class="btn btn-sm btn-primary" onclick="nextMonth()">Mois suivant</button>
        </div>
        
        <table id="calendar"></table>

        <script>
            var currentDate = new Date();
            var currentYear = currentDate.getFullYear();
            var currentMonth = currentDate.getMonth();
            var currentView = 'month'; 

            // Récupère les données depuis le fichier PHP
            fetch('DB/calendrier.php')
                .then(response => response.json())
                .then(data => {
                    events = data;
                    updateCalendar();
                });

            document.addEventListener('DOMContentLoaded', function() {
            });

            function generateCalendar(year, month) {
                var firstDay = new Date(year, month, 1).getDay();
                var lastDate = new Date(year, month + 1, 0).getDate();

                var table = document.getElementById("calendar");
                table.innerHTML = "";

                // Créer les colonnes des jours de la semaine
                var headerRow = table.insertRow();
                var daysOfWeek = ["DIM", "LUN", "MAR", "MER", "JEU", "VEN", "SAM"];
                for (var i = 0; i < 7; i++) {
                    var th = document.createElement("th");
                    th.textContent = daysOfWeek[i];
                    headerRow.appendChild(th);
                }

                // Créer les lignes du calendrier
                var date = 1;
    for (var i = 0; i < 6; i++) {
        var row = table.insertRow();

        for (var j = 0; j < 7; j++) {
            if ((i === 0 && j < firstDay) || date > lastDate) {
                var cell = row.insertCell();
                cell.textContent = "";
            } else {
                var cell = row.insertCell();
                cell.textContent = date;

                // Ajouter les manif dans le calendrier
                var cellDate = new Date(year, month, date +1);
                var dateString = cellDate.toISOString().split('T')[0];
                
                if (events[dateString]) {
                // Ajouter la classe event-day pour surligner
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

                document.getElementById("monthYear").textContent = new Intl.DateTimeFormat('fr-FR', { month: 'long', year: 'numeric' }).format(new Date(year, month));
            }

            function selectDay(cell) {
                console.log("selectDay called");
            // Remove the "selected-day" class from all cells
            var allCells = document.querySelectorAll("td");
            allCells.forEach(function(cell) {
                cell.classList.remove("selected-day", "highlight");
            });
            }

            function updateCalendar() {
                generateCalendar(currentYear, currentMonth);

                // Appeler la fonction selectDay pour le jour actuel (par défaut)
                var currentDayCell = document.querySelector(".current-day");
                if (currentDayCell) {
                    selectDay(currentDayCell);
                }
            }

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

            updateCalendar();
        </script>
    </div>
</body>
</html>

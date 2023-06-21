<?php
session_start();

// Controleer of de gebruiker is ingelogd
function isIngelogd() {
    return isset($_SESSION['ingelogd']) && $_SESSION['ingelogd'] === true;
}

// Haal de gebruikersgegevens op uit de sessie
function getGebruiker() {
    return $_SESSION['gebruiker'];
}
?>

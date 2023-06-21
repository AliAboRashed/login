<?php
require_once 'functies.php';

// Controleer of de gebruiker is ingelogd
if (!isIngelogd()) {
    header("Location:index.php");
    exit();
}

// Haal de gebruikersgegevens op uit de sessie
$gebruiker = getGebruiker();

?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Pagina met wachtwoord</title>
</head>
<body>
    <h1>Welkom, <?php echo $gebruiker['naam']; ?>!</h1>
    <p>E-mail: <?php echo $gebruiker['email']; ?></p>
    <p>Wachtwoord: <?php echo $gebruiker['wachtwoord']; ?></p>
    <a href="index.php?uitloggen=1">Uitloggen</a>
</body>
</html>

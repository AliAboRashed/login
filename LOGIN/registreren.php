<?php
require_once 'functies.php';

// Database-inloggegevens
$dbHost = 'localhost';
$dbName = 'loginopdracht';
$dbUser = 'root';
$dbPass = '';

// Maak een PDO-verbinding
try {
    $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Fout bij het verbinden met de database: " . $e->getMessage());
}

// Controleer of er een registratiepoging is gedaan
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $naam = $_POST['naam'];
    $email = $_POST['email'];
    $wachtwoord = $_POST['wachtwoord'];

    // Controleer of de gebruiker al bestaat
    $query = "SELECT * FROM users WHERE email = :email";
    $statement = $pdo->prepare($query);
    $statement->bindParam(':email', $email);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Gebruiker bestaat al, toon een foutmelding
        $foutmelding = "E-mailadres is al in gebruik.";
    } else {
        // Voeg de nieuwe gebruiker toe aan de database
        $query = "INSERT INTO users (naam, email, wachtwoord) VALUES (:naam, :email, :wachtwoord)";
        $statement = $pdo->prepare($query);
        $statement->bindParam(':naam', $naam);
        $statement->bindParam(':email', $email);
        $statement->bindParam(':wachtwoord', $wachtwoord);
        $statement->execute();

        // Registratie is gelukt, stuur door naar de inlogpagina
        header("Location:index.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Registratiepagina</title>
</head>
<body>
    <h1>Registreren</h1>
    <?php if (isset($foutmelding)) { ?>
        <p><?php echo $foutmelding; ?></p>
    <?php } ?>
    <form method="POST" action="">
        <label for="naam">Naam:</label>
        <input type="text" id="naam" name="naam" required><br><br>

        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="wachtwoord">Wachtwoord:</label>
        <input type="password" id="wachtwoord" name="wachtwoord" required><br><br>

        <input type="submit" value="Registreren">
    </form>
    <br>
    <a href="index.php">Terug naar login pagina</a>
</body>
</html>

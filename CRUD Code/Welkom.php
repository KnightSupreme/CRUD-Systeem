<?php
//Auteur: Justin Mank
require_once('config.php');

// Controleer of de sessie is ingesteld voor gebruikers-ID
if (!isset($_SESSION['user_id']) && !isset($_SESSION['admin_id'])) {
    die("<a href=\"inloggen.php\">Niet ingelogd</a>");
}

// Als de sessie is ingesteld, haal het gebruikers-ID op
$user_id = $_SESSION["user_id"];

// Een instantie maken van de Config-klasse om de databaseverbinding op te halen
$db = new Database();
$conn = $db->getConnection();

// Query om gebruikersgegevens op te halen op basis van het gebruikers-ID
$sql = "SELECT * FROM klanten WHERE id = :user_id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt->execute();

// Gebruikersgegevens ophalen
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Controleren of gebruikersgegevens zijn opgehaald en deze weergeven
if ($user) {
    $welkomstbericht = "Welkom, " . $user['naam'] . "! Je bent ingelogd als gebruiker met ID: $user_id <br><br>";
    $gegevens = "Jij woont op de " . $user['adres'] . " en jouw favoriete kleur is " . $user['kleur'] . ".";

} else {
    $welkomstbericht = "Gebruikersgegevens niet gevonden.";
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welkom</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Welkom</h1>
        <p><?php echo $welkomstbericht; 
                 echo $gegevens
            ?>
        </p>
        <!-- Toon andere gebruikersgegevens hier, bijvoorbeeld e-mail, etc. -->
        <p>Email: <?php echo $user['email']; ?></p>
    
        <a href="uitloggen.php" class="btn">Uitloggen</a>
    </div>
</body>
</html>

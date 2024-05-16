<?php
// Auteur Justin
// Inclusief het bestand met de databaseverbinding
include 'config.php';

class Registration {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function registerUser($naam, $wachtwoord, $email, $adres, $kleur) {
        try {
            // Hash het wachtwoord voordat het wordt opgeslagen in de database
            $hashed_wachtwoord = password_hash($wachtwoord, PASSWORD_DEFAULT);

            // Standaard level instellen op 1
            $level = 1;

            // Voorbereide statement voor het invoegen van de klantgegevens
            $stmt = $this->conn->prepare("INSERT INTO klanten (naam, wachtwoord, email, adres, kleur, level) VALUES (:naam, :wachtwoord, :email, :adres, :kleur, :level)");
            $stmt->bindParam(':naam', $naam);
            $stmt->bindParam(':wachtwoord', $hashed_wachtwoord);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':adres', $adres);
            $stmt->bindParam(':kleur', $kleur);
            $stmt->bindParam(':level', $level);

            // Uitvoeren van de query
            $stmt->execute();
            header("Location: inloggen.php");
            echo "Registratie succesvol!";
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function closeConnection() {
        // Sluit de databaseverbinding
        $this->conn = null;
    }
}

// Maak een object van de database-klasse
$db = new Database();

// Haal de databaseverbinding op
$conn = $db->getConnection();

// Maak een object van de Registration class
$registration = new Registration($conn);

// Verwerking van het registratieformulier
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ontvang gegevens van het formulier
    $naam = $_POST['naam'];
    $wachtwoord = $_POST['wachtwoord'];
    $email = $_POST['email'];
    $adres = $_POST['adres'];
    $kleur = $_POST['kleur'];

    // Roep de methode aan om de gebruiker te registreren
    $registration->registerUser($naam, $wachtwoord, $email, $adres, $kleur);
}

// Sluit de databaseverbinding
$registration->closeConnection();
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Registratie</title>
</head>
<body>
    <h2>Registratieformulier</h2>
    <form method="POST" action="">
        <label for="naam">Naam:</label><br>
        <input type="text" id="naam" name="naam" required><br><br>

        <label for="wachtwoord">Wachtwoord:</label><br>
        <input type="password" id="wachtwoord" name="wachtwoord" required><br><br>

        <label for="email">E-mail:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="adres">Adres:</label><br>
        <input type="text" id="adres" name="adres" required><br><br>

        <label for="kleur">Kleur:</label><br>
        <input type="text" id="kleur" name="kleur" required><br><br>

        <input type="submit" value="Registreren" class="btn">
    </form>
</body>
</html>
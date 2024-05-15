<?php
// Inclusief het bestand met de databaseverbinding
include 'config.php';

class AdminRegistration {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function registerAdmin($adminnaam, $adminpass, $adminemail) {
        try {
            // Hash het wachtwoord voordat het wordt opgeslagen in de database
            $hashed_wachtwoord = password_hash($adminpass, PASSWORD_DEFAULT);

            // Standaard level instellen op 2 voor admins
            $level = 2;

            // Voorbereide statement voor het invoegen van de admingegevens
            $stmt = $this->conn->prepare("INSERT INTO admin (adminnaam, adminpass, adminemail, level) VALUES (:adminnaam, :adminpass, :adminemail, :level)");
            $stmt->bindParam(':adminnaam', $adminnaam);
            $stmt->bindParam(':adminpass', $hashed_wachtwoord);
            $stmt->bindParam(':adminemail', $adminemail);
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

// Maak een object van de AdminRegistration class
$adminRegistration = new AdminRegistration($conn);

// Verwerking van het registratieformulier
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ontvang gegevens van het formulier
    $adminnaam = $_POST['adminnaam'];
    $adminpass = $_POST['adminpass'];
    $adminemail = $_POST['adminemail'];

    // Roep de methode aan om de admin te registreren
    $adminRegistration->registerAdmin($adminnaam, $adminpass, $adminemail);
}

// Sluit de databaseverbinding
$adminRegistration->closeConnection();
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Admin Registratie</title>
</head>
<body>
    <h2>Admin Registratieformulier</h2>
    <form method="POST" action="">
        <label for="adminnaam">Admin Naam:</label><br>
        <input type="text" id="adminnaam" name="adminnaam" required><br><br>

        <label for="adminpass">Admin Wachtwoord:</label><br>
        <input type="password" id="adminpass" name="adminpass" required><br><br>

        <label for="adminemail">Admin E-mail:</label><br>
        <input type="email" id="adminemail" name="adminemail" required><br><br>

        <input type="submit" value="Registreer" class="btn">
    </form>
</body>
</html>

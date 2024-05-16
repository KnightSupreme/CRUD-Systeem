<?php
// Includen van de Config-klasse
require_once 'Config.php';

// Controleer of de klant-ID is meegegeven via het formulier
if (!isset($_POST['customer_id']) || empty($_POST['customer_id'])) {
    die("Klant-ID niet ontvangen.");
}

$customer_id = $_POST['customer_id'];

// Een instantie maken van de Config-klasse om de databaseverbinding op te halen
$db = new Database();
$conn = $db->getConnection();

// Controleer of het formulier is ingediend
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Haal de gegevens op die zijn ingediend via het formulier
    $naam = $_POST['naam'];
    $email = $_POST['email'];

    // Voorbeeldquery: Update klantgegevens
    $sql = "UPDATE klanten SET naam = :naam, email = :email WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':naam', $naam);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':id', $customer_id);

    // Voer de query uit
    if ($stmt->execute()) {
        header("Location: klantinfo.php");
        exit();
    } else {
        echo "Er is een fout opgetreden bij het bijwerken van klantgegevens.";
    }
}
?>

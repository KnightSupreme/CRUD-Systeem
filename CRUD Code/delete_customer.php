<?php
//Auteur: Justin Mank
// Includen van de Config-klasse
require_once 'Config.php';

if (!isset($_SESSION['admin_id'])) {
    die("<a href=\"inloggen.php\">Niet ingelogd</a>");
}

// Controleren of er een klant-ID is meegegeven via POST
if(isset($_POST['customer_id'])) {
    // Een instantie maken van de Config-klasse om de databaseverbinding op te halen
    $db = new Database();
    $conn = $db->getConnection();

    // Voorbereiden en uitvoeren van de delete query
    $customer_id = $_POST['customer_id'];
    $sql = "DELETE FROM klanten WHERE id = :customer_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':customer_id', $customer_id, PDO::PARAM_INT);
    $stmt->execute();

    // Controleren of de query succesvol was
    if($stmt->rowCount() > 0) {
        header("Location: klantinfo.php");
        exit();

    } else {
        echo "Er is een fout opgetreden bij het verwijderen van de klant.";
    }
} else {
    echo "Geen klant-ID meegegeven.";
}
?>

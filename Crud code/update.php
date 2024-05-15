<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klantgegevens bijwerken</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Klantgegevens bijwerken</h1>
    <form method="POST" action="update_customer.php">
        <label for="customer_id">Selecteer klant:</label><br>
        <select name="customer_id" id="customer_id">
            <?php
            // Includen van de Config-klasse
            require_once 'Config.php';

            // Een instantie maken van de Config-klasse om de databaseverbinding op te halen
            $db = new Database();
            $conn = $db->getConnection();

            // Query om klantgegevens op te halen
            $sql = "SELECT id, naam FROM klanten";
            $stmt = $conn->query($sql); // $conn is de PDO-verbinding

            // Controleren of er resultaten zijn en deze weergeven in de dropdown
            if ($stmt->rowCount() > 0) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value='" . $row["id"] . "'>" . $row["id"] . " - " . $row["naam"] . "</option>";
                }
            } else {
                echo "<option value=''>Geen klantgegevens gevonden</option>";
            }
            ?>
        </select><br><br>
          <?php
        // Zet de waarden van naam en email in het formulier
        if ($stmt->rowCount() > 0) {
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            echo "<label for='naam'>Naam:</label><br>";
            echo "<input type='text' id='naam' name='naam' value='" . ($row["naam"] ?? "") . "'><br>";
            echo "<label for='email'>Email:</label><br>";
            echo "<input type='email' id='email' name='email' value='" . ($row["email"] ?? "") . "'><br><br>";
        }        
        ?>
        <button type="submit">Bijwerken</button>
    </form>
</body>
</html>

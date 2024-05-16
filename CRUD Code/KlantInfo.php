<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klantgegevens</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    // Includen van de Config-klasse
    require_once 'Config.php';

    if (!isset($_SESSION['admin_id'])) {
        die("<a href=\"inloggen.php\">Niet ingelogd</a>");
    }

    // Een instantie maken van de Config-klasse om de databaseverbinding op te halen
    $db= new Database();
    $conn = $db->getConnection();

    // Query om klantgegevens op te halen
    $sql = "SELECT id, naam, email FROM klanten";
    $stmt = $conn->query($sql); // $conn is de PDO-verbinding

    // Controleren of er resultaten zijn en deze weergeven in de tabel
    echo '<h1>Klantgegevens</h1>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Naam</th>
            <th>Email</th>
            <th>Bijwerken</th>
            <th>Verwijder</th>
        </tr>';

    if ($stmt->rowCount() > 0) {
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($rows as $row) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["naam"] . "</td>";
            echo "<td>" . $row["email"] .  "</td>";
            echo "<td>
                     <a href='update.php'>Update</a>
                  </td>";
            echo "<td>
                    <form action='delete_customer.php' method='POST'>
                        <input type='hidden' name='customer_id' value='" . $row["id"] . "'>
                        <button type='submit'>Delete</button>
                    </form>
                  </td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='5'>Geen klantgegevens gevonden</td></tr>";
    }
    ?>
    </table>

    <p><a href="Uitloggen.php" class="btn">Uitloggen</a></p>
</body>
</html>

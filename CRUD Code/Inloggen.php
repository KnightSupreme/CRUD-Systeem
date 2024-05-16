<?php
//Auteur: Justin Mank
require_once('config.php');

class Login {
    private $db;
    //Maakt nieuw object van Login
    public function __construct() {
        $this->db = new Database();
    }

    public function login($naam, $wachtwoord) {
        $conn = $this->db->getConnection();
        // Zoek in de tabel klanten
        $stmt = $conn->prepare("SELECT id, wachtwoord FROM klanten WHERE naam = :naam");
        $stmt->bindParam(':naam', $naam);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

       // Zoek in de tabel adminn
        $stmt_admin = $conn->prepare("SELECT id, adminpass FROM admin WHERE adminnaam = :naam");
        $stmt_admin->bindParam(':naam', $naam);
        $stmt_admin->execute();
        $result_admin = $stmt_admin->fetch(PDO::FETCH_ASSOC);

    
        if ($result && password_verify($wachtwoord, $result['wachtwoord'])) {
            //Klant is ingelogd
            $_SESSION["user_id"] = $result['id'];
            header("Location: welkom.php");
            exit();
            
        } elseif ($result_admin && password_verify($wachtwoord, $result_admin['adminpass'])) {
            // Admin is ingelogd
            $_SESSION["admin_id"] = $result_admin['id'];
            header("Location: klantinfo.php");
            exit();
            
        } else {
            $foutmelding = "Ongeldige naam of wachtwoord.";
        }
    }
}

// Controleer of het formulier is ingediend
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = new Login();
    $login->login($_POST["naam"], $_POST["wachtwoord"]);
}
?>

<!DOCTYPE html> 
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inloggen</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Inloggen</h1>
        <?php if (isset($foutmelding)) { echo '<p class="fout">' . $foutmelding . '</p>'; } ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="text" name="naam" placeholder="naam" required><br>
            <input type="password" name="wachtwoord" placeholder="Wachtwoord" required><br><br>
            <button type="submit" class="btn">Inloggen</button>
        </form>
        <br><br>
        <a href="Registratie.php">Bent u nog geen klant? Maak hier dan een account aan</a><br><br>
        <a href="admin_registratie.php">Maak hier een admin aan</a>

        <h4>Ga hier terug naar home</h4>
        <a href="Home" class="btn">Home</a>
    </div>
</body>
</html>


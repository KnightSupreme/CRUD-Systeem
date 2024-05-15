<?php
session_start();
// Vernietig alle sessievariabelen
session_destroy();
// Stuur de gebruiker terug naar de inlogpagina
header("Location: Inloggen.php");
exit;
?>

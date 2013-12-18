<?php

session_start();

// Här droppar vi alla session och skickar tillbaka användaren till startsidan.

unset($_SESSION['user']);
unset($_SESSION['loggedin']);
unset($_SESSION['newUser']);

header("Location: index.php");

?>

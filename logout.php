<?php

session_start();

// H�r droppar vi alla session och skickar tillbaka anv�ndaren till startsidan.

unset($_SESSION['user']);
unset($_SESSION['loggedin']);
unset($_SESSION['newUser']);

header("Location: index.php");

?>

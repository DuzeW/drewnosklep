<?php

session_start();
session_unset();
setcookie("email", "1", time() + (86400 * 30));
setcookie("password", "", time() + (86400 * 30));
$_SESSION['logged_in'] = false;
session_destroy();
header("Location: ../index.php");
exit();
?>

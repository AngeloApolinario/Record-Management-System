<?php
session_start();

$_SESSION = array();

session_destroy();

header("Location: http://localhost/Record-Management-System-second_revision/login.php");
exit();
?>
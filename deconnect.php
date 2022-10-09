<?php 
#Il faut mettre systématiquement un session_start avant un session_destroy

session_start();
session_destroy();

header('Location: login.php');

?>
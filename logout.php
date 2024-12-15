<?php
session_start();
session_destroy();  // Clear semua data 
header("Location: login.php");  // Redirect ke login page
exit;
?>

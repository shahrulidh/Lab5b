<?php

session_start();

// Check jika user login dengan matric, jika tak redirect ke login.php
if (!isset($_SESSION['matric'])) {
    header("Location: login.php");
    exit();
}

// Ambil matric dari URL yang perlu dipadam
$matric = $_GET['matric'];

// Redirect ke database
$conn = new mysqli('localhost', 'root', '', 'Lab_5b');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error); // Jika tidak berjaya
}

// SQL query untuk padam user berdasarkan matric yang diterima
$sql = "DELETE FROM users WHERE matric = '$matric'";
// Check jika berjaya
if ($conn->query($sql) === TRUE) {
    // Jika berjaya dan redirect ke read.php selepas 2 saat
    echo "<script>
                alert('User deleted successfully!'); 
                window.location.href = 'read.php';
              </script>";    
} else {
    echo "Error deleting user: " . $conn->error; // Jika tidak berjaya
}

$conn->close();
?>

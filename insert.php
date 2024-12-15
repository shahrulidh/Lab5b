<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $matric = $_POST['matric']; 
    $name = $_POST['name'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password
    $role = $_POST['role'];

    //Redirect ke database
    $conn = new mysqli('localhost', 'root', '', 'Lab_5b');
    if ($conn->connect_error) { 
        die("Connection failed: " . $conn->connect_error); // Jika connection tidak berjaya
    }

    // SQL untuk masukkan user data baru ke dalam table 'users'
    $sql = "INSERT INTO users (matric, name, password, role) VALUES ('$matric', '$name', '$password', '$role')";
    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!<br>"; // Jika berjaya
        echo "Click <a href='login.php'><u>here</u></a> to login."; // Button login
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error; // Jika tidak berjaya
    }

    $conn->close();
}
?>

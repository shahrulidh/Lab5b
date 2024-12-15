<?php

session_start();  // Start session untuk simpan info user

// Input dari login
$matric = $_POST['matric'];
$password = $_POST['password'];

// Connection ke database
$conn = new mysqli('localhost', 'root', '', 'Lab_5b');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query untuk dapatkan user data by matric
$sql = "SELECT * FROM users WHERE matric = '$matric'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc(); // Dapat user info dari result

    // Check password
    if (password_verify($password, $user['password'])) {  // Assume password is hashed
        // Login success : Start session
        $_SESSION['loggedin'] = true;
        $_SESSION['matric'] = $user['matric'];
        $_SESSION['name'] = $user['name'];

        // Redirect ke read.php page
        header("Location: read.php");
        exit();
    } else {
        // Gagal login
        echo "Invalid username or password, try <a href='login.php'><u>login</u></a> again.";
    }
} else {
    // Gagal login: Matric not found
    echo "Invalid username or password, try <a href='login.php'><u>login</u></a> again.";
}

$conn->close();
?>

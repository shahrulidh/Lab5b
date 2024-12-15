<?php

session_start();

// Check jika user login dengan matric, jika tak redirect ke login.php
if (!isset($_SESSION['matric'])) {
    header("Location: login.php");
    exit();
}

// Ambil matric dari URL
$matric = $_GET['matric']; // Matric user yang akan dikemas kini

// Connection ke database
$conn = new mysqli('localhost', 'root', '', 'Lab_5b');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error); // Jika connection tidak berjaya
}

// Ambil data user dari database
$sql = "SELECT * FROM users WHERE matric = '$matric'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

// Kemas kini data user bila form dihantar
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name']; // Nama baru dari form
    $role = $_POST['role']; // Role baru dari form

    // Kemas kini rekod user dalam database
    $update_sql = "UPDATE users SET name = '$name', role = '$role' WHERE matric = '$matric'";
    if ($conn->query($update_sql) === TRUE) {
        // Mesej berjaya dan redirect ke read.php selepas 2 saat
        echo "<script>
        alert('User updated successfully!');
        window.location.href = 'read.php';
      </script>";
    } else {
        echo "Error updating user: " . $conn->error; // Jika tidak berjaya
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update User</title>
</head>
<body>
    <h2>Update User</h2>
    <form action="update_form.php?matric=<?php echo $matric; ?>" method="POST">
        <label for="matric">Matric:</label>
        <input type="text" name="matric" value="<?php echo $user['matric']; ?>" readonly><br><!-- Kemaskini Matric Number -->

        <label for="name">Name:</label>
        <input type="text" name="name" value="<?php echo $user['name']; ?>"><br><!-- kemaskini Nama -->

        <label for="role">Access Level:</label>
        <!-- Dropdown untuk role -->
        <!-- kemaskini role -->
        <select name="role" id="role" required>
        <option value="lecturer" <?php if ($user['role'] == 'lecturer') echo 'selected'; ?>>Lecturer</option>
        <option value="student" <?php if ($user['role'] == 'student') echo 'selected'; ?>>Student</option>
        </select><br><br>

        <input type="submit" value="Update"> <!-- Submit button -->
        <a href="read.php">Cancel</a><!-- Cancel button untuk Kemaskini-->
    </form>
</body>
</html>

<?php
$conn->close();
?>

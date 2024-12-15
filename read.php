<?php
session_start();

// Check jika user sudah login
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

// Connection ke database
$conn = new mysqli('localhost', 'root', '', 'Lab_5b');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ambil data user dari database
$sql = "SELECT matric, name, role FROM users";
$result = $conn->query($sql);

// Display table users
echo "<table border='1'>
    <tr>
        <th>Matric</th>
        <th>Name</th>
        <th>Role</th>
    </tr>";

if ($result->num_rows > 0) {
    // Loop untuk display setiap user dalam table
    while($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>" . $row["matric"]. "</td>
            <td>" . $row["name"]. "</td>
            <td>" . $row["role"]. "</td>
            <td>
                <a href='update_form.php?matric=" . $row["matric"] . "'>Update</a> |
                <a href='delete.php?matric=" . $row["matric"] . "'>Delete</a>
            </td>
        </tr>";
    }
} else {
    // Jika tiada user data
    echo "<tr><td colspan='4'>No results found.</td></tr>";
}
echo "</table>";

// Logout
echo "<br><a href='logout.php'>Logout</a>";

$conn->close();
?>

<?php

ini_set('display_errors', 0);  // Turn off error display
error_reporting(0);            // Do not report errors

session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header("Location: read.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <!-- Dispaly error mesej jika ada parameter 'error' dalam URL -->
    <?php if (isset($_GET['error'])): ?>
        <p style="color:red;"><?php echo htmlspecialchars($_GET['error']); ?></p>
    <?php endif; ?>
    <form action="authenticate.php" method="POST">
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <div>
            <label for="matric">Matric:</label><!-- Masukkan Matric Number -->
            <input type="text" id="matric" name="matric" required>
        </div>
        <br>
        <div>
            <label for="password">Password:</label> <!-- Masukkan Password -->
            <input type="password" id="password" name="password" required>
        </div>
        <br>
        <div>
            <input type="submit" value="Login"> <!-- Login button -->
        </div>
    </form>
    <!--Daftar Jika belum mempunyai akaun -->
    <a href="register_form.php"><u>Register</u></a> here if you have not.
</body>
</html>

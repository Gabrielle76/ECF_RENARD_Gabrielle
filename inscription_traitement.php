<?php
// Load configuration
require_once 'config.php';

// Check if form has been submitted
if (!empty($_POST['EmailUsers']) && !empty($_POST['password']) && !empty($_POST['password_retype'])) {
    // Sanitize input
    $email = htmlspecialchars($_POST['EmailUsers']);
    $password = htmlspecialchars($_POST['password']);
    $password_retype = htmlspecialchars($_POST['password_retype']);

    // Connect to database and prepare SQL statement
    try {
        $db = new PDO($dsn, $username, $password);
        $stmt = $db->prepare('SELECT EmailUsers, password FROM utilisateur.users WHERE EmailUsers = ?');
        $stmt->execute([$email]);
        $data = $stmt->fetch();
        $row = $stmt->rowCount();

        // Check if user already exists
        if ($row == 0) {
            // Check email length and format
            if (strlen($email) <= 100 && filter_var($email, FILTER_VALIDATE_EMAIL)) {
                // Check if passwords match
                if ($password === $password_retype) {

                    // Insert new user into database
                    $insert = $db->prepare('INSERT INTO utilisateur(EmailUsers, password) VALUES(:EmailUsers, :password)');
                    $insert->execute([
                        'EmailUsers' => $email,
                        'password' => $password,
                    ]);

                    // Redirect to success page
                    header('Location: landing.php');
                } else {
                    // Passwords do not match
                    header('Location: inscription.php?reg_err=password');
                    die();
                }
            } else {
                // Email length or format is invalid
                header('Location: inscription.php?reg_err=EmailUsers_length');
                die();
            }
        } else {
            // User already exists
            header('Location: inscription.php?reg_err=already');
            die();
        }
    } catch (PDOException $e) {
        // Display error message
        echo 'Error: ' . $e->getMessage();
        die();
    }
}

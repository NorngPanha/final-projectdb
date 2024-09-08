<?php
session_start(); // Start the session at the beginning of the script
include 'db_config.php'; // Include your database configuration file

// Check if POST request and necessary fields are set
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    // Prepare SQL statement to fetch user information
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashed_password);
        $stmt->fetch();

        // Verify the password
        if (password_verify($password, $hashed_password)) {
            // Set session variables
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            $_SESSION['date'] = date('Y-m-d');

            // Record login event
            $login_stmt = $conn->prepare("INSERT INTO login_records (user_id, username) VALUES (?, ?)");
            $login_stmt->bind_param("is", $id, $username);
            $login_stmt->execute();
            $login_stmt->close();

            // Redirect to welcome page
            header("Location: welcome.php");
            exit();
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "Username not found.";
    }

    $stmt->close();
} else {
    echo "Invalid request.";
}

$conn->close();
?>

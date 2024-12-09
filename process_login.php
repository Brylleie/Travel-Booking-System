<?php
session_start();

// Database connection
$conn = new mysqli("localhost", "root", "", "booking_system");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get and sanitize input
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Prepare statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        // Verify password
        if (password_verify($password, $user['password'])) {
            // Set session variables
            $_SESSION['username'] = htmlspecialchars($user['username'], ENT_QUOTES, 'UTF-8'); // Sanitize output
            $_SESSION['user_id'] = $user['id'];  // Store user_id in session
            
            header("Location: index.php");  // Redirect to home page after successful login
            exit;
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "User not found.";
    }

    // Close statement and connection
    $stmt->close();
}

// Close connection
$conn->close();
?>
<?php
session_start(); // Start the session

$conn = new mysqli("localhost", "root", "", "booking_system");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize input
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    
    // Basic validation
    if (empty($username) || empty($password)) {
        die("Username and password are required.");
    }

    // Check if username already exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }
    
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "Username already taken. Please choose another.";
        $stmt->close();
        exit;
    }
    
    // Close statement for checking existing username
    $stmt->close();

    // Prepare statement for inserting new user
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Bind parameters
    $stmt->bind_param("ss", $username, $hashedPassword);  

    // Execute statement
    if ($stmt->execute()) {
        $_SESSION['username'] = htmlspecialchars($username, ENT_QUOTES, 'UTF-8'); // Store username in session
        header("Location: login.php");
        exit;
    } else {
        echo "Error: " . htmlspecialchars($stmt->error);
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>
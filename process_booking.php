<?php
session_start(); // Start the session at the top of the file

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

$host = 'localhost';      
$username = 'root';       
$password = '';           
$dbname = 'booking_system';  

$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if all required fields are set
    if (isset($_POST['name'], $_POST['email'], $_POST['destination'], $_POST['travel_date'], $_POST['num_travelers'], $_POST['session_type'])) {
        
        $user_id = $_SESSION['user_id'];  
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $destination = trim($_POST['destination']);
        $travel_date = $_POST['travel_date'];
        $num_travelers = (int)$_POST['num_travelers']; // Cast to integer
        $special_requests = trim($_POST['special_requests'] ?? '');
        $session_type = $_POST['session_type'];

        // Validate required fields
        if (!empty($name) && !empty($email) && !empty($destination) && !empty($travel_date) && !empty($num_travelers) && !empty($session_type)) {

            // Store booking details in session
            $_SESSION['booking_details'] = [
                'name' => $name,
                'email' => $email,
                'destination' => $destination,
                'travel_date' => $travel_date,
                'num_travelers' => $num_travelers,
                'session_type' => $session_type,
                'special_requests' => $special_requests,
            ];

            // Prepare and bind
            $stmt = $conn->prepare("INSERT INTO bookings (user_id, name, email, destination, travel_date, num_travelers, special_requests, session_type) 
                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("issssiss", $user_id, $name, $email, $destination, $travel_date, $num_travelers, $special_requests, $session_type);

            // Execute statement
            if ($stmt->execute()) {
                header("Location: confirmation.php");
                exit(); 
            } else {
                echo "Error: " . htmlspecialchars($stmt->error);
            }

            // Close statement
            $stmt->close();
        } else {
            echo "Please fill in all required fields.";
        }
    } else {
        echo "Missing form data.";
    }
}
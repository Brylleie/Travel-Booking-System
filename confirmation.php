<?php
session_start();
$booking_details = $_SESSION['booking_details'] ?? []; // Use null coalescing operator for safety
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="confirmation-container">
        <h1>Booking Confirmation</h1>
        <p>Thank you for your booking! Your trip details are as follows:</p>
        
        <ul>
            <li><strong>Name:</strong> <?php echo htmlspecialchars($booking_details['name'] ?? 'N/A'); ?></li>
            <li><strong>Email:</strong> <?php echo htmlspecialchars($booking_details['email'] ?? 'N/A'); ?></li>
            <li><strong>Destination:</strong> <?php echo htmlspecialchars($booking_details['destination'] ?? 'N/A'); ?></li>
            <li><strong>Travel Date:</strong> <?php echo htmlspecialchars($booking_details['travel_date'] ?? 'N/A'); ?></li>
            <li><strong>Number of Travelers:</strong> <?php echo htmlspecialchars($booking_details['num_travelers'] ?? 'N/A'); ?></li>
            <li><strong>Session Type:</strong> <?php echo htmlspecialchars($booking_details['session_type'] ?? 'N/A'); ?></li>
            <li><strong>Special Requests:</strong> <?php echo htmlspecialchars($booking_details['special_requests'] ?? 'N/A'); ?></li>
        </ul>

        <a href="booking.php" class="back-btn">Book Another Trip</a>
        <a href="index.php" class="index-btn">Logout</a>
    </div>

    <footer>
        <p>&copy; 2024 Travel Booking System. All rights reserved.</p>
    </footer>
</body>
</html>
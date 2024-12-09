<?php
session_start(); 

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Your Adventure</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Book Your Adventure</h1>
        <p>Welcome, <?php echo htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8'); ?>! Please fill in the details below to book your trip.</p>
    </header>

    <div class="booking-container">
        <h2>Book a Session</h2>
        <p class="welcome-text">Please fill in the details below to book your session.</p>

        <form action="process_booking.php" method="POST">
            <label for="name">Full Name</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>

            <label for="destination">Destination</label>
            <input type="text" id="destination" name="destination" required>

            <label for="travel_date">Travel Date</label>
            <input type="date" id="travel_date" name="travel_date" required>

            <label for="num_travelers">Number of Travelers</label>
            <input type="number" id="num_travelers" name="num_travelers" required min="1" max="10">

            <label for="special_requests">Special Requests</label>
            <textarea id="special_requests" name="special_requests"></textarea>

            <label for="session_type">Session Type</label>
            <select id="session_type" name="session_type" required>
                <option value="" disabled selected>Select a session type</option>
                <option value="standard">Standard</option>
                <option value="premium">Premium</option>
            </select>

            <button type="submit" class="book-btn">Book Now</button>
        </form>

    </div> <!-- End of container -->

    <footer>
        <p>© 2024 Travel Booking System. All rights reserved.</p>
    </footer>
</body>
</html>
<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage - Travel Booking System</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Welcome to Our Travel Booking System</h1>
        <p>Your one-stop solution to book amazing trips and adventures!</p>
    </header>

    <main class="container">
        <?php if (isset($_SESSION['username'])): ?>
            <section class="welcome-text">
                <h2>Hello, <?php echo htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8'); ?>!</h2>
                <p>We're excited to have you back. Ready to book your next adventure?</p>
                <div class="button-container">
                    <a href="booking.php" class="button book-now">Book Now</a>
                    <a href="logout.php" class="button logout">Log Out</a>
                </div>
            </section>
        <?php else: ?>
            <section class="login-register">
                <p>To get started, please log in or register a new account.</p>
                    <a href="login.php" class="button login">Login</a>
                    <a href="register.php" class="button register">Register</a>
                </div>
            </section>
        <?php endif; ?>
    </main>

    <footer>
        <p>© 2024 Travel Booking System. All rights reserved.</p>
        <p><a href="privacy-policy.php">Privacy Policy</a> | <a href="terms.php">Terms of Service</a></p>
    </footer>
</body>
</html>
<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: signin.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambodia's Provinces</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .container-1 {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
        }
        .profile-info {
            margin-bottom: 20px;
        }
        .profile-info p {
            margin: 5px 0;
            font-size: 18px;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <div class="container">
                <div class="logo" style="text-align: center;">
                    <img src="Image/angkor 2.jpg" alt="logo" style="width: 200px; height: 120px;">
                    <h5>ខេត្ត ក្រុងនៃព្រះរាជាណាចក្រកម្ពុជា</h5>
                </div>
                <ul class="nav-links">
                    <li><a href="home.html">Home</a></li>
                    <li><a href="about.html">About</a></li>
                    <li><a href="notfound.html">Services</a></li>
                    <li class="active"><a href="signin.html">Profile</a></li>
                </ul>
                <div class="search-container">
                    <input type="text" id="searchInput" placeholder="Search...">
                    <button type="submit" id="searchButton"><i class="fas fa-search"></i></button>
                </div>
                <div class="menu-toggle">
                    <span class="bar">kandal</span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </div>
            </div>
        </nav>
    </header><br>

    <header class="container-1">
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
    </header>

    <section class="welcome-section">
        <div class="container-1">
            <p><strong>Username:</strong> <?php echo htmlspecialchars($_SESSION['username']); ?></p>
            <p><strong>Email:</strong> <?php echo isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : 'Not provided'; ?></p>
            <p><strong>Member Since:</strong> <?php 
                if (isset($_SESSION['date'])) {
                    // Assuming 'date' is stored in YYYY-MM-DD format; you can format it as needed
                    echo htmlspecialchars(date('F j, Y', strtotime($_SESSION['date']))); 
                } else {
                    echo 'Not available'; 
                }
            ?></p>
            
            <a href="logout.php" class="btn">Log Out</a>
        </div>
    </section>


    <footer>
        <div class="footer-content">
            <div class="footer-left">
                <h3>About Us</h3>
                <p>We are dedicated to providing top-notch services and products. Our team works hard to ensure your satisfaction.</p>
            </div>
            <div class="footer-center">
                <h3>Contact Information</h3>
                <p><strong>Address:</strong> Phnom Penh, CAMBODIA</p>
                <p><strong>Email:</strong> Norngpanha2004@gmail.com</p>
                <p><strong>Phone:</strong> +855 10841320</p>
            </div>
            <div class="footer-right">
                <h3>Follow Us</h3>
                <ul class="socials">
                    <li><a href="https://facebook.com" target="_blank">Facebook</a></li>
                    <li><a href="https://twitter.com" target="_blank">Twitter</a></li>
                    <li><a href="https://instagram.com" target="_blank">Instagram</a></li>
                    <li><a href="https://linkedin.com" target="_blank">LinkedIn</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>All rights reserved. &copy; 2024 My Website.</p>
        </div>
    </footer>

    <script src="js/script.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/search.js"></script>
</body>
</html>

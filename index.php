<!-- index.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ឈ្មោះខណ្ឌ/សង្កាត់ក្នុងរាជធានីភ្នំពេញ</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>

        .result-box { 
            margin-top: 20px;
            padding: 15px;
            border-radius: 8px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            text-align: left;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            transition: opacity 0.4s ease-in-out;
            opacity: 0;
        }

        .result-box.show {
            opacity: 1;
        }

        .result-box h2 {
            font-size: 20px;
            margin-bottom: 15px;
            color: #333;
        }

        .result-box ul {
            list-style-type: none;
            padding-left: 0;
        }

        .result-box ul li {
            background-color: #e9ecef;
            color: #333;
            margin-bottom: 5px;
            padding: 10px;
            border-radius: 5px;
            transition: transform 0.2s ease;
        }

        .result-box ul li:hover {
            transform: translateX(5px);
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
                    <li  class="active"><a href="about.html">About</a></li>
                    <li><a href="notfound.html">Services</a></li>
                    <li><a href="signin.html">Sign In</a></li>
                </ul>
                <div id="searchContainer" class="search-container">
                    <input type="text" id="searchInput" name="location" placeholder="Search..." autocomplete="off" required>
                    <button type="button" id="searchButton"><i class="fas fa-search"></i></button>
                </div>

            </div>
        </nav>
    </header>

        <!-- Result Box -->
        <div class="result-box <?php if ($_SERVER["REQUEST_METHOD"] == "POST") echo 'show'; ?>">
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Database connection
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "geographytest";

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Get the location from the form
                $location = $_POST['location'];

                // Initialize variables for the statements
                $stmt_country = $stmt_province = null;

                // First, check if the input is a country
                $sql_country = "SELECT province_name FROM provinces WHERE country_name = ?";
                $stmt_country = $conn->prepare($sql_country);
                $stmt_country->bind_param("s", $location);
                $stmt_country->execute();
                $result_country = $stmt_country->get_result();

                if ($result_country->num_rows > 0) {
                    echo "<h2>ឈ្មោះសង្កាត់ក្នុង $location:</h2>";
                    echo "<ul>";
                    while ($row = $result_country->fetch_assoc()) {
                        echo "<li>" . $row['province_name'] . "</li>";
                    }
                    echo "</ul>";
                } else {
                    // If not a country, check if the input is a province
                    $sql_province = "SELECT country_name FROM provinces WHERE province_name = ?";
                    $stmt_province = $conn->prepare($sql_province);
                    $stmt_province->bind_param("s", $location);
                    $stmt_province->execute();
                    $result_province = $stmt_province->get_result();

                    if ($result_province->num_rows > 0) {
                        $row = $result_province->fetch_assoc();
                        echo "<h2>$location ស្ថិតនៅក្នង" . $row['country_name'] . ".</h2>";
                    } else {
                        echo "រកមិនឃើញឈ្មោះ $location.";
                    }
                }

                // Close statements and connection
                if ($stmt_country) $stmt_country->close();
                if ($stmt_province) $stmt_province->close();
                $conn->close();
            }
            ?>
        </div>
    </div>

    <!-- Footer Section -->
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
            <p>All rights reserved. &copy; 2024 My Website. </p>
        </div>
    </footer>

    <script src="js/script.js"></script>
    <script src="js/bootstrap.js"></script>
    <!-- <script src="js/search.js"></script> -->
    <script>
    function submitSearch() {
        // Get the value from the input field
        var query = document.getElementById('searchInput').value;

        // Create a new form dynamically
        var form = document.createElement('form');
        form.method = 'POST';
        form.action = 'index.php';

        // Create a hidden input to store the search query
        var input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'location';
        input.value = query;
        form.appendChild(input);

        // Append the form to the body and submit it
        document.body.appendChild(form);
        form.submit();
    }

    // Handle button click
    document.getElementById('searchButton').addEventListener('click', function() {
        submitSearch();
    });

    // Handle Enter key press in the input field
    document.getElementById('searchInput').addEventListener('keypress', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault(); // Prevent form submission if it's within an actual form
            submitSearch();
        }
    });
    </script>
</body>
</html>

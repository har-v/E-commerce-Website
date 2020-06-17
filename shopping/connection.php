<?php
function pdo_connect_mysql() {
    // Update the details below with your MySQL details
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'shoppingcart';
    try {
        return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
    } catch (PDOException $exception) {
        // If there is an error with the connection, stop the script and display the error.
        die ('Failed to connect to database!');
    }
}

// Template header, feel free to customize this
function template_header($title) {
    // Get the amount of items in the shopping cart, this will be displayed in the header.
    $num_items_in_cart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
    echo <<<EOT

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://fonts.googleapis.com/css?family=Fjalla+One&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Heebo:100&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="length">
<html>
	<head>
		<meta charset="utf-8">
		<title>$title</title>
		<link href="../stylesheets/style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body>
        <section class="intro">
    <div id="menuArea">
        <input type="checkbox" id="menuToggle" style="display: none;"></input>
        <div class="logo">
            VNTG
        </div>
        <label for="menuToggle" class="menuOpen">
            <div class="cart">
                    <a href="index.php?page=cart">
                    
						CART
						(<span>$num_items_in_cart</span>)
					</a>
                </div>
            <div class="open"></div>
        </label>
        <div class="menu menuEffects" style="z-index: 2;">
            <label for="menuToggle"></label>
            <div class="menuContent">
                <div class="logo" style="color:black;">
                    VNTG
                </div>
                <table class="table table-borderless">
                    <tbody>
                    <tr>
                        <td><a href="index.php?page=products" style="color: black; text-decoration: none;">Products</a></td>
                        <td><a href="index.php?page=blog" style="color: black; text-decoration: none;">Blog</a></td>
                    </tr>
                    <tr>
                        <td><a href="index.php?page=login" style="color: black; text-decoration: none;">Account</a></td>
                        <td><a href="index.php?page=contactUs" style="color: black; text-decoration: none;">Contact Us</a></td>
                    </tr>
                    <tr>
                        <td><a href="index.php?page=homepage" style="color: black; text-decoration: none;">Home</a></td>
                        <td><a href="index.php?page=faq" style="color: black; text-decoration: none;">FAQs</a></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
EOT;
}
// Template footer
function template_footer() {
    echo <<<EOT
       
        <div class="footer">
    <div id="button">↑</div>
    <div id="container">
        <div id="cont">
            <div class="footer_center">
                <table class="table4">
                    <tr>
                        <th>ABOUT US</th>
                        <th>HELP & INFORMATION</th>

                    </tr>
                    <tr>
                        <td rowspan="4">Lorem ipsum dolor sit amet, consetetur sadipscing<br>
                            elitr, sed diam nonumy eirmod tempor invidunt ut labore et </td>
                        <td><a href="index.php?page=faq" class="footer-links">FAQS</a></td>
                    </tr>
                    <tr>
                        <td><a href="index.php?page=faq" class="footer-links">Delivery and Returns</a></td>
                    </tr>
                    <tr>
                        <td><a href="index.php?page=contactus" class="footer-links">Contact Us</a></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
        <script src="script.js"></script>
    </body>
</html>
EOT;
}
?>








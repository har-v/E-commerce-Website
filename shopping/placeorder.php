<?php
unset($_SESSION["cart"]);
?>

<?=template_header('Place Order')?>
<link rel="stylesheet" href="../stylesheets/placeorder.css">
    <div class="placeorder content-wrapper">
        <h1>ORDER PLACED</h1>
        <p>Your order has been placed at <?php
            echo date("h:i A");?> on <?php
            echo(date("F d, Y"));
            ?>.</p>
        <br><br><br>
        <p class="text">Thank you for shopping with us.</p>
    </div>

<?=template_footer()?>


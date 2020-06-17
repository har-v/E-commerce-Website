<?php
//checks the id parameter is specified in the URL
if (isset($_GET['id'])) {
    // statement is prepared and executed in order to prevent sql injection
    $stmt = $pdo->prepare('SELECT * FROM products WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    //retrieves the product from the database and displays teh information as an array
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    // checks if the product exists
    if (!$product) {
        //displays error message if the product doesn't exist
        die ('Product does not exist!');
    }
} else {
    //displays error message if the product doesn't exist
    die ('Product does not exist!');
}

?>
<?=template_header('Product')?>
<link rel="stylesheet" href="../stylesheets/product.css">
<div class="container">
        <div class="pro-img">
            <img src="../images/products/<?=$product['img']?>" width="auto" height="500" alt="<?=$product['name']?>">
        </div>
    </div>

    <table class="table3">
        <tr>
            <th><?=$product['name']?></th>
        </tr>
        <tr>
            <td>&pound;<?=$product['price']?>
                <p></p></td>
        </tr>
        <tr>
            <td>is simply dummy text of the printing and typesetting industry.<br>
                Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,<br>
                when an unknown printer took a galley of type and scrambled it to make a <br>
                type specimen book.<p></p><br></td>
        </tr>
        <tr>
            <td>
                <div class="colour">Colour: <?=$product['colour']?></div>
            </td>
        </tr>
        <tr>
            <td>
                <form action="index.php?page=cart" method="post">
                    <input type="number" name="quantity" value="Quantity" min="1" max="<?=$product['quantity']?>" placeholder="Quantity" required style="outline: none;">
                    <input type="hidden" name="product_id" value="<?=$product['id']?>">
                    <input type="submit" value="Add To Cart">
                </form>
            </td>
        </tr>
    </table>

    <button class="accordion"style="bottom:30px; position: relative;">&nbsp;&nbsp;PRODUCT INFORMATION</button>
    <div class="panel" style="bottom: 40px;">
        <ul style="list-style-type:none;">
            <li>Lorem ipsum dolor sit amet, consetetur sadipscing elitr,</li>
            <li>Lorem ipsum dolor sit amet, consetetur </li>
        </ul>
    </div>

    <button class="accordion" style="bottom: 55px; position: relative;">&nbsp;&nbsp;COMPOSITION & CARE</button>
    <div class="panel" style="bottom: 65px;">
        <ul style="list-style-type:none;">
            <li>Lorem ipsum dolor sit amet, consetetur sadipscing elitr,</li>
            <li>Lorem ipsum dolor sit amet, consetetur </li>
        </ul>
    </div>
    <script>
        var acc = document.getElementsByClassName("accordion");
        var i;

        for (i = 0; i < acc.length; i++) {
            acc[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var panel = this.nextElementSibling;
                if (panel.style.maxHeight){
                    panel.style.maxHeight = null;
                } else {
                    panel.style.maxHeight = panel.scrollHeight + "px";
                }
            });
        }
    </script>
</div>
<?=template_footer()?>

<?php
// when add to cart button is clicked, it checks the form data
if (isset($_POST['product_id'], $_POST['quantity']) && is_numeric($_POST['product_id']) && is_numeric($_POST['quantity'])) {
    // sets the post variables so it makes it easier to identify and make sure they're an integer
    $product_id = (int)$_POST['product_id'];
    $quantity = (int)$_POST['quantity'];
    // sql statement's prepared so it checks if the product's in the database
    $stmt = $pdo->prepare('SELECT * FROM products WHERE id = ?');
    $stmt->execute([$_POST['product_id']]);
    //retrieves the product from the database and displays the result as an array
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    // checks if the product exists
    if ($product && $quantity > 0) {
        //since product exists in database, code below creates or updates the session variable for the cart
        if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
            if (array_key_exists($product_id, $_SESSION['cart'])) {
                //since product exists in cart, quantity can be updated
                $_SESSION['cart'][$product_id] += $quantity;
            } else {
                // if product is not in the cart it can be added, this is to stop duplication
                $_SESSION['cart'][$product_id] = $quantity;
            }
        } else {
            // if no products in cart, this code will add the first product to the cart
            $_SESSION['cart'] = array($product_id => $quantity);
        }
    }
    //stops form from resubmission
    header('location: index.php?page=cart');
    exit;
}

// this removes the from the shopping cart if the remove button is selected
if (isset($_GET['remove']) && is_numeric($_GET['remove']) && isset($_SESSION['cart']) && isset($_SESSION['cart'][$_GET['remove']])) {
    //removes product from cart
    unset($_SESSION['cart'][$_GET['remove']]);
}
// updates the product quantity if the update button is selected
if (isset($_POST['update']) && isset($_SESSION['cart'])) {
    //loops through the post data so that the quantities can be updated for all products in cart
    foreach ($_POST as $k => $v) {
        if (strpos($k, 'quantity') !== false && is_numeric($v)) {
            $id = str_replace('quantity-', '', $k);
            $quantity = (int)$v;
            //continuous checks and validations
            if (is_numeric($id) && isset($_SESSION['cart'][$id]) && $quantity > 0) {
                // Update new quantity
                $_SESSION['cart'][$id] = $quantity;
            }
        }
    }
    // stops form from resubmissions
    header('location: index.php?page=cart');
    exit;
}
// if cart is not empty this redirects the user to checkout page if place order button is selected,
if (isset($_POST['placeorder']) && isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    header('Location: index.php?page=placeorder');
    exit;
}
// checks the session variable for products in the shopping cart
$products_in_cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
$products = array();
$subtotal = 0.00;
// If there's products in cart
if ($products_in_cart) {
    // if there's products in the cart, the products will be selected from the database
    $array_to_question_marks = implode(',', array_fill(0, count($products_in_cart), '?'));
    $stmt = $pdo->prepare('SELECT * FROM products WHERE id IN (' . $array_to_question_marks . ')');
    /// array_keys are the id's of the products
    $stmt->execute(array_keys($products_in_cart));
    //retrieves products and displays the result
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Calculates the subtotal
    foreach ($products as $product) {
        $subtotal += (float)$product['price'] * (int)$products_in_cart[$product['id']];
    }
}
?>

<?=template_header('Cart')?>
<link rel="stylesheet" href="../stylesheets/cart.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="container">
    <div class="leftcolumn">
        <div class="title">SHOPPING CART</div>
        <form action="index.php?page=cart" method="post">
            <table class="table6" style="margin-top:190px;">
                <thead>
                <tr>
                    <td colspan="2">Product</td>
                    <td>Price</td>
                    <td>Quantity</td>
                    <td>Total</td>
                </tr>
                </thead>
                <tbody>
                <?php if (empty($products)): ?>
                    <tr>
                        <td colspan="5" style="text-align:center;">You have no products added in your Shopping Cart</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td class="img">
                                <a href="index.php?page=product&id=<?=$product['id']?>">
                                    <img src="../images/products/<?=$product['img']?>" width="100" height="auto" alt="<?=$product['name']?>">
                                </a>
                            </td>
                            <td>
                                <a href="index.php?page=product&id=<?=$product['id']?>"><?=$product['name']?></a>
                                <br>
                                <a href="index.php?page=cart&remove=<?=$product['id']?>" class="remove">Remove</a>
                            </td>
                            <td class="price">&pound;<?=$product['price']?></td>
                            <td class="quantity">
                                <input type="number" name="quantity-<?=$product['id']?>" value="<?=$products_in_cart[$product['id']]?>" min="1" max="<?=$product['quantity']?>" placeholder="Quantity" required>
                            </td>
                            <td class="price">&pound;<?=$product['price'] * $products_in_cart[$product['id']]?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
            <div class="subtotal" style="margin-right:125px;">
                <span class="text">Subtotal</span>
                <span class="price">&pound;<?=$subtotal?></span>
            </div>
            <div class="buttons" style="margin-right:640px; margin-top: -67px;">
                <input type="submit" value="Update" name="update">
            </div>
        </form>
    </div>

    <div class="rightcolumn">
        <div class="title2">PAYMENT INFO.</div>
        <form action="#" method="post">
            <table class="table7" style="margin-top:184px;">
                <tr>
                    <th><button class="btn"><i class="fa fa-cc-mastercard"></i></button></th>
                    <th><button class="btn"><i class="fa fa-cc-visa"></i></button></th>
                    <th><button class="btn"><i class="fa fa-cc-paypal"></i></button></th>
                </tr>
            </table>

            <input type="text" name="name" placeholder="NAME OF CARD HOLDER" id="name" required>

            <input type="text" name="cardNumber" placeholder="CARD NUMBER" id="cardNumber" required>

            <select id="month" required>
                <option value="volvo">SELECT MONTH</option>
                <option value="year">JAN</option>
                <option value="year">FEB</option>
                <option value="year">MAR</option>
                <option value="year">APR</option>
                <option value="year">MAY</option>
                <option value="year">JUN</option>
                <option value="year">JUL</option>
                <option value="year">AUG</option>
                <option value="year">SEP</option>
                <option value="year">OCT</option>
                <option value="year">NOV</option>
                <option value="year">DEC</option>

            </select>
            <select id="year" required>
                <option value="year">SELECT YEAR</option>
                <option value="year">2020</option>
                <option value="year">2021</option>
                <option value="year">2022</option>
                <option value="year">2023</option>
            </select>

            <input type="text" name="cvv" placeholder="CARD VERIFICATION NUMBER" id="cvv" required>

            <div class="buttons" style="margin-right:109px; margin-top: 20px;">
                <input type="submit" value="Place Order" name="placeorder">
            </div>
        </form>
    </div>
</div>
<?=template_footer()?>


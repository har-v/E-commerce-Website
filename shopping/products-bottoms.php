<?php
// retrieves the most recently added products
$stmt = $pdo->prepare('SELECT * FROM products WHERE category=\'bottoms\'');
$stmt->execute();
$recently_added_products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<?=template_header('Bottoms Products')?>
<link rel="stylesheet" href="../stylesheets/products.css">

<div class="container" >
    <table class="table3" style="height: 100px;" >
        <tr>
            <th colspan="6" style="font-size:50px; text-align:center;">PRODUCTS</th>
        </tr>
        <tr>
            <td><a href="index.php?page=products">ALL</td>
            <td><a href ="index.php?page=products-tops">TOPS</a></td>
            <td style="color: #d3d3d3; cursor: default;">BOTTOMS</td>
            <td><a href="index.php?page=products-jackets">JACKETS</a></td>
            <td><a href="index.php?page=products-shoes">SHOES</a></td>
            <td><a href="index.php?page=products-accessories">ACCESSORIES</a></td>
        </tr>
    </table>

    <div class="content-wrapper">
        <div class="products">
            <?php foreach ($recently_added_products as $product): ?>
                <a href="index.php?page=product&id=<?=$product['id']?>">
                    <img src="../images/products/<?=$product['img']?>" width="auto" height="400" alt="<?=$product['name']?>"><p></p>
                    <span class="name"><?=$product['name']?></span><p></p>
                    <span class="price">
                    &pound;<?=$product['price']?>
                </span><p></p>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?=template_footer()?>

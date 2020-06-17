
<?=template_header('Home')?>
    <link rel="stylesheet" href="../stylesheets/homepage.css">
    <!--LANDING PAGE--------------------------------------------------------------------------------------------------------
    ----------------------------------------------------------------------------------------------------------------------->
<!--header image: https://br.pinterest.com/pin/610378555722749745/-->
    <div class="landingPage">
        <div class="h1" style="font-family: 'Vidaloka', serif; font-weight: bold;">FASHION</div>
        <div class="h2" style="font-family: 'Heebo', sans-serif; font-weight: lighter;">COLLECTION</div>
        <hr>
        <a href="index.php?page=products">
            <button class="landingPage__button">SHOP NOW</span>
            </button></a>
    </div>
    <!--PRODUCTS-------------------------------------------------------------------------------------------------------
    ----------------------------------------------------------------------------------------------------------------------->
    <!--CATEGORIES-->
<!--images:https://weheartit.com/entry/332713306    https://weheartit.com/entry/326950313   -->
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <img src="../images/index/pink.jpg" class="image1" >
                <div class="middle1">
                    <a href="index.php?page=products-tops" class="myButton">T O P S</a>
                </div>
            </div>
            <div class="col">
                <img src="../images/index/pink3.jpg" class="image2">
                <div class="middle2">
                    <a href="index.php?page=products-bottoms" class="myButton">B O T T O M S</a>
                </div>
            </div>
            <div class="col">
                <img src="../images/index/pink2.jpg" class="image3" >
                <div class="middle3">
                    <a href="index.php?page=products-jackets" class="myButton">J A C  K E T S</a>
                </div>
            </div>
            <div class="col">
                <img src="../images/index/pink3.jpg" class="image4" >
                <div class="middle4">
                    <a href="index.php?page=products-shoes" class="myButton">S H O E S</a>
                </div>
            </div>
        </div>
    </div>
    <!--BLOG/ACCOUNT-------------------------------------------------------------------------------------------------------
    ----------------------------------------------------------------------------------------------------------------------->
    <div class="split-screen">
        <div class="split left">
            <a href="index.php?page=login" class="button">ACCOUNT</a>
        </div>
        <div class="split right">
            <a href="index.php?page=blog" class="button">BLOG</a>
        </div>
    </div>

    <script>
        const left = document.querySelector(".left");
        const right = document.querySelector(".right");
        const container = document.querySelector(".split-screen");

        left.addEventListener("mouseenter", () => {
            container.classList.add("hover-left");
        });

        left.addEventListener("mouseleave", () => {
            container.classList.remove("hover-left");
        });

        right.addEventListener("mouseenter", () => {
            container.classList.add("hover-right");
        });

        right.addEventListener("mouseleave", () => {
            container.classList.remove("hover-right");
        });

    </script>
<?=template_footer()?>
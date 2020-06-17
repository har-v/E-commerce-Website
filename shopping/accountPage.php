<?php
// if user's not logged in they'll be redirected to the login page
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit();
}
// database connection
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'phplogin';
// below code tries to connect to the database information from above
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
    // if there's a problem with the database connection, an error will be displayed
    die ('Failed to connect to MySQL: ' . mysqli_connect_error());
}
// information is retrieved from the database in this session since password and email information isn't stored in session
$stmt = $con->prepare('SELECT password, email FROM accounts WHERE id = ?');
// account id from database is used to retrieve account information
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($password, $email);
$stmt->fetch();
$stmt->close();
?>

<?=template_header('Account Page')?>
<link rel="stylesheet" href="../stylesheets/accountPage.css">
<div class="image-container">
    <div class="text" style="text-transform: uppercase;">welcome to your account, <?=$_SESSION['name']?></div>
</div>

<div class="container">
    <div class="tab">
        <button class="tablinks" onclick="openTab(event, 'myOrders')"><i class='fas fa-boxes'></i>MY ORDERS</button>
        <button class="tablinks" onclick="openTab(event, 'myReturns')"><i class='fas fa-box'></i>MY RETURNS</button>
        <button class="tablinks" onclick="openTab(event, 'myDetails')"><i class='far fa-address-card'></i>MY DETAILS</button>
        <button class="tablinks" onclick="openTab(event, 'payMethods')"><i class='far fa-credit-card'></i>PAYMENT METHODS</button>
        <button class="tablinks" onclick="openTab(event, 'conPref')"><i class='far fa-comments'></i>CONTACT PREFERENCE</button>
        <button class="tablinks" onclick="openTab(event, 'help')"><i class="fa fa-question-circle"></i><a href="index.php?page=faq">NEED HELP?</a></button>
        <button class="tablinks" onclick="openTab(event, 'signOut')"><i class="fa fa-arrow-left"></i><a href="index.php?page=logout">SIGN OUT</a></button>
    </div>
    <hr>

    <div id="accOverview" class="tabcontent" style="background-color: black">
        <div class="text">
            <p style="font-family: 'Fjalla One', sans-serif;font-size: 30px;">HELLO,</p><br>
            <p style="font-family: 'Fjalla One', sans-serif; font-size: 30px;">WELCOME TO YOUR ACCOUNT</p>
        </div>
    </div>

    <div id="myOrders" class="tabcontent">
        <h3><i class='fas fa-boxes'></i>MY ORDERS</h3>
        <div class="space"></div>
        <p><img src="https://img.icons8.com/ios-filled/50/000000/hanger.png"></p>
        <h3>YOU CURRENTLY HAVE NO ORDERS</h3>
        <p><a href="index.php?page=products" class="productsButton">START SHOPPING</a></p>
    </div>
    <div id="myReturns" class="tabcontent">
        <h3><i class='fas fa-box'></i>MY RETURNS</h3>
        <div class="space"></div>
        <p><img src="https://img.icons8.com/ios-filled/50/000000/hanger.png"></p>
        <h3>YOU CURRENTLY HAVE NO REETURNS</h3>
        <p><a href="#" class="productsButton">VIEW ORDERS</a></p>
    </div>
    <div id="myDetails" class="tabcontent">
        <h3><i class='far fa-address-card'></i>MY DETAILS</h3>

        <p style="font-weight: bolder;">FEEL FREE TO EDIT YOUR DETAILS</p>
        <br><br>
        <form action="/action_page.php">
            <div class="container">
                <label for="Fname" style="font-family: 'Fjalla One', sans-serif;"><b>USERNAME</b></label>
                <input type="text" placeholder="<?=$_SESSION['name']?>" name="Fname" required>

                <label for="password" style="font-family: 'Fjalla One', sans-serif;"><b>PASSWORD</b></label>
                <input type="text" placeholder="<?=$password?>" name="Lname" required>

                <label for="email" style="font-family: 'Fjalla One', sans-serif;"><b>EMAIL ADDRESS</b></label>
                <input type="password" placeholder="<?=$email?>" name="email" required>

                <p><a href="index.php?page=change_password" class="saveButton">CHANGE PASSWORD</a></p>
            </div>
        </form>
    </div>
    <div id="payMethods" class="tabcontent">
        <h3><i class='far fa-credit-card'></i>ADD A PAYMENT METHOD</h3>
        <div class="space"></div>

        <h3>YOU CURRENTLY HAVE NO PAYMENTS</h3>
        <p><a href="#" class="productsButton">ADD PAYMENT METHOD</a></p>
    </div>
    <div id="conPref" class="tabcontent">
        <h3><i class='far fa-comments'></i>CONTACT PREFERENCE</h3>
        <div class="space"></div>

        <p>WHAT WOULD YOU LIKE TO HEAR ABOUT?</p>
        <div class="space"></div>

        <input type="checkbox" id="fruit4" name="fruit-4" value="Strawberry">
        <label for="fruit4" style="font-family: 'Fjalla One', sans-serif; text-align: center;">&nbsp;&nbsp;&nbsp;&nbsp;DISCOUNT & SALES</label><br>
        <input type="checkbox" id="fruit5" name="fruit-4" value="cherry">
        <label for="fruit4" style="font-family: 'Fjalla One', sans-serif; text-align: center;">&nbsp;&nbsp;&nbsp;&nbsp;NEW ITEMS</label>

    </div>
    <div id="signOut" class="tabcontent">
    </div>
</div>

<script>
    function openTab(evt, tabname) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(tabname).style.display = "block";
        evt.currentTarget.className += " active";
    }

    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
</script>
<?=template_footer()?>


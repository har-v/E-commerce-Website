<style>
    form {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }
    form input[type="text"], [type="password"]  {
        width: 331px;
        height: 50px;
        border: 1px solid #dee0e4;
        margin-top: 40px;
        margin-left: 10px;
        padding: 0 40px;
        border-radius: 100px;
        font-family: 'Heebo', sans-serif;
        font-weight: bolder;
        outline: none;
    }
    form input[type="submit"] {
        width: 12%;
        padding: 15px;
        margin-top:230px;
        margin-left: -250px;
        background-color: #d4c0c8;
        border: 0;
        cursor: pointer;
        font-weight: bold;
        color: #ffffff;
        transition: background-color 0.2s;
        border-radius: 100px;
        margin-bottom: 10px;
        position: absolute;
        outline: none;
    }
    form input[type="submit"]:hover {
        background-color: #95878d;
        transition: background-color 0.2s;
    }
    .box-shadow{
        width: 450px;
        height: 400px;
        background-color: #ffffff;
        box-shadow: 0 0 100px 0 rgb(254, 231, 241);
        margin: 100px auto;
    }


    @media (max-width: 800px) {
        form input[type="submit"] {
            width: 50%;
            padding: 15px;

        }
    }

    @media (min-width: 1500px) {
        form input[type="submit"] {
            margin-left: -290px;

        }
    }

</style>
<?php
if(!isset($_SESSION)){
    session_start();
}
$user = $_SESSION['name'];

if($user) {
//user is logged in
    if (isset($_POST['submit'])) {
        //check filed
        $oldpassword = ($_POST['oldpassword']);
        $newpassword = ($_POST['newpassword']);
        $repeatnewpassword = ($_POST['repeatnewpassword']);

        //check password against database,
        //connect to database,
        // database connection information
        $DATABASE_HOST = 'localhost';
        $DATABASE_USER = 'root';
        $DATABASE_PASS = '';
        $DATABASE_NAME = 'phplogin';
        // below code tries to connect to the database information from above
        $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
        if ( mysqli_connect_errno() ) {
            // if there's a problem with the database connection, an error will be displayed
            die ('Failed to connect to MySQL: ' . mysqli_connect_error());
        }

        $queryget =mysqli_query($con,"SELECT password FROM accounts WHERE username='$user'") or die ("Query didn't work");
        $row = mysqli_fetch_assoc($queryget);

        $oldpassworddb = ($row['password']);

        //check passwords
        if ($oldpassword==$oldpassworddb) {
            //check two new passwords
            if ($newpassword == $repeatnewpassword) {
                //success
                //change password in db
                $querychange = mysqli_query($con, "UPDATE accounts SET password='$newpassword' WHERE username='$user'");
                session_destroy();
                die("Your password has been changed. <a href='index.php?page=login'>Return to login page</a>");

            }
            else
                die ("new passwords do not match");
        } else
            die ("Old password doesn't match");
    }
    //else {}

    echo"

    <br>
    <div class='box-shadow'>
    <form action='change_password.php' method='POST'>
        <input type='text' name='oldpassword' placeholder=\"ENTER OLD PASSWORD\" required><p>
        <input type='password' name='newpassword' placeholder=\"ENTER NEW PASSWORD\" required><br>
        <input type='password' name='repeatnewpassword' placeholder=\"ENTER NEW PASSWORD AGAIN\" required><br><p>
        <input type='submit' name='submit' value='Change password'></p>
    </form>
    </div>
    ";

} else
    die ("You must be logged in to change to your password");

?>
<?=template_header('Change Password')?>
<?=template_footer()?>


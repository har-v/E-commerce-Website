<?php
session_start();
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

// checks if the data from login has been submitted and checks if the data exists
if ( !isset($_POST['username'], $_POST['password']) ) {
    // Could not get the data that should have been sent.
    die ('Please fill both the username and password field!');
}

// prepares the sql statement to prevent sql injection
if ($stmt = $con->prepare('SELECT id, password FROM accounts WHERE username = ?')) {
    // parameters are binded. 's' stands for string in usernames
    $stmt->bind_param('s', $_POST['username']);
    $stmt->execute();
    // Results are stored in order to check if the account exists in the database
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $password);
        $stmt->fetch();
        // account exists, next the password is checked and verified
        if ($_POST['password'] === $password) {
            // user is logged in if the verification is a success
            // session is created once the user is logged in
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['name'] = $_POST['username'];
            $_SESSION['id'] = $id;
            // once logged in the user will be redirected to their account page
            header('Location: index.php?page=accountPage');
        } else {
            echo 'Incorrect password!';
        }
    } else {
        echo 'Incorrect username!';
    }
    $stmt->close();
}
?>



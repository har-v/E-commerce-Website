<?php
// database connection information
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

//code checks if the data entered hasn't been entered before, i.e. not in database
if (!isset($_POST['username'], $_POST['password'], $_POST['email'])) {
    // no text input, will ask to input text before proceeding
    die ('Please complete the registration form!');
}
// ensures submitted registration values aren't empty
if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email'])) {
    // no text input in text boxes, will ask user to input text before proceeding
    die ('Please complete the registration form');
}

// validates email
if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    // accepts email like emai@email.com
    die ('Email is not valid!');
}

// ensures characters entered are valid. If invalid, error is displayed
if (preg_match('/[A-Za-z0-9]+/', $_POST['username']) == 0) {
    die ('Username is not valid!');
}

// checks character length, otherwise error is displayed
if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
    die ('Password must be between 5 and 20 characters long!');
}

//checks if the account with the username entered exists
if ($stmt = $con->prepare('SELECT id, password FROM accounts WHERE username = ?')) {
    // parameters are binded (s = string, i = int, b = blob, so-f0rth) and password hashing used the PHP password_hash function.
    $stmt->bind_param('s', $_POST['username']);
    $stmt->execute();
    $stmt->store_result();
    //Results stored in order to check if the account exists in the database
    if ($stmt->num_rows > 0) {
        // Username already exists
        echo 'Username exists, please choose another!';
    } else {
        // if username doesnt exist, new account's inserted
        if ($stmt = $con->prepare('INSERT INTO accounts (username, password, email) VALUES (?, ?, ?)')) {
            //password hashing used in order to not expose passwords in database
            $password = $_POST['password'];
            $stmt->bind_param('sss', $_POST['username'], $password, $_POST['email']);
            $stmt->execute();
            // once registerd it will take the user to the login page.
            echo "<script> location.href='index.php?page=login'; </script>";
        } else {
            // error with sql statement, it will check to make sure account table exists with all 3 fields
            echo 'Could not prepare statement!';
        }
    }
    $stmt->close();
} else {
    // error with sql statement, it will check to make sure account table exists with all 3 fields
    echo 'Could not prepare statement!';
}
$con->close();
?>


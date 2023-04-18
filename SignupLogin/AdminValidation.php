<?php
$password = $_POST["password"];

// Validate password strength
$uppercase = preg_match("/[A-Z]/", $password);
$lowercase = preg_match("/[a-z]/", $password);
$number    = preg_match("/[0-9]/", $password);
$specialChars = preg_match("/[\'^£$%&*()}{@#~?><>.!,|=_+¬-]/", $password);



//if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
//    echo "Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.";
//}

//change all echo to die(); ---echo kept running into problem
if (empty($_POST["user"])) {
    die("Username is required.<br>");
}

if(strlen($_POST["user"]) < 6) {
    die ("Username should be at least 6 characters in length.<br>");

}

if (empty($_POST["fname"])) {
    die("First name is required.<br>");
}

if (empty($_POST["lname"])) {
    die("Last name is required.<br>");
}

if ($_POST["adminStatus"] == 0){
    if (empty($_POST["country"])) {
        die("Country is required.<br>");
    }

    if (empty($_POST["mstatus"])) {
        die("Marital Status is required.<br>");
    }

    if (empty($_POST["kids"])) {
        die("Number of kids is required.<br>");
    }
}



if ( ! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    die("Valid email is required.<br>");
}

if(strlen($password) < 8) {
    die ("Password should be at least 8 characters in length.<br>");

}
if(!$uppercase) {
    die ("Password should include at least one upper case letter.<br>");

}
if(!$lowercase) {
    die ("Password should include at least one lower case letter.<br>");

}
if(!$number) {
    die ("Password should include at least one digit.<br>");

}
if(!$specialChars) {
    die ("Password should include at least one special character.<br>");
}

if ($_POST["password2"] !== $_POST["password"]){
    die ("Passwords must match.<br>");

}

// To proctect the password
$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
//$is_admin = $_POST["adminStatus"];

// Directory to databse file
$mysql = require __DIR__ . "/Database.php";

$sql = "INSERT INTO user (USERNAME, FNAME, LNAME, COUNTRY, MSTATUS, KIDS, EMAIL, PASSWORD_HASH, IS_ADMIN)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?,?)";
        
$stmt = $mysqli->stmt_init();

if ( ! $stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}

$stmt->bind_param("sssssissi",
                  $_POST["user"],
                  $_POST["fname"],
                  $_POST["lname"],
                  $_POST["country"],
                  $_POST["mstatus"],
                  $_POST["kids"],
                  $_POST["email"],
                  $password_hash,
                  $_POST["adminStatus"]);
                  
if ($stmt->execute()) {
    
    header("Location: AdminHomePage.php?success=1");
    exit();
    
} else {
    
    if ($mysqli->errno === 1062) {
        die("Username or Email already taken");
    } else{
        die($mysqli->error . " " . $mysqli->errno);
    }
}

<?php

session_start();

if (isset($_SESSION["user_id"])){
    $mysqli = require __DIR__ . "/Database.php";

    $sql = "SELECT * FROM user
            WHERE ID = {$_SESSION["user_id"]}";

            $result = $mysqli->query($sql);
            $user = $result->fetch_assoc();

            //to redirect admin to admin homepage
            if ($user["IS_ADMIN"] == 1){
                header("Location: AdminHomePage.php");
                exit;
            }


// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $userId = $_POST["user_id"];
    $oldpassword = $_POST["oldpassword"];
    $newpassword = $_POST["newpassword"];
    $newpassword2 = $_POST["newpassword2"];
                // Validate password strength
    $uppercase = preg_match("/[A-Z]/", $newpassword);
    $lowercase = preg_match("/[a-z]/", $newpassword);
    $number    = preg_match("/[0-9]/", $newpassword);
    $specialChars = preg_match("/[\'^£$%&*()}{@#~?><>.!,|=_+¬-]/", $newpassword);


    // Validate input
    if(password_verify($oldpassword,$user["PASSWORD_HASH"])){

        if(strlen($newpassword) < 8) {
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
        
        if ($_POST["newpassword2"] !== $_POST["newpassword"]){
            die ("Passwords must match.<br>");
        
        }

        if($password == $password2){
            $new_password_hash = password_hash($_POST["newpassword"], PASSWORD_DEFAULT);


    }
}
        else
        {
        die ("Incorrect Current Password.<br>");
        }

    }

    // Prepare the SQL statement for updating the user
    $sql = "UPDATE user SET PASSWORD_HASH = ? WHERE ID = ?";

    $stmt = $mysqli->stmt_init();

    if (!$stmt->prepare($sql)) {
                die("SQL error: " . $mysqli->error);
    }

    // Bind the updated values to the prepared statement
    $stmt->bind_param("si", $new_password_hash, $_SESSION["user_id"]);

    // Execute the prepared statement
    if ($stmt->execute()) {
        header("Location: HomePage.php?update_success=1");
        exit();
    } else {
        die("Error updating the user: " . $mysqli->error . " " . $mysqli->errno);
    }



}

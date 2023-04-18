<?php
session_start();

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Include the database connection
    $mysqli = require __DIR__ . "/Database.php";

    // Gather the updated information from the form
    $userId = $_POST["user_id"];
    $username = $_POST["username"];
    $firstName = $_POST["first_name"];
    $lastName = $_POST["last_name"];
    $country = $_POST["country"];
    $maritalStatus = $_POST["marital_status"];
    $kids = $_POST["kids"];
    $email = $_POST["email"];

    // Validate input
    if (strlen($username) < 6) {
        die("Username should be at least 6 characters in length.<br>");
    }

    if (empty($firstName)) {
        die("First name is required.<br>");
    }

    if (empty($lastName)) {
        die("Last name is required.<br>");
    }

    if (empty($country)) {
        die("Country is required.<br>");
    }

    if (empty($maritalStatus)) {
        die("Marital status is required.<br>");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Valid email is required.<br>");
    }

    // Prepare the SQL statement for updating the user
    $sql = "UPDATE user SET USERNAME = ?, FNAME = ?, LNAME = ?, COUNTRY = ?, MSTATUS = ?, KIDS = ?, EMAIL = ? WHERE ID = ?";

    $stmt = $mysqli->stmt_init();

    if (!$stmt->prepare($sql)) {
        die("SQL error: " . $mysqli->error);
    }

    // Bind the updated values to the prepared statement
    $stmt->bind_param("sssssisi", $username, $firstName, $lastName, $country, $maritalStatus, $kids, $email, $userId);

    // Execute the prepared statement
    if ($stmt->execute()) {
        header("Location: HomePage.php?update_success=1");
        exit();
    } else {
        die("Error updating the user: " . $mysqli->error . " " . $mysqli->errno);
    }
}

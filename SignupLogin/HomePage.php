<?php
// Check if success parameter is set
if(isset($_GET['update_success']) && $_GET['update_success'] == 1){
    // Display success alert
    echo "<script>alert('Update successful!');</script>";
    header( "Refresh:2; url='HomePage.php'");

  }

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

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="Styles/HomePage.css" />
    <title>HomePage</title>
</head>
<body>
<nav class="navbar">        
        <div>
            <p>LOGO</p>
        </div>
        <ul class="nav-list" id="navi-list">
            <li class="list-item">
                <a href="Update.php">Information</a>
    
            <li class="list-item">
            <a href="LogOut.php">Logout</a>
            </li>
        </ul>
    </nav>
    <?php if (isset($user)):?>
        <h1 style="text-align:center;">Welcome,  <?= htmlspecialchars($user["USERNAME"]) ?></h1>
    <?php else: ?>
    <?php header("Location: HomePage.php"); ?>
    <?php endif; ?>

    
</body>
</html>
<?php
// For invalid login input
$is_invalid = false;
// Check if success parameter is set
if (isset($_GET['success']) && $_GET['success'] == 1) {
    // Display success alert
    echo "<script>alert('Registration successful!');</script>";
    header("Refresh:2; url='MainPage.php'");
}
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $mysqli = require __DIR__ . "/Database.php";
    $sql = sprintf(
        "SELECT * FROM user
            WHERE USERNAME ='%s'",

        $mysqli->real_escape_string($_POST["username"])
    );

    $result = $mysqli->query($sql);

    $user = $result->fetch_assoc();

    if ($user) {
        //to verify the input password and the password_hash match
        if (password_verify($_POST["password"], $user["PASSWORD_HASH"])) {

            if ($user["IS_ADMIN"] == 1) {


                session_start();
                session_regenerate_id();
                $_SESSION["user_id"] = $user["ID"];

                header("Location: AdminHomePage.php");
                exit;
            } else {
                session_start();
                session_regenerate_id();
                $_SESSION["user_id"] = $user["ID"];

                header("Location: HomePage.php");
                exit;
            }
        }
    }
    $is_invalid = true;

    //var_dump($user);
    //exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="Styles/MainPage.css" />
    <title>Main Page</title>
</head>

<body>
    <nav class="navbar">
        <div>
            <p>LOGO</p>
        </div>
        <ul class="nav-list" id="navi-list">
            <li class="list-item">
                <a href="#" onclick="document.getElementById('login-modal').style.display='block'">Login</a>
            
            <li class="list-item">
                <a href="SignUp.php">Sign Up</a>
            </li>
        </ul>
        <div class="menu" id="burger-button">
            <div class="menu-line"></div>
            <div class="menu-line"></div>
            <div class="menu-line"></div>
        </div>
    </nav>
    <div class="content">
        <h1 class="title">Welcome to the Sign Up/Login Project!</h1>
        <p>Please sign up or log in to begin.</p>
    </div>

    <!-- The login modal -->
    <div id="login-modal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="document.getElementById('login-modal').style.display='none'">&times;</span>
            <h2>Login</h2>
            <hr>
            <?php if ($is_invalid) : ?>
                <em>
                    <font color="red">Invalid Login</font>
                </em>
            <?php endif; ?>

            <form class="login-form" method="post">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" placeholder="Username" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Password">

                <button type="submit">Login</button>
            </form>
        </div>
    </div>
    <script>
        // Get the login modal
        var modal = document.getElementById('login-modal');

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
        const toggleButton = document.getElementById('burger-button');
        const naviList = document.getElementById('navi-list');

        toggleButton.addEventListener('click', () => {
            naviList.classList.toggle('active');
        })
    </script>
</body>

</html>
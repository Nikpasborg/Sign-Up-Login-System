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

}
/*
// Include the database connection
$mysqli = require __DIR__ . "/Database.php";

// Initialize a variable to hold the user data
$user = null;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["username"]) && isset($_POST["password"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Fetch the user data from the database based on the provided username
    $sql = "SELECT * FROM user WHERE USERNAME = ?";
    $stmt = $mysqli->stmt_init();

    if (!$stmt->prepare($sql)) {
        die("SQL error: " . $mysqli->error);
    }

    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify the user's credentials
        if (!password_verify($password, $user["PASSWORD_HASH"])) {
            $user = null;
            $errorMessage = "Incorrect username or password.";
        }
    } else {
        $errorMessage = "Incorrect username or password.";
    }
    */

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="Styles/Update.css" />
    <title>Update User Information</title>
    <style>
    /* Style the update form button */
        button {
            background-color: #333;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 3px;
            margin-top: 10px;
            cursor: pointer;
            width: 100%;
            margin-bottom: 20px;
        }

        /* Style the update form button on hover */
        button:hover {
            background-color: #45a049;
        }
        </style>
</head>
<body>
    <?php
    // If the user's credentials are not verified, display the login form
    
    
    /*if ($user === null) {
    ?>
        <h1>Login</h1>
        <?php
        if (isset($errorMessage)) {
            echo "<p>" . $errorMessage . "</p>";
        }
        ?>
        <form action="update.php" method="post">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required><br>

            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required><br>

            <input type="submit" value="Login">
        </form>
    <?php
    } else {
    */
    // If the user's credentials are verified, display the update form
    ?>

    <nav class="navbar">        
        <div>
            <p>LOGO</p>
        </div>
        <ul class="nav-list" id="navi-list">
            <li class="list-item">
                <a href="HomePage.php">Go Back</a>
            </li>
        </ul>
    </nav>
    <div class="container">

        <h1>Update User Information</h1>
        <form class="update-form" action="UpdateValidation.php" id="update" method="post">
            <input type="hidden" name="user_id" value="<?php echo $user['ID']; ?>">
            <div>
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" value="<?php echo $user['USERNAME']; ?>" required><br>
    </div>
    <div>
            <label for="first_name">First Name:</label>
            <input type="text" name="first_name" id="first_name" value="<?php echo $user['FNAME']; ?>" required><br>
    </div>
    <div>
            <label for="last_name">Last Name:</label>
            <input type="text" name="last_name" id="last_name" value="<?php echo $user['LNAME']; ?>" required><br>
    </div>
           
            <!--
            <label for="country">Country:</label>
            <input type="text" name="country" id="country" value="<?//php echo $user['COUNTRY']; ?>" required><br>
    -->

            <div>
          <label for="country">Country of Origin</label>
            <select id="country" name="country" required>
               <option value="<?php echo $user['COUNTRY']; ?>"><?php echo $user['COUNTRY']; ?></option>
                <option value="Afghanistan">Afghanistan</option>
                <option value="Aland Islands">Åland Islands</option>
                <option value="Albania">Albania</option>
                <option value="Algeria">Algeria</option>
                <option value="American Samoa">American Samoa</option>
                <option value="Andorra">Andorra</option>
                <option value="Angola">Angola</option>
                <option value="Anguilla">Anguilla</option>
                <option value="Antarctica">Antarctica</option>
                <option value="Antigua and Barbuda">Antigua & Barbuda</option>
                <option value="Argentina">Argentina</option>
                <option value="Armenia">Armenia</option>
                <option value="Aruba">Aruba</option>
                <option value="Australia">Australia</option>
                <option value="Austria">Austria</option>
                <option value="Azerbaijan">Azerbaijan</option>
                <option value="Bahamas">Bahamas</option>
                <option value="Bahrain">Bahrain</option>
                <option value="Bangladesh">Bangladesh</option>
                <option value="Barbados">Barbados</option>
                <option value="Belarus">Belarus</option>
                <option value="Belgium">Belgium</option>
                <option value="Belize">Belize</option>
                <option value="Benin">Benin</option>
                <option value="Bermuda">Bermuda</option>
                <option value="Bhutan">Bhutan</option>
                <option value="Bolivia">Bolivia</option>
                <option value="Bonaire, Sint Eustatius and Saba">Caribbean Netherlands</option>
                <option value="Bosnia and Herzegovina">Bosnia & Herzegovina</option>
                <option value="Botswana">Botswana</option>
                <option value="Bouvet Island">Bouvet Island</option>
                <option value="Brazil">Brazil</option>
                <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                <option value="Brunei Darussalam">Brunei</option>
                <option value="Bulgaria">Bulgaria</option>
                <option value="Burkina Faso">Burkina Faso</option>
                <option value="Burundi">Burundi</option>
                <option value="Cambodia">Cambodia</option>
                <option value="Cameroon">Cameroon</option>
                <option value="Canada">Canada</option>
                <option value="Cape Verde">Cape Verde</option>
                <option value="Cayman Islands">Cayman Islands</option>
                <option value="Central African Republic">Central African Republic</option>
                <option value="Chad">Chad</option>
                <option value="Chile">Chile</option>
                <option value="China">China</option>
                <option value="Christmas Island">Christmas Island</option>
                <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                <option value="Colombia">Colombia</option>
                <option value="Comoros">Comoros</option>
                <option value="Congo">Congo - Brazzaville</option>
                <option value="Congo, Democratic Republic of the Congo">Congo - Kinshasa</option>
                <option value="Cook Islands">Cook Islands</option>
                <option value="Costa Rica">Costa Rica</option>
                <option value="Cote D'Ivoire">Côte d’Ivoire</option>
                <option value="Croatia">Croatia</option>
                <option value="Cuba">Cuba</option>
                <option value="Curacao">Curaçao</option>
                <option value="Cyprus">Cyprus</option>
                <option value="Czech Republic">Czechia</option>
                <option value="Denmark">Denmark</option>
                <option value="Djibouti">Djibouti</option>
                <option value="Dominica">Dominica</option>
                <option value="Dominican Republic">Dominican Republic</option>
                <option value="Ecuador">Ecuador</option>
                <option value="Egypt">Egypt</option>
                <option value="El Salvador">El Salvador</option>
                <option value="Equatorial Guinea">Equatorial Guinea</option>
                <option value="Eritrea">Eritrea</option>
                <option value="Estonia">Estonia</option>
                <option value="Ethiopia">Ethiopia</option>
                <option value="Falkland Islands (Malvinas)">Falkland Islands (Islas Malvinas)</option>
                <option value="Faroe Islands">Faroe Islands</option>
                <option value="Fiji">Fiji</option>
                <option value="Finland">Finland</option>
                <option value="France">France</option>
                <option value="French Guiana">French Guiana</option>
                <option value="French Polynesia">French Polynesia</option>
                <option value="French Southern Territories">French Southern Territories</option>
                <option value="Gabon">Gabon</option>
                <option value="Gambia">Gambia</option>
                <option value="Georgia">Georgia</option>
                <option value="Germany">Germany</option>
                <option value="Ghana">Ghana</option>
                <option value="Gibraltar">Gibraltar</option>
                <option value="Greece">Greece</option>
                <option value="Greenland">Greenland</option>
                <option value="Grenada">Grenada</option>
                <option value="Guadeloupe">Guadeloupe</option>
                <option value="Guam">Guam</option>
                <option value="Guatemala">Guatemala</option>
                <option value="Guernsey">Guernsey</option>
                <option value="Guinea">Guinea</option>
                <option value="Guinea-Bissau">Guinea-Bissau</option>
                <option value="Guyana">Guyana</option>
                <option value="Haiti">Haiti</option>
                <option value="Heard Island and Mcdonald Islands">Heard & McDonald Islands</option>
                <option value="Holy See (Vatican City State)">Vatican City</option>
                <option value="Honduras">Honduras</option>
                <option value="Hong Kong">Hong Kong</option>
                <option value="Hungary">Hungary</option>
                <option value="Iceland">Iceland</option>
                <option value="India">India</option>
                <option value="Indonesia">Indonesia</option>
                <option value="Iran, Islamic Republic of">Iran</option>
                <option value="Iraq">Iraq</option>
                <option value="Ireland">Ireland</option>
                <option value="Isle of Man">Isle of Man</option>
                <option value="Israel">Israel</option>
                <option value="Italy">Italy</option>
                <option value="Jamaica">Jamaica</option>
                <option value="Japan">Japan</option>
                <option value="Jersey">Jersey</option>
                <option value="Jordan">Jordan</option>
                <option value="Kazakhstan">Kazakhstan</option>
                <option value="Kenya">Kenya</option>
                <option value="Kiribati">Kiribati</option>
                <option value="Korea, Democratic People's Republic of">North Korea</option>
                <option value="Korea, Republic of">South Korea</option>
                <option value="Kosovo">Kosovo</option>
                <option value="Kuwait">Kuwait</option>
                <option value="Kyrgyzstan">Kyrgyzstan</option>
                <option value="Lao People's Democratic Republic">Laos</option>
                <option value="Latvia">Latvia</option>
                <option value="Lebanon">Lebanon</option>
                <option value="Lesotho">Lesotho</option>
                <option value="Liberia">Liberia</option>
                <option value="Libyan Arab Jamahiriya">Libya</option>
                <option value="Liechtenstein">Liechtenstein</option>
                <option value="Lithuania">Lithuania</option>
                <option value="Luxembourg">Luxembourg</option>
                <option value="Macao">Macao</option>
                <option value="Macedonia, the Former Yugoslav Republic of">North Macedonia</option>
                <option value="Madagascar">Madagascar</option>
                <option value="Malawi">Malawi</option>
                <option value="Malaysia">Malaysia</option>
                <option value="Maldives">Maldives</option>
                <option value="Mali">Mali</option>
                <option value="Malta">Malta</option>
                <option value="Marshall Islands">Marshall Islands</option>
                <option value="Martinique">Martinique</option>
                <option value="Mauritania">Mauritania</option>
                <option value="Mauritius">Mauritius</option>
                <option value="Mayotte">Mayotte</option>
                <option value="Mexico">Mexico</option>
                <option value="Micronesia, Federated States of">Micronesia</option>
                <option value="Moldova, Republic of">Moldova</option>
                <option value="Monaco">Monaco</option>
                <option value="Mongolia">Mongolia</option>
                <option value="Montenegro">Montenegro</option>
                <option value="Montserrat">Montserrat</option>
                <option value="Morocco">Morocco</option>
                <option value="Mozambique">Mozambique</option>
                <option value="Myanmar">Myanmar (Burma)</option>
                <option value="Namibia">Namibia</option>
                <option value="Nauru">Nauru</option>
                <option value="Nepal">Nepal</option>
                <option value="Netherlands">Netherlands</option>
                <option value="Netherlands Antilles">Curaçao</option>
                <option value="New Caledonia">New Caledonia</option>
                <option value="New Zealand">New Zealand</option>
                <option value="Nicaragua">Nicaragua</option>
                <option value="Niger">Niger</option>
                <option value="Nigeria">Nigeria</option>
                <option value="Niue">Niue</option>
                <option value="Norfolk Island">Norfolk Island</option>
                <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                <option value="Norway">Norway</option>
                <option value="Oman">Oman</option>
                <option value="Pakistan">Pakistan</option>
                <option value="Palau">Palau</option>
                <option value="Palestinian Territory, Occupied">Palestine</option>
                <option value="Panama">Panama</option>
                <option value="Papua New Guinea">Papua New Guinea</option>
                <option value="Paraguay">Paraguay</option>
                <option value="Peru">Peru</option>
                <option value="Philippines">Philippines</option>
                <option value="Pitcairn">Pitcairn Islands</option>
                <option value="Poland">Poland</option>
                <option value="Portugal">Portugal</option>
                <option value="Puerto Rico">Puerto Rico</option>
                <option value="Qatar">Qatar</option>
                <option value="Reunion">Réunion</option>
                <option value="Romania">Romania</option>
                <option value="Russian Federation">Russia</option>
                <option value="Rwanda">Rwanda</option>
                <option value="Saint Barthelemy">St. Barthélemy</option>
                <option value="Saint Helena">St. Helena</option>
                <option value="Saint Kitts and Nevis">St. Kitts & Nevis</option>
                <option value="Saint Lucia">St. Lucia</option>
                <option value="Saint Martin">St. Martin</option>
                <option value="Saint Pierre and Miquelon">St. Pierre & Miquelon</option>
                <option value="Saint Vincent and the Grenadines">St. Vincent & Grenadines</option>
                <option value="Samoa">Samoa</option>
                <option value="San Marino">San Marino</option>
                <option value="Sao Tome and Principe">São Tomé & Príncipe</option>
                <option value="Saudi Arabia">Saudi Arabia</option>
                <option value="Senegal">Senegal</option>
                <option value="Serbia">Serbia</option>
                <option value="Serbia and Montenegro">Serbia</option>
                <option value="Seychelles">Seychelles</option>
                <option value="Sierra Leone">Sierra Leone</option>
                <option value="Singapore">Singapore</option>
                <option value="Sint Maarten">Sint Maarten</option>
                <option value="Slovakia">Slovakia</option>
                <option value="Slovenia">Slovenia</option>
                <option value="Solomon Islands">Solomon Islands</option>
                <option value="Somalia">Somalia</option>
                <option value="South Africa">South Africa</option>
                <option value="South Georgia and the South Sandwich Islands">South Georgia & South Sandwich Islands</option>
                <option value="South Sudan">South Sudan</option>
                <option value="Spain">Spain</option>
                <option value="Sri Lanka">Sri Lanka</option>
                <option value="Sudan">Sudan</option>
                <option value="Suriname">Suriname</option>
                <option value="Svalbard and Jan Mayen">Svalbard & Jan Mayen</option>
                <option value="Swaziland">Eswatini</option>
                <option value="Sweden">Sweden</option>
                <option value="Switzerland">Switzerland</option>
                <option value="Syrian Arab Republic">Syria</option>
                <option value="Taiwan, Province of China">Taiwan</option>
                <option value="Tajikistan">Tajikistan</option>
                <option value="Tanzania, United Republic of">Tanzania</option>
                <option value="Thailand">Thailand</option>
                <option value="Timor-Leste">Timor-Leste</option>
                <option value="Togo">Togo</option>
                <option value="Tokelau">Tokelau</option>
                <option value="Tonga">Tonga</option>
                <option value="Trinidad and Tobago">Trinidad & Tobago</option>
                <option value="Tunisia">Tunisia</option>
                <option value="Turkey">Turkey</option>
                <option value="Turkmenistan">Turkmenistan</option>
                <option value="Turks and Caicos Islands">Turks & Caicos Islands</option>
                <option value="Tuvalu">Tuvalu</option>
                <option value="Uganda">Uganda</option>
                <option value="Ukraine">Ukraine</option>
                <option value="United Arab Emirates">United Arab Emirates</option>
                <option value="United Kingdom">United Kingdom</option>
                <option value="United States">United States</option>
                <option value="United States Minor Outlying Islands">U.S. Outlying Islands</option>
                <option value="Uruguay">Uruguay</option>
                <option value="Uzbekistan">Uzbekistan</option>
                <option value="Vanuatu">Vanuatu</option>
                <option value="Venezuela">Venezuela</option>
                <option value="Viet Nam">Vietnam</option>
                <option value="Virgin Islands, British">British Virgin Islands</option>
                <option value="Virgin Islands, U.s.">U.S. Virgin Islands</option>
                <option value="Wallis and Futuna">Wallis & Futuna</option>
                <option value="Western Sahara">Western Sahara</option>
                <option value="Yemen">Yemen</option>
                <option value="Zambia">Zambia</option>
                <option value="Zimbabwe">Zimbabwe</option>
            </select>
          </div>

            <div>
            <label for="marital_status">Marital Status</label>
            <select name="marital_status" id="marital_status" required><br>>
                <option value="<?php echo $user['MSTATUS']; ?>"><?php echo $user['MSTATUS']; ?></option>
                <option value="single">Single</option>
                <option value="married">Married</option>
                <option value="divorced">Divorced</option>
                <option value="widowed">Widowed</option>
              </select> 
            </div>
    <!--
            <label for="marital_status">Marital Status:</label>
            <input type="text" name="marital_status" id="marital_status" value="<?//php echo $user['MSTATUS']; ?>" required><br>
    --> 
        <div>
          <label for="kids">Number of Kids</label>
            <input type="number" style="text-align: center;" min="0" id="kids" name="kids" placeholder="Num" value="<?php echo $user['KIDS']; ?>" required>
        </div>
        <!--
            <label for="kids">Number of Kids:</label>
            <input type="number" name="kids" id="kids" value="<?//php echo $user['KIDS']; ?>" required><br>
-->
<div>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="<?php echo $user['EMAIL']; ?>" required><br>
    </div>
    <div>
        <!--
            <input type="submit" value="Update User Information">
    -->
            <button class="btn">Update User Information</button>
    </div>
        </form>
        <h1>Update Password</h1>
        <form class="password-update-form" action="PasswordValidation.php" id="passwordupdate" method="post">
        <input type="hidden" name="user_id" value="<?php echo $user['ID']; ?>">
        <div>
          <label for="oldpassword">Current Password</label>
            <input type="password" id="oldpassword" name="oldpassword" placeholder="Current Password" required>
        </div>

        <div>
          <label for="newpassword">New Password</label>
            <input type="password" id="newpassword" name="newpassword" placeholder="New Password" >
        </div>
        <div>
          <label for="newpassword2">Confirm Password</label>

            <input type="password" id="newpassword2" name="newpassword2" placeholder="Confirm Password" >
        </div>
        <div>
          <button>Update Password</button>
        </div>
      </form>

    </div>
    <?php
    
    ?>
</body>
</html>

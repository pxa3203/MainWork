<!-- The following code is an adaptation from Matthew Bolger code from tutorials and practicals. The code is modified to fit my assignment. -->
<?php require_once "includes/functions.inc.php";?>
<?php
$errors = [];
if (isset($_POST['submit'])) {
    $errors = registerUser($_POST);

    if (count($errors) === 0) {
        header('Location: welcomeLogin.php');
        exit();
    }
}
?>
<!DOCTYPE html>
<html>
<title>ABC Registration</title>

<head>
    <link rel="stylesheet" type="text/css" href="styles/IndexStyle.css">
    <link rel="shortcut icon" href="assets/images/faviconLogo.png" />
    <script src="scripts/script.js"></script>
</head>

<body>
    <div class="main">
        <?php
require_once "includes/header.php";
require_once "includes/logo.php";
require_once "includes/navbar.php";
require_once "includes/footer.php";

?>
<!-- registration form with php side validation -->
        <div class="content" id="content">
            <h1>Membership Registration</h1>
            <h2>Personal Details</h2>
            <form id="regForm" name="registration" method="post">
                <div class="form">

                    <div><label class="label">First Name:</label><input type="text" name="fName" id="fName"
                            placeholder="required" <?php displayValue($_POST, 'fName');?> /> </div>
                    <?php displayError($errors, 'fName');?>

                    <div><label class="label">Surname:</label><input type="text" name="surname" id="surname"
                            placeholder="required" <?php displayValue($_POST, 'surname');?> /></div>
                    <?php displayError($errors, 'surname');?>

                    <div><label class="label">Email:</label><input type="text" name="email" id="email"
                            placeholder="required" <?php displayValue($_POST, 'email');?> /></div>
                    <?php displayError($errors, 'email');?>

                    <div><label class="label">Password:</label><input type="password" name="password" id="password"
                            placeholder="required" <?php displayValue($_POST, 'password');?> /></div>
                    <?php displayError($errors, 'password');?>

                    <div><label class="label">Confirm Password:</label><input type="password" name="confirmPassword"
                            id="confirmPassword" placeholder="required"
                            <?php displayValue($_POST, 'confirmPassword');?> /></div>
                    <?php displayError($errors, 'confirmPassword');?>

                    <div><label class="label">Address:</label><textarea name="address" id="address"
                            placeholder="optional" <?php displayValue($_POST, 'address');?>></textarea></div>

                    <div><span class="checkLabel">Reffered? </span><input type="checkbox" name="check" id="check"
                            name="check" value="check" <?php displayValue($_POST, 'check');?>>Yes/No</div>
                    <?php displayError($errors, 'check');?>

                    <div><span class="agelabel">Age: (Use Slider)</span></div>
                    <input type="range" value="1" min="1" max="100" name="ageSlider" id="ageSlider"
                        oninput="ageUpdate(value)" />
                    <div class="output">Age: <output for="ageSlider" id="ageOutput">1</output></div>
                    <?php displayError($errors, 'ageSlider');?>

                    <h2>Membership Details</h2>
                    <div><span class="memLabel">Membership Duration: </span><select name="duration" id="duration">
                            <option value="select">--select--</option>
                            <option value="ongoing">Ongoing</option>
                            <option value="3month">3 Months</option>
                            <option value="6month">6 Months</option>
                            <option value="yearly">Yearly</option>
                        </select></div>
                    <?php displayError($errors, 'duration');?>

                    <div class="submit"><input name="submit" type="submit" value="Register" />
                    </div>
            </form>
        </div>
    </div>
</body>

</html>
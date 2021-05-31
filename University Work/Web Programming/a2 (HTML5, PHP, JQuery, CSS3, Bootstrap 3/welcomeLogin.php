<!-- The following code is an adaptation from Matthew Bolger code from tutorials and practicals. The code is modified to fit my assignment. -->
<?php require_once 'includes/authorise.inc.php';?>
<?php require_once 'includes/functions.inc.php';?>
<?php
$errors = [];
if (isset($_POST['login'])) {
    $errors = loginUser($_POST);

    if (count($errors) === 0) {
        header('Location: myFitness.php');
        exit();
    }
}
?>
<!DOCTYPE html>
<html>
<title>Welcome</title>

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
        <div class="content" id="content">
            <h1>Welcome! Please Login to verify Registration</h1>
            <form method="post">
                <div class="login">
                    <div><label class="label">Username:</label><input type="text" name="email" id="email"
                            placeholder="required" <?php displayValue($_POST, 'email');?> /></div>
                    <?php displayError($errors, 'email');?>
                    <div><label class="label">Password:</label><input type="password" name="password" id="password"
                            placeholder="required" /></div>
                    <?php displayError($errors, 'password');?>
                    <div><span class="submit"></span><input type="submit" name="login" value="Login" /></div>
                </div>
            </form>
        </div>
</body>

</html>
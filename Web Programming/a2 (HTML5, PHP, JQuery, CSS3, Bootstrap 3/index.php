<!-- The following code mine and not adapted from any tutes or labs. -->
<!DOCTYPE html>
<html>
<title>ABC Home</title>

<head>
    <link rel="stylesheet" type="text/css" href="styles/IndexStyle.css">
    <link rel="shortcut icon" href="assets/images/faviconLogo.png" />
    <script src="scripts/script.js"></script>
</head>

<body>
    <div class="main">
        <?php 
        require_once("includes/header.php");
        require_once("includes/logo.php");
        require_once("includes/navbar.php");
        require_once("includes/footer.php");
        ?>
        <div class="content" id="content">
            <div class=topInfo>
                <h1>Welcome to Adrenaline Buzz Club</h1>
                <p>We have transitioned to online training! To register for a club membership click
                    <a href="registration.php">here</a>
                </p>
            </div>
            <div class=mainInfo>
                <p>Your favorite excercises, instructors, programs, and activites are now fully available online for you
                    to view at anytime. If you notice any specific items are missing that you would like added,
                    please feel
                    free to contact us using the <a href="contactUs.php">Contact Us</a>
                    page. </p>
                <p>We'll keep you updated here on our homepage for re-opening information as soon as it becomes
                    available!</p>
                <p>Please check out our <a href="services.php">Services
                        Page</a> for more
                    information on the services our club provides.</p>
                <!-- All photos from www.Pexels.com -->
                <div><img class=kettleImage src="assets/images/kettlePushUp.jpeg">
                    <img class=barbellImage src="assets/images/barbell.jpeg">
                    <img class=ropesImage src="assets/images/partnerRopes.jpeg">
                </div>
            </div>
        </div>
    </div>
</body>

</html>
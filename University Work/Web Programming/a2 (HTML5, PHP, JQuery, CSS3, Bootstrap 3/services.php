<!-- The following code mine and not adapted from any tutes or labs. -->
<!DOCTYPE html>
<html>
<title>ABC Services</title>

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
                <h1>Services</h1>
                <p>All services are included in the price of your membership</p>
            </div>
            <div class="mainInfo">
                <div class="left">
                    <h2>ABC offers the following services face-to-face</h2>
                    <div class="leftServices">
                        <p>Live face-to-face training classes</p>
                        <p>At home training tips</p>
                        <p>Lockdown dieting information</p>
                        <p>Healthy Recipes</p>
                        <p>Swimming Pool</p>
                        <p>Free Weight Center</p>
                        <p>Running Track</p>
                        <p>Basketball Courts</p>
                        <p>Badminton Courts</p>
                        <p>Squash Courts</p>
                        <p>Physical Therapy</p>
                        <p>Yoga</p>
                        <p>Kid Camps</p>
                        <p>Infant Care</p>
                        <p>Spa</p>
                        <p>Bistro</p>
                        <p>Birthday Parties</p>
                        
                    </div>
                </div>
                <div class="right">
                    <h2>ABC offers the following services online</h2>
                    <div class="rightServices">
                        <p>Live online training classes</p>
                        <p>At home training tips</p>
                        <p>Lockdown dieting information</p>
                        <p>Healthy Recipes</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>

</html>
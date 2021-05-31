<!-- The following code mine and not adapted from any tutes or labs. -->
<!DOCTYPE html>
<html>
<title>ABC Contact</title>

<head>
    <link rel="stylesheet" type="text/css" href="styles/IndexStyle.css">
    <link rel="shortcut icon" href="assets/images/faviconLogo.png" />
    <!-- cdn's for JQuery and "Jquery Validation" plugin used for Contact Form Validation -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="plugin/jquery.validate.js"></script>
    <script src="plugin/jquery.validate.min.js"> </script>
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
            <h1> Contact Us </h1>
            <div class="contact">
                <!-- address and phone number for Sofitel Hotel, I chose a location at random -->
                <div class="mainContact">
                    <div class="address">
                        <p>Address:<br>25 Collins Street<br>Casey, Victoria, 3805</p>
                    </div>
                    <div class="phoneNo">
                        <p>Phone No:<br>+61 3 9653 0000</p>
                    </div>
                </div>
                <div class="contactQuery">
                    <div class="message">
                        <p>Feel free to ask questions or make suggestions on features you would like to see added to the site below</p>
                    </div>
                    <form id="contact" name="contact" action="mailto:admin@abcgym.com.au">
                        <label class="label">Email: </label><input type="email" id="email" name="email" required
                            placeholder="required" /><br>
                        <label class="addrLabel">Question: </label>
                        <textarea id="question" name="question" placeholder="required" rows="7" required
                            cols="40"></textarea><br>

                        <div><input type="submit" value="Submit"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>


</html>
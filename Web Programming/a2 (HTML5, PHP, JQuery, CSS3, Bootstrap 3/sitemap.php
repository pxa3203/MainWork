<!-- The following code mine and not adapted from any tutes or labs. -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sitemap</title>
</head>

<body>
    <div class="main">
        <?php
require_once "includes/header.php";
require_once "includes/logo.php";
require_once "includes/navbar.php";
require_once "includes/footer.php";
?>
<!-- sitemap list -->
        <div class="content" id="content">
            <section>
                <ol id="breadcrumbs"></ol>
                <nav id="sitemaps">
                    <h1>Sitemap</h1>
                    <ul id="official">
                        <li>
                            <a href="index.php">Home</a>
                            <ul>
                                <li><a href="services.php">Services</a></li>
                                <li><a href="registration.php">Registration</a></li>
                                <ul>
                                    <li><a href="welcomeLogin.php">Welcome Login</a></li>
                                </ul>
                                <li><a href="contactUs.php">Contact Us</a></li>
                                <li><a href="login.php">Login</a></li>
                                <ul>
                                    <li><a href="myFitness.php">My Fitness</a></li>
                                    <ul>
                                        <li><a href="category.php">Category</a></li>
                                        <li><a href="createActivity.php">Create Activity</a></li>
                                        <li><a href="logout.php">Logout</a></li>
                                    </ul>
                                </ul>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </section>
        </div>
</body>

</html>
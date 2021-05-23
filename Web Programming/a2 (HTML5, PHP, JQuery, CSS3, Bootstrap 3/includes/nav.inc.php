<!-- The following code is an adaptation from Matthew Bolger code from tutorials and practicals. The code is modified to fit my assignment. -->
<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-3">
    <div class="container">
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav">
                <a href="index.php" class="nav-item nav-link">Home</a>
                <?php if(isUserLoggedIn()) { ?>
                    <a href="myFitness.php" class="nav-item nav-link">myFitness</a>
                    <a href="logbook.php" class="nav-item nav-link">Log Book</a>
                <?php } ?>
            </div>
            <div class="navbar-nav ml-auto">
                <?php if(isUserLoggedIn()) { ?>
                    <span class="nav-item nav-link text-light">
                        Welcome, <?= getLoggedInUser()['fName']; ?>
                    </span>
                    <a href="logout.php" class="nav-item nav-link">Logout</a>
                <?php } else { ?>
                    <a href="register.php" class="nav-item nav-link">Register</a>
                    <a href="login.php" class="nav-item nav-link">Login</a>
                <?php } ?>
            </div>
        </div>
    </div>
</nav>

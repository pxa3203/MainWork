<!-- The following code is an adaptation from Matthew Bolger code from tutorials and practicals. The code is modified to fit my assignment. -->
<?php
    require_once('functions.inc.php');

    if(!isUserLoggedIn()) {
        header('Location: login.php');
        exit();
    }

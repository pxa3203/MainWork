<!-- The following code is an adaptation from Matthew Bolger code from tutorials and practicals. The code is modified to fit my assignment. -->
<?php require_once('includes/authorise.inc.php'); ?>
<?php
$user = getLoggedInUser();
$errors = [];
if (isset($_POST['submit'])) {
    $errors = createVitalStats($_POST, $user['email']);

    if (count($errors) === 0) {
        header('Location: myFitness.php');
        exit();
    }
}
?>
<?php
    $vitalStats = readCategories();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once('includes/head.inc.php'); ?>
</head>

<body>
    <?php require_once('includes/nav.inc.php'); ?>
<!-- ability to add workout to specific users -->
    <div class="container">
        <div class="mb-3">
            <h1 class="display-1">Log Book</h1>
            <p class="lead">Please add body information and activity goal:</p>
        </div>

        <div class="row">
            <form method="post">
                <div class="form-group align-items-center">
                    <label for="height">Please enter your Height in Centimeteres:</label>
                    <input type="text" class="form-control" id="height" name="height" aria-describedby="heightHelp"
                        placeholder="Enter Height">
                        <?php displayError($errors, 'height'); ?>
                </div>
                <div class="form-group">
                    <label for="weight">Please enter your Weight in Kilograms:</label>
                    <input type="text" class="form-control" id="weight" name="weight" placeholder="Enter Weight">
                    <?php displayError($errors, 'weight'); ?>
                </div>
                <div class="form-group">
                    <label for="activity">Please enter your Daily Activity Goal:</label>
                    <input type="text" class="form-control" id="activity" name="activity" placeholder="Enter Activity Goal">
                    <?php displayError($errors, 'activity'); ?>
                </div>
                
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </form>

            <div class="mt-3" id="ajax-result"></div>
        </div>

        <?php require_once('includes/footer.inc.php'); ?>
    </div>
</body>

</html>
<!-- The following code is an adaptation from Matthew Bolger code from tutorials and practicals. The code is modified to fit my assignment. -->
<?php require_once 'includes/authorise.inc.php';?>
<?php
$user = getLoggedInUser();
$category = getCategory($_GET['category']);
$userStats = getUserStatsForCategory($user['email'], $category['key']);

$errors = [];
if (isset($_POST['createActivity'])) {
    $errors = createActivity($_POST, $user['email'], $category['key']);

    if (count($errors) === 0) {
        header("Location: category.php?category={$category['key']}");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once 'includes/head.inc.php';?>
</head>

<body>
    <!-- allows user to press on icon and get taken to this page to add the activity to their profile -->
    <?php require_once 'includes/nav.inc.php';?>

    <div class="container">
        <div class="mb-3">
            <h1 class="display-1">myFitness</h1>
            <h1>
                <img src="assets/images/<?=$category['image-name'];?>" class="d-block d-sm-inline-block" />
                <?=$category['name'];?>
            </h1>
        </div>

        <div class="row">
            <div class="col-md-6">
                <form method="post">
                    <div class="form-group">
                        <label for="date">
                            *Date
                            <small class="text-muted">
                                format: dd-mm-yyyy, for example today would be <?=date(DATE_FORMAT);?>
                            </small>
                        </label>
                        <input type="text" class="form-control" id="date" name="date"
                            <?php displayValue($_POST, 'date');?> />
                        <?php displayError($errors, 'date');?>
                    </div>

                    <div class="form-group">
                        <label for="minutes">
                            *Duration (minutes)
                            <small class="text-muted">
                                minimum <?=MINUTES_MINIMUM;?> minute, maximum <?=MINUTES_MAXIMUM;?> minutes
                            </small>
                        </label>
                        <input type="text" class="form-control" id="minutes" name="minutes"
                            <?php displayValue($_POST, 'minutes');?> />
                        <?php displayError($errors, 'minutes');?>
                    </div>

                    <button type="submit" class="btn btn-primary mr-5" name="createActivity" value="createActivity">
                        Create activity
                    </button>
                    <a href="category.php?category=<?=$category['key'];?>" class="btn btn-outline-dark">Cancel</a>
                </form>
            </div>
        </div>

        <?php require_once 'includes/footer.inc.php';?>
    </div>
</body>

</html>
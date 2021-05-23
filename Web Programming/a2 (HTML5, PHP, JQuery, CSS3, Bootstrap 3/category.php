<!-- The following code is an adaptation from Matthew Bolger code from tutorials and practicals. The code is modified to fit my assignment. -->
<?php require_once 'includes/authorise.inc.php';?>
<?php
$user = getLoggedInUser();
$category = getCategory($_GET['category']);
$userStats = getUserStatsForCategory($user['email'], $category['key']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once 'includes/head.inc.php';?>
</head>

<body>
    <?php require_once 'includes/nav.inc.php';?>
    <!-- shows results of the activities -->
    <div class="container">
        <div class="mb-3">
            <h1 class="display-1">myFitness</h1>
            <h1>
                <img src="assets/images/<?=$category['image-name'];?>" class="d-block d-sm-inline-block" />
                <?=$category['name'];?>
            </h1>
        </div>

        <div class="mb-3">
            <a href="createActivity.php?category=<?=$category['key'];?>" class="btn btn-success mr-5">
                Record activity
            </a>
            <a href="myFitness.php" class="btn btn-outline-dark">Back to myFitness</a>
        </div>

        <?php if (count($userStats) !== 0) {?>
        <table class="table table-striped">
            <thead class="thead-light">
                <tr>
                    <th>Date</th>
                    <th>Duration (minutes)</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($userStats as $value) {?>
                <tr>
                    <td><?=$value['date'];?></td>
                    <td><?=$value['minutes'];?></td>
                </tr>
                <?php }?>
            </tbody>
        </table>
        <?php } else {?>
        <p class="alert alert-info">You have not yet recorded any activities in this category.</p>
        <?php }?>

        <?php require_once 'includes/footer.inc.php';?>
    </div>
</body>

</html>
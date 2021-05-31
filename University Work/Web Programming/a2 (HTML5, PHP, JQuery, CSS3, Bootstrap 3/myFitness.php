<!-- The following code is an adaptation from Matthew Bolger code from tutorials and practicals. The code is modified to fit my assignment. -->

<?php require_once 'includes/authorise.inc.php';?>
<?php
$user = getLoggedInUser();
$categories = readCategories();
$vitalStats = getUserVitalStats($user['email']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once 'includes/head.inc.php';?>
    <!-- <script src="scripts/script.js"></script> -->
</head>

<body>
    <?php require_once 'includes/nav.inc.php';?>
    <div class="mb-3">
        <!-- weather API -->
        <div class="col">
            <div class="weather-container text-center">
                <div class="weather-icon"></div>
                <div class="temp-value">
                    <h4 class="m-0"> </h4>
                </div>
                <div class="temp-desc">
                    <p class="m-0"> </p>
                </div>
                <div class="location">
                    <p class="m-0"> </p>
                </div>
                <div class="motivation">
                    <p class="m-0"> </p>
                </div>
            </div>
        </div>
        <script>
        const iconElement = document.querySelector('.weather-icon');
        const valueElement = document.querySelector('.temp-value h4');
        const descElement = document.querySelector('.temp-desc p');
        const locationElement = document.querySelector('.location p');
        const motivation = document.querySelector('.motivation p');

        $.getJSON(
            // imperial units becuase USA is #1
            "https://api.openweathermap.org/data/2.5/weather?lat=-37.81753&lon=144.96715&units=imperial&appid=619341398d50c8bc2f10716f41338124",
            //weather function
            function(data) {
                console.log(data);
                var icon = data.weather[0].icon;
                var temp = data.main.temp;
                var desc = data.weather[0].description;
                var location = data.name;

                iconElement.innerHTML = `<img src="http://openweathermap.org/img/wn/${icon}@2x.png"/>`;
                valueElement.innerHTML = temp + '°<span>F</span>';
                descElement.innerHTML = desc;
                locationElement.innerHTML = location;
                if (temp < 40) {
                    motivation.innerHTML = 'Grab the jacket and gloves and get out there, you can do it!';
                } else if (temp < 60) {
                    motivation.innerHTML =
                        'Bit chilly, but still a great day to get some activity in, you can do it!';
                } else if (temp > 60) {
                    motivation.innerHTML = 'Today is beautful day, get out there and get to work!';
                }
            });
        </script>
    </div>
    <div class="container">
        <div>
            <p class="lead">Choose any of the following categories of exercises:</p>
            <label for="text">Search for Categories as well!
                <small class="text-muted">leave empty to view all matches</small>
            </label>
            <input type="text" class="form-control" id="text" name="text" placeholder="e.g., running" />
        </div>

        <div class="row">
            <?php foreach ($categories as $key => $value) {?>
            <div class="col-md-3 text-center mr-2" id=<?=$value['name'];?>>
                <a href="category.php?category=<?=$key;?>">
                    <img class="border rounded" src="assets/images/<?=$value['image-name'];?>" />
                </a>
                <p><?=$value['name'];?></p>
            </div>
            <?php }?>
        </div>
        <!-- search AJAX -->
        <script>
        var $divs = $('.col-md-3.text-center.mr-2');
        $('#text').bind('keyup', function() {
            var text = this.value;
            if (!text) {
                $divs.show();
            } else {
                $divs.hide().filter(function() {
                    return this.id.toLowerCase().indexOf(text) > -1;
                }).show()
            }
        });
        </script>
        <!-- displaying the users body/activity details -->
        <div class="container">
            <div class="col-md-3 text-center">
                <?php foreach ($vitalStats as $value) {?>
                <table class="tablecenterCSS table table-hover table-bordered">
                    <tr>
                        <th>Details</th>
                        <th>Values</th>
                    </tr>
                    <tr>
                        <td>Weight:</td>
                        <td><?=$value['height'];?> centimeters</td>
                    </tr>
                    <tr>
                        <td>Height:</td>
                        <td><?=$value['weight'];?> kilograms</td>
                    </tr>
                    <tr>
                        <td>Activity Goal:</td>
                        <td><?=$value['activity'];?> minutes</td>
                    </tr>
                </table>
                <?php }?>
            </div>
        </div>

        <?php require_once 'includes/footer.inc.php';?>
    </div>
</body>

</html>
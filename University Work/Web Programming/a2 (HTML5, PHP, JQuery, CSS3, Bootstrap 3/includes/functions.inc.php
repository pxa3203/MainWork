<!-- The following code is an adaptation from Matthew Bolger code from tutorials and practicals. The code is modified to fit my assignment. -->
<?php
const USERS_PATH = 'data/users.json';
const USER_STATS_PATH = 'data/user_stats.json';
const CATEGORIES_PATH = 'data/categories.json';

const USER_SESSION_KEY = 'user';

const MINUTES_MINIMUM = 1;
const MINUTES_MAXIMUM = 720;

const DATE_FORMAT = 'd-m-Y';

// Always call session_start.
session_start();

// --- Utils ----------------------------------------------------------------------------------
function readJsonFile($path)
{
    $json = file_get_contents($path);

    return json_decode($json, true);
}

function updateJsonFile($data, $path)
{
    $json = json_encode($data, JSON_PRETTY_PRINT);
    file_put_contents($path, $json, LOCK_EX);
}

function displayError($errors, $name)
{
    if (isset($errors[$name])) {
        echo "<div class='text-danger'>{$errors[$name]}</div>";
    }

}

function displayValue($form, $name)
{
    if (isset($form[$name])) {
        echo 'value="' . htmlspecialchars($form[$name]) . '"';
    }

}

// If using PHP >= 5.5 do not use this function, use the password_hash function:
// https://www.php.net/manual/en/function.password-hash.php
function generatePasswordHash($password, $salt = null)
{
    if ($salt === null) {
        $salt = randomString(20);
    }

    $blowfish_salt = '$2y$10$' . $salt . '$';

    return crypt($password, $blowfish_salt);
}

// If using PHP >= 5.5 do not use this function, use the password_verify function:
// https://www.php.net/manual/en/function.password-verify.php
function verifyPasswordHash($password, $hash)
{
    $tokens = explode('$', $hash);
    $salt = $tokens[3];

    return $hash === generatePasswordHash($password, $salt);
}

// Only needed due to the generatePasswordHash function.
function randomString($length)
{
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';

    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $randomString;
}

// Source: https://www.php.net/manual/en/function.checkdate.php#113205
function isDateValid($date, $format = DATE_FORMAT)
{
    $d = DateTime::createFromFormat($format, $date);

    return $d && $d->format($format) === $date;
}

// --- Categories -----------------------------------------------------------------------------
function readCategories()
{
    return readJsonFile(CATEGORIES_PATH);
}

function getCategory($category)
{
    $categories = readCategories();

    return isset($categories[$category]) ? $categories[$category] : null;
}

// --- User Stats -----------------------------------------------------------------------------
function readUserStats()
{
    return readJsonFile(USER_STATS_PATH);
}

function updateUserStats($userStats)
{
    updateJsonFile($userStats, USER_STATS_PATH);
}

function getUserStats($email)
{
    $userStats = readUserStats();

    // An empty array is returned if stats are not set - used to streamline the code for readind & inserting.
    return isset($userStats[$email]) ? $userStats[$email] : [];
}

function getUserStatsForCategory($email, $category)
{
    $userStats = getUserStats($email);

    // An empty array is returned if stats are not set - used to streamline the code for readind & inserting.
    return isset($userStats[$category]) ? $userStats[$category] : [];
}

function getUserVitalStats($email)
{
    $userStats = getUserStats($email);

    // An empty array is returned if stats are not set - used to streamline the code for readind & inserting.
    return isset($userStats['vitalStats']) ? $userStats['vitalStats'] : [];
}

function createActivity($form, $email, $category)
{
    $errors = [];

    $key = 'date';
    if (!isset($form[$key]) || !isDateValid($form[$key])) {
        $errors[$key] = 'Date is required and must be in the format dd/mm/yyyy.';
    }

    $key = 'minutes';
    if (!isset($form[$key]) || filter_var($form[$key], FILTER_VALIDATE_INT,
        ['options' => ['min_range' => MINUTES_MINIMUM, 'max_range' => MINUTES_MAXIMUM]]) === false) {
        $errors[$key] =
            implode(['Minutes is required and must be between ', MINUTES_MINIMUM, ' and ', MINUTES_MAXIMUM, '.']);
    }
    // Convert validated minutes to an integer for future use (storing as number rather than string in JSON).
    else {
        $form[$key] = (int) $form[$key];
    }

    if (count($errors) === 0) {
        // Add activity.
        $activity = [
            'date' => htmlspecialchars(trim($form['date'])),
            'minutes' => $form['minutes'],
        ];

        $userStats = readUserStats();
        $userStats[$email][$category][] = $activity;

        // Update file.
        updateUserStats($userStats);
    }

    return $errors;
}

function createVitalStats($form, $email)
{
    $errors = [];

    $key = 'height';
    if (!isset($form[$key]) || !is_numeric($form[$key])) {
        $errors[$key] = 'Please enter a number';
    }
    $key = 'weight';
    if (!isset($form[$key]) || !is_numeric($form[$key])) {
        $errors[$key] = 'Please enter a number';
    }
    $key = 'activity';
    if (!isset($form[$key]) || !is_numeric($form[$key])) {
        $errors[$key] = 'Please enter a number';
    }
    // Convert validated inputs to an integer for future use (storing as number rather than string in JSON).
    else {
        $form[$key] = (int) $form[$key];
    }

    if (count($errors) === 0) {
        // Add activity.
        $vitalStats = [
            'height' => htmlspecialchars(trim($form['height'])),
            'weight' => htmlspecialchars(trim($form['weight'])),
            'activity' => htmlspecialchars(trim($form['activity']))
        ];

        $userStats = readUserStats();
        $userStats[$email]["vitalStats"][] = $vitalStats;

        // Update file.
        updateUserStats($userStats);
    }

    return $errors;
}

// --- User -----------------------------------------------------------------------------------
function readUsers()
{
    return readJsonFile(USERS_PATH);
}

function updateUsers($users)
{
    updateJsonFile($users, USERS_PATH);
}

function getUser($email)
{
    $users = readUsers();

    return isset($users[$email]) ? $users[$email] : null;
}

function isUserLoggedIn()
{
    return isset($_SESSION[USER_SESSION_KEY]);
}

function getLoggedInUser()
{
    return isUserLoggedIn() ? $_SESSION[USER_SESSION_KEY] : null;
}

function loginUser($form)
{
    $errors = [];

    $key = 'email';
    if (!isset($form[$key]) || filter_var($form[$key], FILTER_VALIDATE_EMAIL) === false) {
        $errors[$key] = 'Email is invalid.';
    }

    $key = 'password';
    if (!isset($form[$key]) || strlen($form[$key]) < 6) {
        $errors[$key] = 'Password is required and must contain at least 6 characters.';
    }

    if (count($errors) === 0) {
        $user = getUser($form['email']);

        // If using PHP >= 5.5 use the password_verify function.
        // if($user !== null && password_verify($form['password'], $user['password-hash']))
        if ($user !== null && verifyPasswordHash($form['password'], $user['password-hash']))
        // Login user.
        {
            $_SESSION[USER_SESSION_KEY] = $user;
        } else {
            $errors[$key] = 'Login failed, email and / or password incorrect. Please try again.';
        }

    }

    return $errors;
}

function logoutUser()
{
    session_unset();
    // OR
    // unset($_SESSION[USER_SESSION_KEY]);
}

function registerUser($form)
{
    $errors = [];

    $key = 'fName';
    if (!isset($form[$key]) || preg_match('/^\s*$/', $form[$key]) === 1) {
        $errors[$key] = 'First name is required.';
    }

    $key = 'surname';
    if (!isset($form[$key]) || preg_match('/^\s*$/', $form[$key]) === 1) {
        $errors[$key] = 'Last name is required.';
    }

    $key = 'email';
    if (!isset($form[$key]) || filter_var($form[$key], FILTER_VALIDATE_EMAIL) === false) {
        $errors[$key] = 'Email is invalid.';
    } else if (getUser($form[$key]) !== null) {
        $errors[$key] = 'Email is already registered.';
    }

    $key = 'check';
    if (empty($_POST["check"])) {
        $errors[$key] = 'Please select referral status.';
    }

    $key = 'ageSlider';
    if (($_POST['ageSlider']) < 16) {
        $errors[$key] = 'Age must be at least 16';
    }

    $key = 'duration';
    if (($_POST['duration'] === 'select')) {
        $errors[$key] = 'Please select a membership duration';
    }

    $key = 'password';
    // put custom made password regex in seperate variable below for read-ability purposes:
    $passwordRegex = '/^[A-Z](?=.*?[!^&]).{4,}\d$/';
    if (!isset($form[$key]) || preg_match($passwordRegex, $form[$key]) !== 1) {
        $errors[$key] = 'Password is not fit.';
    }

    $key = 'confirmPassword';
    if (isset($form['password']) && (!isset($form[$key]) || $form['password'] !== $form[$key])) {
        $errors[$key] = 'Passwords do not match.';
    }

    if (count($errors) === 0) {
        // Add user.
        $user = [
            'fName' => htmlspecialchars(trim($form['fName'])),
            'surname' => htmlspecialchars(trim($form['surname'])),
            'email' => htmlspecialchars(trim($form['email'])),
            'address' => htmlspecialchars(trim($form['address'])),
            'ageSlider' => htmlspecialchars(trim($form['ageSlider'])),
            'check' => htmlspecialchars(trim($form['check'])),
            'password-hash' => generatePasswordHash($form['password']),
            // If using PHP >= 5.5 use the password_hash function.
            // 'password-hash' => password_hash($form['password'], PASSWORD_DEFAULT)
        ];

        $users = readUsers();
        $users[$user['email']] = $user;

        // Update file.
        updateUsers($users);

        // Auto-login registered user.
        loginUser([
            'email' => $user['email'],
            'password' => $form['password'],
        ]);
    }

    return $errors;
}
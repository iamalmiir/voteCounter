<?php
global $pdo;
$page_title = "Create Account";
require_once __DIR__ . "/../../config.php";
require_once __DIR__ . "/../components/formInput.php";
require_once __DIR__ . "/../components/formHeader.php";
require_once __DIR__ . "/../components/button.php";

if (isset($_SESSION['user_id'])) {
    header("Location: /vote.php");
    exit();
}

// check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // get form data
    $fullName = $_POST["fullName"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];

    $email_exists = $pdo->query("SELECT * FROM users WHERE email='$email'");
    $username_exists = $pdo->query("SELECT * FROM users WHERE username='$username'");

    if ($email_exists->rowCount() > 0 || $username_exists->rowCount() > 0) {
        echo "User already exists.";
        exit();
    }

    // insert user data into database
    $sql = $pdo->query("INSERT INTO users (full_name, username, password, email)
    VALUES ('$fullName', '$username', '$password', '$email')");
    // redirect to login page
    header("Location: /account/login.php");
    exit();
}
?>
<div class="flex min-h-full flex-col justify-center py-12 sm:px-6 lg:px-8">
    <?php
    echo formHeader("Create an Account", "Already have an account?", "Log in", "login.php");
    ?>
    <div class="mt-8 p-4 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white px-4 py-8 shadow-xl sm:rounded-lg sm:px-10">
            <form class="space-y-6" method="POST">
                <?php
                echo formInput("Full Name", "fullName", "text");
                echo formInput("Username", "username", "text");
                echo formInput("Email", "email", "email");
                echo formInput("Password", "password", "password");
                echo button("Register", "submit");
                ?>
            </form>
        </div>
    </div>
</div>

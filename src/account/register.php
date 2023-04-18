<?php
global $pdo;
$page_title = "Create Account";
require_once __DIR__ . "/../../config.php";
require_once __DIR__ . "/../components/formInput.php";
require_once __DIR__ . "/../components/button.php";

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
    header("Location: login.php");
    exit();
}
?>
<div class="flex min-h-full flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <i class="fa-solid fa-user-plus flex mx-auto h-12 w-auto text-sky-950"></i>
        <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-sky-950">
            Create an Account
        </h2>
        <p class="mt-2 text-center text-sm text-gray-600">
            Already have an account?
            <a href="login.php" class="font-medium text-sky-600 hover:text-sky-500">
                Log in
            </a>
        </p>
    </div>

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

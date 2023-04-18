<?php
require_once __DIR__ . "/../../config.php";
require_once __DIR__ . "/../components/formInput.php";
require_once __DIR__ . "/../components/button.php";
global $pdo;
global $page_title;
$page_title = "Login";
// check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // get form data
    $username = $_POST["username"];
    $password = $_POST["password"];

    // check if entered username and password match a user in the database
    try {
        $sql = $pdo->query("SELECT * FROM users WHERE username='$username' AND password='$password'");

        // if a user is found, set session variables and redirect to home page
        if ($sql->rowCount() > 0) {
            $user = $sql->fetch(PDO::FETCH_ASSOC);
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['fullName'] = $user['full_name'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['isAdmin'] = $user['is_admin'];
            header("Location: /voteCounter/src/vote.php");
            exit();
        } else {
            $error_message = "Invalid username or password.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }


}
if (isset($error_message)) {
    $message = $error_message;
    $err = true;
    require_once __DIR__ . "/../components/infoBanner.php";
}
?>

<div class="flex min-h-full flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <i class="fa-solid fa-user flex mx-auto h-12 w-auto text-sky-950"></i>
        <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-sky-950">
            Log in to your account
        </h2>
        <p class="mt-2 text-center text-sm text-gray-600">
            Don't have an account?
            <a href="register.php" class="font-medium text-sky-600 hover:text-sky-500">
                Create an account
            </a>
        </p>
    </div>

    <div class="mt-8 sm:mx-auto p-4 sm:w-full sm:max-w-md">
        <div class="bg-white px-4 py-8 shadow-xl sm:rounded-lg sm:px-10">
            <form class="space-y-6" method="POST">
                <?php
                echo formInput("Username", "username", "text");
                echo formInput("Password", "password", "password");
                echo button("Login", "submit");
                ?>
            </form>
        </div>
    </div>
</div>


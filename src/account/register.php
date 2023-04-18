<?php
global $pdo;
$page_title = "Create Account";
require_once __DIR__ . "/../../config.php";

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
    $sql = $pdo->query("INSERT INTO users (full_name, username, password, email) VALUES ('$fullName', '$username', '$password', '$email')");
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
                <div>
                    <label for="fullName" class="block text-sm font-medium leading-6 text-sky-950">
                        Full Name
                    </label>
                    <div class="mt-2">
                        <input id="fullName" name="fullName" type="text" required
                               class="block w-full rounded-md border-transparent p-1.5 text-sky-950 shadow-sm ring-1 ring-inset ring-gray-300 focus:outline-0 placeholder:text-gray-400 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div>
                    <label for="username" class="block text-sm font-medium leading-6 text-sky-950">
                        Username
                    </label>
                    <div class="mt-2">
                        <input id="username" name="username" type="text" required
                               class="block w-full rounded-md border-transparent p-1.5 text-sky-950 shadow-sm ring-1 ring-inset ring-gray-300 focus:outline-0 placeholder:text-gray-400 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium leading-6 text-sky-950">
                        Email
                    </label>
                    <div class="mt-2">
                        <input id="email" name="email" type="email" required
                               class="block w-full rounded-md border-transparent p-1.5 text-sky-950 shadow-sm ring-1 ring-inset ring-gray-300 focus:outline-0 placeholder:text-gray-400 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium leading-6 text-sky-950">Password</label>
                    <div class="mt-2">
                        <input id="password" name="password" type="password" autocomplete="current-password" required
                               class="block w-full rounded-md border-0 p-1.5 border-transparent text-sky-950 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:outline-0 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div>
                    <button type="submit"
                            class="flex w-full justify-center rounded-md bg-sky-950 px-3 py-2 text-sm font-semibold text-white shadow-md hover:bg-sky-900 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        Register
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

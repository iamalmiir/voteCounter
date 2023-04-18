<?php
// start session
session_start();
// If user is already logged in, redirect to appropriate page
if (isset($_SESSION["username"]) && $_SERVER['REQUEST_URI'] !== '/voteCounter/src/vote.php' && $_SESSION["isAdmin"] ==
    0) {
    header("Location: /voteCounter/src/vote.php");
    exit();
} else if (isset($_SESSION["username"]) && $_SERVER['REQUEST_URI'] !== '/voteCounter/src/admin.php' && $_SESSION["isAdmin"] == 1) {
    header("Location: /voteCounter/src/admin.php");
    exit();
} else if (!isset($_SESSION["username"]) && $_SERVER['REQUEST_URI'] !== '/voteCounter/src/account/login.php' && $_SERVER['REQUEST_URI'] !== '/voteCounter/src/account/register.php') {
    header("Location: /voteCounter/src/account/login.php");
    exit();
}

require_once __DIR__ . "/vendor/autoload.php";
// Load .env variables
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
// Connect to database
global $pdo;
global $page_title;
$host = $_ENV['DB_HOST'];
$dbname = $_ENV['DB_NAME'];
$port = $_ENV['DB_PORT'];
$username = $_ENV['DB_USER'];
$password = $_ENV['DB_PASSWORD'];

try {
    $conn_string = "pgsql:host=$host;port=$port;dbname=$dbname;user=$username;password=$password";
    $pdo = new PDO($conn_string);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"
            integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"
            integrity="sha512-fD9DI5bZwQxOi7MhYWnnNPlvXdp/2Pj3XSTRrFs5FQa4mizyGLnJcN6tuvUS6LbmgN1ut+XGSABKvjN0H6Aoow=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <?php echo "<title>$page_title</title>"; ?>
</head>
<nav class="bg-white shadow">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 justify-between">
            <div class="flex">
                <div class="flex flex-shrink-0 items-center">
                    <i class="fa-solid fa-check-to-slot text-sky-950 block h-8 w-auto lg:hidden"></i>
                    <i class="fa-solid fa-check-to-slot text-sky-950 hidden h-8 w-auto lg:block"></i>
                </div>
            </div>
            <?php
            if (isset($_SESSION['username'])) {
                echo '<div class="hidden sm:ml-6 sm:flex sm:items-center">
                <div class="relative ml-3 cursor-pointer">
                    <a href="/voteCounter/src/account/logout.php"
                       class="flex rounded-md bg-sky-950 text-md text-white py-2 px-6 shadow-lg cursor-pointer hover:bg-sky-900
                       focus:outline-none"
                       id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                        Log out
                    </a>
                </div>
            </div>';
            } else if ($_SERVER['REQUEST_URI'] !== '/voteCounter/src/account/login.php') {
                echo '<div class="hidden sm:ml-6 sm:flex sm:items-center">
                <div class="relative cursor-pointer ml-3">
                    <a href="/voteCounter/src/account/login.php"
                       class="flex rounded-md bg-sky-950 text-md text-white py-2 px-6 shadow-lg cursor-pointer hover:bg-sky-900
                       focus:outline-none"
                       id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                        Login
                    </a>
                </div>
            </div>';
            }
            ?>
        </div>
    </div>
</nav>

<?php
// start session
session_start();
require_once __DIR__ . "/vendor/autoload.php";
require_once __DIR__ . "/src/components/button.php";
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

// Check if user has already voted
$sql = $pdo->prepare("SELECT * FROM scores WHERE user_id = :user_id");
$user_id = $_SESSION['user_id'];
$sql->execute(array('user_id' => $user_id));
$result = $sql->fetch(PDO::FETCH_ASSOC);

if (isset($_SESSION['username']) && !$_SESSION['isAdmin'] && !strpos($_SERVER['REQUEST_URI'], "vote.php") && !$result) {
    if (!strpos($_SERVER['REQUEST_URI'], "admin.php")) {
        header("Location: /vote.php");
        exit();
    }
} elseif (isset($_SESSION['username']) && $_SESSION['isAdmin'] && !strpos($_SERVER['REQUEST_URI'], "admin.php") && !$result) {
    if (!strpos($_SERVER['REQUEST_URI'], "vote.php")) {
        header("Location: /admin.php");
        exit();
    }
} elseif ((strpos($_SERVER['REQUEST_URI'], "admin.php") || strpos($_SERVER['REQUEST_URI'], "vote.php")) && !isset($_SESSION['username'])) {
    header("Location: /account/login.php");
    exit();
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
    <title>
        <?php echo $page_title; ?>
    </title>
</head>
<nav class="bg-white shadow">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 justify-between">
            <div class="flex">
                <div class="flex flex-shrink-0 items-center">
                    <i class="fa-solid fa-gavel text-sky-950 block h-8 w-auto lg:hidden"></i>
                    <i class="fa-solid fa-gavel text-sky-950 hidden h-8 w-auto lg:block"></i>
                </div>
            </div>
            <?php
            if (isset($_SESSION['username'])) {
                echo logInOutButton("Log out", "/account/logout.php");
            } elseif ($_SERVER['REQUEST_URI'] !== '/account/login.php') {
                echo logInOutButton("Log in", "/account/login.php");
            }
            ?>
        </div>
    </div>
</nav>

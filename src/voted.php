<?php
global $pdo;
$page_title = "Vote Submitted";
require_once __DIR__ . "/../config.php";
?>

<div class="bg-white px-6 py-24 sm:py-32 lg:px-8">
    <div class="mx-auto max-w-2xl text-center">
        <i class="fa-solid fa-check-to-slot text-6xl text-green-500 mb-6" style="color: #1dbf45;"></i>
        <h2 class="text-4xl font-bold tracking-tight text-sky-950 sm:text-6xl">
            We have received your vote!
        </h2>
        <p class="mt-6 text-lg leading-8 text-sky-600">
            Your vote has been recorded and will be counted.
        </p>
    </div>
</div>

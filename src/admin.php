<?php
global $conn;
global $page_title;
global $pdo;
$page_title = "Admin Page";
require_once __DIR__ . "/../config.php";
// Select all from scores table
$sql = $pdo->query("SELECT * FROM scores");
$scores = $sql->fetchAll(PDO::FETCH_ASSOC);

// Select all users that voted from users table using id from scores table
$sql = $pdo->query("SELECT * FROM users WHERE id IN (SELECT user_id FROM scores)");
$users = $sql->fetchAll(PDO::FETCH_ASSOC);

// Calculate the total score
$totalScore = 0;
foreach ($scores as $score) {
    $totalScore += $score['total_score'];
}

// Get the count of users
$userCount = count($users);

// Calculate the average score
if ($userCount > 0) {
    $averageScore = $totalScore / $userCount;
} else {
    $averageScore = 0;
}


function clearVotes()
{
    global $pdo;
    $sql = $pdo->prepare("DELETE FROM scores");
    $sql->execute();
    // refresh page without resubmitting form or redirecting
    echo "<meta http-equiv='refresh' content='0'>";
}

// Check if the button is clicked
if (isset($_POST['clear_votes'])) {
    clearVotes();
}
?>
<body>
<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="mt-12 px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900">
                    Judges and their votes
                </h1>
                <p class="mt-2 text-sm text-gray-700">
                    This is where you can see the votes of the judges.
                </p>
            </div>
            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                <?php
                // Display button to clear all votes
                echo '
            <form method="POST" action="">
                <button type="submit" name="clear_votes" class="block rounded-md bg-sky-950 px-3 py-2 text-center text-sm font-semibold text-white
                    shadow-sm hover:bg-sky-900 focus-visible:outline focus-visible:outline-2
                    focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    Clear all votes
                </button>
            </form>
            ';
                ?>
            </div>
        </div>
        <div class="mt-8 flow-root">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead>
                        <tr>
                            <th scope="col"
                                class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">
                                Name
                            </th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                Articulate Requirements
                            </th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                Choose appropriate tools
                            </th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                Give clear and coherent oral presentation
                            </th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                Functioned well as a team
                            </th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                Comments
                            </th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                        <?php
                        // List all scores from the database
                        for ($i = 0; $i < count($scores); $i++) {
                            echo "<tr>";
                            echo "<td class='whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0'>" . $users[$i]['full_name'] . "</td>";
                            echo "<td class='whitespace-nowrap px-3 py-4 text-sm text-gray-500'>" . $scores[$i]['articulate_requirements'] . "</td>";
                            echo "<td class='whitespace-nowrap px-3 py-4 text-sm text-gray-500'>" . $scores[$i]['appropriate_tools'] . "</td>";
                            echo "<td class='whitespace-nowrap px-3 py-4 text-sm text-gray-500'>" . $scores[$i]['coherent_oral_presentation'] . "</td>";
                            echo "<td class='whitespace-nowrap px-3 py-4 text-sm text-gray-500'>" . $scores[$i]['functioned_as_team'] . "</td>";
                            echo "<td class='whitespace-nowrap px-3 py-4 text-sm text-gray-500'>" . $scores[$i]['comments'] . "</td>";
                            echo "</tr>";
                        }
                        ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="mt-24">
            <h3 class="text-base font-semibold leading-6 text-gray-900">Stats</h3>

            <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
                <div class="relative overflow-hidden rounded-lg bg-white px-4 pb-12 pt-5 shadow sm:px-6 sm:pt-6">
                    <dt>
                        <div class="absolute rounded-md bg-sky-950 p-3">
                            <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/>
                            </svg>
                        </div>
                        <p class="ml-16 truncate text-sm font-medium text-gray-500">Total Votes</p>
                    </dt>
                    <dd class="ml-16 flex items-baseline pb-6 sm:pb-7">
                        <p class="text-2xl font-semibold text-gray-900">
                            <?php
                            echo count($scores);
                            ?>
                        </p>
                    </dd>
                </div>
                <div class="relative overflow-hidden rounded-lg bg-white px-4 pb-12 pt-5 shadow sm:px-6 sm:pt-6">
                    <dt>
                        <div class="absolute rounded-md bg-sky-950 p-3">
                            <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M21.75 9v.906a2.25 2.25 0 01-1.183 1.981l-6.478 3.488M2.25 9v.906a2.25 2.25 0 001.183 1.981l6.478 3.488m8.839 2.51l-4.66-2.51m0 0l-1.023-.55a2.25 2.25 0 00-2.134 0l-1.022.55m0 0l-4.661 2.51m16.5 1.615a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V8.844a2.25 2.25 0 011.183-1.98l7.5-4.04a2.25 2.25 0 012.134 0l7.5 4.04a2.25 2.25 0 011.183 1.98V19.5z"/>
                            </svg>
                        </div>
                        <p class="ml-16 truncate text-sm font-medium text-gray-500">
                            Avg. Vote
                        </p>
                    </dt>
                    <dd class="ml-16 flex items-baseline pb-6 sm:pb-7">
                        <p class="text-2xl font-semibold text-gray-900">
                            <?php
                            echo round($averageScore, 2);
                            ?>
                        </p>
                    </dd>
                </div>
            </dl>
        </div>
    </div>
</div>
</body>

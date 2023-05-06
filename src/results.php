<?php
global $pdo;
$page_title = "Vote";
require_once __DIR__ . "/../config.php";

// Select all from scores table
$sql = $pdo->query("SELECT * FROM scores");
$scores = $sql->fetchAll(PDO::FETCH_ASSOC);

// Select all users that voted from users table using id from scores table
$sql = $pdo->query("SELECT * FROM users WHERE id IN (SELECT user_id FROM scores)");
$users = $sql->fetchAll(PDO::FETCH_ASSOC);
function clearVotes()
{
    global $pdo;
    $sql = $pdo->prepare("DELETE FROM scores");
    $sql->execute();
    header("Location: /results.php");
    exit();
}

// Check if the button is clicked
if (isset($_POST['clear_votes'])) {
    clearVotes();
}
?>
<body>
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
                        <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">
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
</div>
</body>
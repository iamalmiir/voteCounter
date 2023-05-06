<?php
global $pdo;
$page_title = "Vote";
require_once __DIR__ . "/../config.php";
require __DIR__ . "/components/table_field.php";
require_once __DIR__ . "/components/button.php";
$current_user = $_SESSION['fullName'];
// Check if user has already voted
$sql = $pdo->prepare("SELECT * FROM scores WHERE user_id = :user_id");
$user_id = $_SESSION['user_id'];
$sql->execute(array('user_id' => $user_id));
$result = $sql->fetch(PDO::FETCH_ASSOC);

// Check if form is submitted
if ($result && !strpos((!strpos($_SERVER['REQUEST_URI'], "vote.php")), "voted.php")) {
    header("Location: /voteCounter/src/voted.php");
    exit();
}

// Get four users from database
$sql = $pdo->query("SELECT * FROM users WHERE is_admin = false LIMIT 4");
$users = $sql->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get input values from form only if they are not empty
    $articulateRequirements = $_POST['articulateRequirementsDeveloping'] ??
        $_POST['articulateRequirementsAccomplished'];
    $appropriateTools = $_POST['chooseAppropriateToolsDeveloping'] ??
        $_POST['chooseAppropriateToolsAccomplished'];
    $coherentOralPresentation = $_POST['giveClearAndCoherentOralPresentationDeveloping'] ??
        $_POST['giveClearAndCoherentOralPresentationAccomplished'];
    $functionalRequirements = $_POST['functionedWellAsATeamDeveloping'] ?? $_POST['functionedWellAsATeamAccomplished'];
    $comments = $_POST['comments'] ?? "";
    $totalScore = $appropriateTools + $articulateRequirements + $coherentOralPresentation + $functionalRequirements;

    // If user has not voted, insert new row into scores table
    $stmt = $pdo->prepare("INSERT INTO scores
        (user_id, articulate_requirements, appropriate_tools, coherent_oral_presentation,
         functioned_as_team, comments, total_score)
        VALUES
        (:user_id, :articulate_requirements, :appropriate_tools, :coherent_oral_presentation,
         :functional_requirements, :comments, :total_score)");
    $stmt->execute(array(
        'user_id' => $user_id,
        'articulate_requirements' => $articulateRequirements,
        'appropriate_tools' => $appropriateTools,
        'coherent_oral_presentation' => $coherentOralPresentation,
        'functional_requirements' => $functionalRequirements,
        'comments' => $comments,
        'total_score' => $totalScore
    ));
    $success = true;
    $message = "Your vote has been submitted.";
    header("Location: /voteCounter/src/voted.php");
    exit();
}

?>
<script src="js/main.js"></script>
<div class="mx-auto mt-14 max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-3xl text-center font-bold leading-6 text-sky-950">Computer Science Project</h1>
        </div>
    </div>
    <div class="mt-8 sm:flex sm:items-center">
        <div class="flex justify-start sm:flex-auto">
            <h1 class="text-base mr-2 font-semibold leading-6 text-sky-950">Group Members: </h1>
            <?php
            foreach ($users as $user) {
                echo "<p class='text-base text-sky-950'>" . $user['full_name'] . ",&nbsp;</p>";
            }
            ?>
        </div>
    </div>
    <div class="mt-8 flow-root">
        <form method="POST">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead>
                        <tr>
                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-md font-bold text-sky-950 sm:pl-0">
                                Criteria
                            </th>
                            <th scope="col" class="px-3 py-3.5 text-center text-md font-bold
                        text-gray-900">
                                Developing (0-10)
                            </th>
                            <th scope="col" class="px-3 py-3.5 text-center text-md font-bold text-sky-950">
                                Accomplished (10-15)
                            </th>
                        </tr>
                        </thead>
                        <?php
                        echo table_field('Articulate requirements', 'articulateRequirementsDeveloping', 'articulateRequirementsAccomplished');
                        echo table_field('Choose appropriate tools and methods for each task', 'chooseAppropriateToolsDeveloping', 'chooseAppropriateToolsAccomplished');
                        echo table_field('Give clear and coherent oral presentation', 'giveClearAndCoherentOralPresentationDeveloping', 'giveClearAndCoherentOralPresentationAccomplished');
                        echo table_field('Functioned well as a team', 'functionedWellAsATeamDeveloping', 'functionedWellAsATeamAccomplished');
                        ?>
                    </table>
                    <div class="flex justify-between min-w-full py-2">
                        <p class="text-md pl-4 font-medium text-sky-950 mt-2 sm:pl-0">
                            Comments:
                        </p>
                        <div class="w-1/2 mt-2">
                            <label for="comments"></label>
                            <textarea rows="4" name="comments" id="comments"
                                      class="block w-full rounded-md border-0 p-1.5 text-gray-900 shadow-sm ring-1
                                  ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset
                                  focus:ring-sky-600 sm:text-sm sm:leading-6"></textarea>
                        </div>
                    </div>
                    <div class="grid grid-rows">
                        <p class="text-md font-medium text-sky-950 mt-2">
                            Total Score: <span id="totalScore" class="text-base text-gray-500">0</span>
                        </p>
                        <p class="text-md font-medium text-sky-950 mt-2">
                            Judge's Name: <span class="text-base text-gray-500">
                            <?php
                            echo $current_user;
                            ?>
                        </span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="flex justify-end items-center mt-12">
                <?php
                echo button("Submit", "submit");
                ?>
            </div>
        </form>
    </div>
</div>
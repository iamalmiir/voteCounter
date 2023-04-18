<?php
require_once __DIR__ . "/../config.php";
require __DIR__ . "/components/table_field.php";
global $pdo;
global $page_title;
$page_title = "Create Account";

$current_user = "";
if (isset($_SESSION['fullName'])) {
    $current_user = $_SESSION['fullName'];
}

//$table_field = table_field('Articulate requirements', 'articulateRequirementsDeveloping', 'articulateRequirementsAccomplished');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get input values from form only if they are not empty
    $articulateRequirements = $_POST['articulateRequirementsDeveloping'] ?? $_POST['articulateRequirementsAccomplished'];
    $appropriateTools = $_POST['chooseAppropriateToolsDeveloping'] ?? $_POST['chooseAppropriateToolsAccomplished'];
    $coherentOralPresentation = $_POST['giveClearAndCoherentOralPresentationDeveloping'] ?? $_POST['giveClearAndCoherentOralPresentationAccomplished'];
    $functionalRequirements = $_POST['functionedWellAsATeamDeveloping'] ?? $_POST['functionedWellAsATeamAccomplished'];
    $totalScore = $appropriateTools + $articulateRequirements + $coherentOralPresentation + $functionalRequirements;

    // Check if user has already voted
    $sql = $pdo->prepare("SELECT * FROM scores WHERE user_id = :user_id");
    $user_id = $_SESSION['user_id'];
    $sql->execute(array('user_id' => $user_id));
    $result = $sql->fetch(PDO::FETCH_ASSOC);

    // If user has not voted, insert new row into scores table
    if (!$result) {
        $stmt = $pdo->prepare("INSERT INTO scores (user_id, articulate_requirements, appropriate_tools, coherent_oral_presentation, functioned_as_team, total_score) VALUES (:user_id, :articulate_requirements, :appropriate_tools, :coherent_oral_presentation, :functional_requirements, :total_score)");
        $stmt->execute(array(
            'user_id' => $user_id,
            'articulate_requirements' => $articulateRequirements,
            'appropriate_tools' => $appropriateTools,
            'coherent_oral_presentation' => $coherentOralPresentation,
            'functional_requirements' => $functionalRequirements,
            'total_score' => $totalScore
        ));
        $success = true;
        $message = "Your vote has been submitted.";
    } else {
        // If user has already voted, do nothing
        $err = true;
        $message = "You have already voted.";
    }
    require_once __DIR__ . "/components/infoBanner.php";
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
            <p class="text-base text-sky-950">Almir Redzematovic,&nbsp;</p>
            <p class="text-base text-sky-950">John Doe,&nbsp;</p>
            <p class="text-base text-sky-950">Jenny Doe,&nbsp;</p>
            <p class="text-base text-sky-950">Mark Smith</p>
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
                        text-gray-900">Developing (0-10)
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
                            <label for="comment"></label>
                            <textarea rows="4" name="comment" id="comment"
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
                <div class="sm:ml-16 sm:mt-0 sm:flex-none">
                    <button type="submit"
                            class="block rounded-md bg-sky-950 px-3 py-2 text-center text-sm font-bold text-white shadow-md
                     hover:bg-sky-900">
                        Submit
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
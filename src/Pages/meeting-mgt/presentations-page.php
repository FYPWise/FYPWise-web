<?php
use App\Models\Base;
use App\Models\Presentation;
use App\Models\Db;

// debugging and error logging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Start session to handle user data
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if the user is logged in, redirect if not
if (!isset($_SESSION['mySession'])) {
    header("Location: login.php");
    exit();
}

$db = new Db();
$base = new Base("Presentations", ["student", "lecturer", "admin"]);
$presentation = new Presentation($db);
$userID = $_SESSION['mySession'];

// $userPresentations = $presentation->getPresentationsByUserID($userID);
$allPresentations = $presentation->getAllPresentations();

?>

<head>
    <link rel="stylesheet" href="/FYPWise-web/src/css/proposal-management-style.css">
</head>
<body>
    <div id="outer-container">
        <?php $base->renderHeader(); ?>

        <!-- Main Content -->
        <div id="main-container">

            <!-- Side Menu -->
            <?php $base->renderMenu() ?>

            <div class="content">
                <section class="main">
                    <h1 id="page-name"><?php echo $base->getTitle() ?></h1>
                    <div class="proposals">
                    <table id="proposal-table">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="select-all"></th>
                                <th>Presentation ID</th>
                                <th>Project ID</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Mode</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($allPresentations)) {
                                foreach ($allPresentations as $presentation) {
                                    echo "<tr>";
                                    echo "<td><input type='checkbox' class='row-checkbox' value='{$presentation['presentationID']}'></td>";
                                    echo "<td><a href='/FYPWise-web/view-presentation-details/{$presentation['presentationID']}'>{$presentation['presentationID']}</a></td>";
                                    echo "<td>{$presentation['projectID']}</td>";
                                    echo "<td>{$presentation['date']}</td>";
                                    echo "<td>" . date('H:i', strtotime($presentation['start_time'])) . " - " . date('H:i', strtotime($presentation['end_time'])) . "</td>";
                                    echo "<td>{$presentation['mode']}</td>";
                                    echo "<td>{$presentation['status']}</td>";
                                }
                            } else {
                                echo "<tr><td colspan='9'>No meeting logs available.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>


        </div>

        <?php $base->renderFooter() ?>
    </div>
</body>

</html>
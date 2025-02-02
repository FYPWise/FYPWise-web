<?php
use App\Models\Base;
use App\Models\MeetingLog;
use App\Models\Db;
use App\Models\Meeting;

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
$base = new Base("Meeting Logs", ["student", "lecturer"]);
$meetingLog = new MeetingLog($db);
$meeting = new Meeting($db);
$userID = $_SESSION['mySession'];

$meetingLogs = $meetingLog->getMeetingLogsByUserID($userID);

?>
<head>
    <link rel="stylesheet" href="/FYPWise-web/src/css/proposal-management-style.css?v=<?php echo time(); ?>">
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
                                <th>Meeting Log ID</th>
                                <th>Supervisor</th>
                                <th>Project ID</th>
                                <th>Meeting ID</th>
                                <th>Meeting Log File</th>
                                <th>Submission Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($meetingLogs)) {
                                foreach ($meetingLogs as $log) {
                                    echo "<tr>";
                                    echo "<td><input type='checkbox' class='row-checkbox' value='{$log['meeting_logID']}'></td>";
                                    echo "<td><a href='/FYPWise-web/view-meeting-log-details/{$log['meeting_logID']}'>{$log['meeting_logID']}</a></td>";
                                    echo "<td>{$log['supervisorID']}</td>";
                                    echo "<td>{$log['projectID']}</td>";
                                    echo "<td><a href='/FYPWise-web/view-meeting-details/{$log['meetingID']}'>{$log['meetingID']}</a></td>";
                                    echo "<td>{$log['file_path']}</a></td>";
                                    echo "<td>{$log['submission_date']}</td>";
                                    echo "<td>{$log['status']}</td>";
                                    echo "</tr>";
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
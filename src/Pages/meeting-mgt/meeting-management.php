<?php
use App\Models\Base;
use App\Models\Meeting;
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
$base = new Base("View Meetings", ["lecturer", "student"]);
$meeting = new Meeting($db);

$userID = $_SESSION['mySession']; 

$meetings = $meeting->getMeetingsByUserID($userID);

?>

<body>
    <div id="outer-container">
        <?php $base->renderHeader(); ?>

        <!-- Main Content -->
        <div id="main-container">

            <!-- Side Menu -->
            <?php $base->renderMenu(); ?>

            <div class="content">
                <section class="main">
                    <h1 id="page-name"><?php echo $base->getTitle(); ?></h1>
                        <div class="proposals">
                        <table id="proposal-table">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="select-all"></th>
                                    <th>Meeting ID</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Mode</th>
                                    <th>Participants</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                try {
                                    if (!empty($meetings)) {
                                        foreach ($meetings as $meeting) {
                                            echo "<tr>";
                                            echo "<td><input type='checkbox' class='row-checkbox' value='{$meeting['meetingID']}'></td>";
                                            echo "<td>{$meeting['meetingID']}</td>";
                                            echo "<td><a href='/FYPWise-web/view-meeting-details/{$meeting['meetingID']}'>{$meeting['meeting_title']}</a></td>";
                                            echo "<td>".htmlentities($meeting['meeting_description'])."</td>";
                                            echo "<td>{$meeting['date']}</td>";
                                            echo "<td>".date('H:i', strtotime($meeting['start_time']))." - ".date('H:i', strtotime($meeting['end_time']))."</td>";
                                            echo "<td>".ucfirst($meeting['mode'])."</td>";
                                            echo "<td>";
                                            
                                            $meetingInstance = new Meeting($db);
                                            $participants = $meetingInstance->getUsersForMeeting($meeting['meetingID']);
                                            
                                            if (!empty($participants)) {
                                                foreach ($participants as $participant) {
                                                    echo htmlentities($participant['name']) . "<br>";
                                                }
                                            } else {
                                                echo "No participants";
                                            }
                                            
                                            echo "</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='8'>No meetings found.</td></tr>";
                                    }
                                } catch (Exception $e) {
                                    echo "<tr><td colspan='8'>Error: " . $e->getMessage() . "</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                </section>
            </div>

        </div>

        <?php $base->renderFooter(); ?>
    </div>
</body>

</html>

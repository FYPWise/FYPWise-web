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
                                <?php if (count($meetings) > 0): ?>
                                    <?php foreach ($meetings as $meeting): ?>
                                        <tr>
                                            <td><input type="checkbox" class="row-checkbox" value="<?= $meeting['meetingID']; ?>"></td>
                                            <td><?= $meeting['meetingID']; ?></td>
                                            <td><a href="meeting-acceptance-page.php?meetingID=<?= $meeting['meetingID']; ?>"><?= $meeting['meeting_title']; ?></a></td>
                                            <td><?= $meeting['meeting_description']; ?></td>
                                            <td><?= $meeting['date']; ?></td>
                                            <td>
                                                <?= date('H:i', strtotime($meeting['start_time'])); ?> - 
                                                <?= date('H:i', strtotime($meeting['end_time'])); ?>
                                            </td>
                                            <td><?= ucfirst($meeting['mode']); ?></td>
                                            <td>
                                                <?php
                                                $meetingInstance = new Meeting($db);
                                                
                                                // Get participants for this meeting
                                                $participants = $meetingInstance->getUsersForMeeting($meeting['meetingID']);

                                                if (count($participants) > 0) {
                                                    foreach ($participants as $participant) {
                                                        echo $participant['name'] . "<br>";
                                                    }
                                                } else {
                                                    echo "No participants";
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr><td colspan="9">No meetings found.</td></tr>
                                <?php endif; ?>
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

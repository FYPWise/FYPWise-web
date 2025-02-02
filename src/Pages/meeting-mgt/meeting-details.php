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

$base = new Base("Meeting Management");
$db = new Db();
$meeting = new Meeting($db);
$userID = $_SESSION['mySession']; 

$meetingDetails = null;

if ($meetingID) {
    try {
        $meetingDetails = $meeting->getMeetingByID($meetingID);

        // Debugging: Check if data is retrieved
        if (!$meetingDetails) {
            throw new Exception("Meeting not found or failed to fetch details.");
        }
    } catch (Exception $e) {
        $errorMessage = "Error: " . $e->getMessage();
    }
}
?>

<head>
    <link rel="stylesheet" href="/FYPWise-web/src/css/form-style.css">
    <link rel="stylesheet" href="/FYPWise-web/src/css/meeting-acceptance-style.css">
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
                    <div class="side">
                        <form class="meeting-acceptance-form" id="meetingAcceptanceForm">
                            <div class="form-group">
                                <label for="meeting-id">Meeting ID</label>
                                <p id="meeting-id" class="meeting-id"><?= htmlspecialchars($meetingDetails['meetingID']); ?></p>
                            </div>

                            <div class="form-group">
                                <label for="description">Meeting Description</label>
                                <p id="description" name="description"><?= htmlspecialchars($meetingDetails['meeting_title']); ?></p>
                            </div>

                            <div class="form-group">
                                <label for="meeting-date">Meeting Date</label>
                                <p id="meeting-date" name="meeting-date"><?= htmlspecialchars($meetingDetails['date']); ?></p>
                            </div>

                            <div class="form-group">
                                <label for="start-time">Start Time</label>
                                <p id="start-time" name="start-time"><?= date('h:i A', strtotime($meetingDetails['start_time'])); ?></p>
                            </div>

                            <div class="form-group">
                                <label for="end-time">End Time</label>
                                <p id="end-time" name="end-time"><?= date('h:i A', strtotime($meetingDetails['end_time'])); ?></p>
                            </div>

                            <div class="form-group">
                                <label for="participants">Participants</label>
                                <p id="participants" name="participants">
                                    <?php 
                                        $participants = $meeting->getUsersForMeeting($meetingID);
                                        $participantNames = array_map(function($participant) {
                                            return $participant['name'];
                                        }, $participants);
                                        echo implode(', ', $participantNames);
                                    ?>
                                </p>
                            </div>

                            <div class="form-group">
                                <label for="mode">Mode of Meeting</label>
                                <p id="mode" name="mode"><?= ucfirst($meetingDetails['mode']); ?></p>
                            </div>

                            <div class="form-group">
                                <label for="location">Location</label>
                                <p id="location" name="location"><?= htmlspecialchars($meetingDetails['location']); ?></p>
                            </div>

                            <!-- show meeting URl only if the meeting is online -->
                            <?php if ($meetingDetails['mode'] === 'online'): ?>
                            <div class="form-group">
                                <label for="url">Meeting URL</label>
                                <p id="url" name="url"><a href="<?= htmlspecialchars($meetingDetails['meeting_URL']); ?>" target="_blank">Click to join</a></p>
                            </div>
                            <?php endif; ?>
                        </form>

                        <div class="calendar">
                            <!-- calendar and event details here -->
                            <?php
                            $allMeetings = $meeting->getMeetingsByUserID($userID);
                            $otherMeetings = array_filter($allMeetings, function($m) use ($meetingID) {
                                return $m['meetingID'] !== $meetingID;
                            });

                            if (empty($otherMeetings)) {
                                echo "<p>No other meetings scheduled</p>";
                            } else {
                                $currentDate = '';
                                foreach ($otherMeetings as $otherMeeting) {
                                    $meetingDate = date('j F Y', strtotime($otherMeeting['date']));
                                    if ($currentDate !== $meetingDate) {
                                        $currentDate = $meetingDate;
                                        echo "<h3>" . ($meetingDate === date('j F Y') ? 'Today' : ($meetingDate === date('j F Y', strtotime('+1 day')) ? 'Tomorrow' : $meetingDate)) . "</h3>";
                                    }
                                    echo "<div class='event'>";
                                    echo "<p><strong>" . date('h:i A', strtotime($otherMeeting['start_time'])) . "</strong> " . htmlspecialchars($otherMeeting['meeting_title']) . "</p>";
                                    $participants = $meeting->getUsersForMeeting($otherMeeting['meetingID']);
                                    $participantNames = array_map(function($participant) {
                                        return $participant['name'];
                                    }, $participants);
                                    echo "<p>Participants: " . implode(', ', $participantNames) . "</p>";
                                    echo "</div>";
                                }
                            }
                            ?>
                        </div>
                    </div>
                </section>
            </div>


        </div>
        <?php $base->renderFooter() ?>
    </div>
</body>

</html>


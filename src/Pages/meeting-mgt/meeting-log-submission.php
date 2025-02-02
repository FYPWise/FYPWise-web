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
$base = new Base("Submit Meeting Log", ["student"]);
$meetingLog = new MeetingLog($db);
$meeting = new Meeting($db);
$userID = $_SESSION['mySession']; 

$successMessage = "";
$errorMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Form validation
    if (empty($_POST['supervisor-id']) || empty($_POST['project-id']) || empty($_POST['meeting-id']) || empty($_FILES['meeting-log-file']['name']) || empty($_POST['submission-date'])) {
        $errorMessage = "All fields are required.";
    } else {
        $supervisorID = $_POST['supervisor-id'];
        $projectID = $_POST['project-id'];
        $meetingID = $_POST['meeting-id'];
        $submissionDate = $_POST['submission-date'];

        // insert data
        $resultMessage = $meetingLog->submitMeetingLog($supervisorID, $projectID, $meetingID, 'meeting-log-file', $submissionDate);

        if (strpos($resultMessage, 'successfully') !== false) {
            $successMessage = $resultMessage;
        } else {
            $errorMessage = $resultMessage;
        }
    }
}

?>
<head>
    <link rel="stylesheet" href="/FYPWise-web/src/css/form-style.css">
</head>
<body>
    < id="outer-container">
        <?php $base->renderHeader(); ?>

        <!-- Main Content -->
        <div id="main-container">

            <!-- Side Menu -->
            <?php $base->renderMenu() ?>

            <div class="content">
                <section class="main">
                    <h1 id="page-name"><?php echo $base->getTitle() ?></h1>
                    <form class="form" id="meetingLogForm" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="supervisor-id">Supervisor</label>
                            <select id="supervisor-id" name="supervisor-id" required>
                                <?php
                                $supervisors = $db->query("SELECT id, name FROM users WHERE role IN ('lecturer')");
                                foreach ($supervisors as $supervisor) {
                                    echo "<option value=\"{$supervisor['id']}\">{$supervisor['id']} {$supervisor['name']}</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="project-id">Project</label>
                            <select id="project-id" name="project-id" required>
                                <?php
                                $projects = $db->query("SELECT projectID, project_title FROM project WHERE studentID = '$userID'");
                                foreach ($projects as $project) {
                                    echo "<option value=\"{$project['projectID']}\">{$project['project_title']}</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="meeting-id">Meeting</label>
                            <select id="meeting-id" name="meeting-id" required>
                                <?php
                                $meetings = $meeting->getMeetingsByUserID($userID);
                                foreach ($meetings as $meeting) {
                                    echo "<option value=\"{$meeting['meetingID']}\">{$meeting['meetingID']} - {$meeting['meeting_title']}</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="meeting-log-file">Meeting Log File</label>
                            <div class="file-input-container">
                                <div class="fake-input">
                                    <span id="file-name">Choose a file to upload </span>
                                    <span class="upload-icon"><i class="fa fa-upload"></i></span>
                                </div>
                                <input type="file" id="meeting-log-file" name="meeting-log-file" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="submission-date">Submission Date</label>
                            <input type="hidden" id="submission-date" name="submission-date" value="<?php echo date('Y-m-d'); ?>">
                            <p><?php echo date('Y-m-d'); ?></p>
                        </div>

                        <!-- Submit and reset buttons -->
                        <div class="form-buttons">
                            <button type="submit" class="btn submit-btn">Submit</button>
                            <button type="reset" class="btn reset-btn">Reset</button>
                        </div>
                    </form>
                </section>
            </div>
        </div>
        <script>
            // Display success/error messages
            <?php if (!empty($successMessage)): ?>
                alert("<?php echo $successMessage; ?>");
            <?php endif; ?>

            <?php if (!empty($errorMessage)): ?>
                alert("<?php echo $errorMessage; ?>");
            <?php endif; ?>
        </script>
        
        <?php $base->renderFooter() ?>
    </div>
</body>

</html>
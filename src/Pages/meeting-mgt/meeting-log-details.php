<?php
use App\Models\Base;
use App\Models\Db;
use App\Models\MeetingLog;

// Debugging and error logging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Start session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


// Database connection
$db = new Db();
$base = new Base("View Meetings", ["lecturer", "student"]);
$meetingLog = new MeetingLog($db);

$userID = $_SESSION['mySession']; 
$isLecturer = isset($_SESSION['role']) && $_SESSION['role'] === 'lecturer';
// $isLecturer = true; // Debugging: Set as lecturer for testing

$meetingLogDetails = null;

if ($meeting_logID) {
    try {
        $meetingLogDetails = $meetingLog->getMeetingLogDetails($meeting_logID);
    } catch (Exception $e) {
        echo "<p>Error: " . htmlspecialchars($e->getMessage()) . "</p>";
    }
}

// Handle form submission (only if lecturer)
if ($isLecturer && $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $newStatus = $_POST['status'];
    $newComment = $_POST['comment'];

    try {
        $meetingLog->updateMeetingLogStatus($meeting_logID, $newStatus, $newComment);
        header("Location: " . $_SERVER['REQUEST_URI']);
        exit();
    } catch (Exception $e) {
        echo "<script>alert('Error updating meeting log: " . htmlspecialchars($e->getMessage()) . "');</script>";
    }
}
?>

<head>
    <link rel="stylesheet" href="/FYPWise-web/src/css/form-style.css?v=<?php echo time(); ?>">
</head>
<body>
    <div id="outer-container">
        <?php $base->renderHeader(); ?>

        <div id="main-container">
            <?php $base->renderMenu(); ?>

            <div class="content">
                <section class="main">
                    <h1 id="page-name"><?= $base->getTitle(); ?></h1>

                    <?php if ($meetingLogDetails): ?>
                        <form class="meeting-update-form" id="meetingUpdateForm" method="POST">
                            <input type="hidden" name="meeting_logID" value="<?= htmlspecialchars($meetingLogDetails['meeting_logID'] ?? '') ?>">

                            <div class="form-group">
                                <label for="student-name">Student Name</label>
                                <?php
                                // Fetch student name from the database
                                $studentName = 'N/A';
                                if (isset($meetingLogDetails['studentID'])) {
                                    $studentID = $meetingLogDetails['studentID'];
                                    $query = $db->query("SELECT name FROM users WHERE userID = " . $studentID);
                                    if ($query && $query->num_rows > 0) {
                                        $result = $query->fetch_assoc();
                                        $studentName = $result['name'];
                                    }
                                }
                                ?>
                                <p id="student-name"><?= htmlspecialchars($studentName) ?></p>
                            </div>

                            <div class="form-group">
                                <label for="supervisor-name">Supervisor Name</label>
                                <?php
                                // Fetch supervisor name from the database
                                $supervisorName = 'N/A';
                                if (isset($meetingLogDetails['supervisorID'])) {
                                    $supervisorID = $meetingLogDetails['supervisorID'];
                                    $query = $db->query("SELECT name FROM users WHERE userID = " . $supervisorID);
                                    if ($query && $query->num_rows > 0) {
                                        $result = $query->fetch_assoc();
                                        $supervisorName = $result['name'];
                                    }
                                }
                                ?>
                                <p id="supervisor-name"><?= htmlspecialchars($supervisorName) ?></p>
                            </div>

                            <div class="form-group">
                                <label for="meeting-id">Meeting ID</label>
                                <p id="meeting-id"><?= htmlspecialchars($meetingLogDetails['meetingID'] ?? 'N/A') ?></p>
                            </div>

                            <div class="form-group">
                                <label for="file">Meeting Log File</label>
                                <p id="file">
                                    <a href="../uploads/meeting-logs/<?= htmlspecialchars($meetingLogDetails['file_path'] ?? '') ?>" target="_blank">
                                        <?= htmlspecialchars($meetingLogDetails['file_path'] ?? 'No file uploaded') ?>
                                    </a>
                                </p>
                            </div>

                            <div class="form-group">
                                <label for="date">Submission Date</label>
                                <p id="date"><?= htmlspecialchars($meetingLogDetails['submission_date'] ?? 'N/A') ?></p>
                            </div>

                            <div class="form-group">
                                <label for="status">Status</label>
                                <?php if ($isLecturer && $meetingLogDetails['status'] !== 'approved'): ?>
                                    <select id="status" name="status" required>
                                        <option value="submitted" <?= ($meetingLogDetails['status'] == 'submitted') ? 'selected' : '' ?>>Submitted</option>
                                        <option value="pending" <?= ($meetingLogDetails['status'] == 'pending') ? 'selected' : '' ?>>Pending</option>
                                        <option value="rejected" <?= ($meetingLogDetails['status'] == 'rejected') ? 'selected' : '' ?>>Rejected</option>
                                        <option value="approved" <?= ($meetingLogDetails['status'] == 'approved') ? 'selected' : '' ?>>Approved</option>
                                    </select>
                                <?php else: ?>
                                    <p id="status"><?= htmlspecialchars($meetingLogDetails['status'] ?? 'N/A') ?></p>
                                <?php endif; ?>
                            </div>

                            <div class="form-group">
                                <label for="comment">Comment</label>
                                <?php if ($isLecturer && $meetingLogDetails['status'] !== 'approved'): ?>
                                    <textarea id="comment" name="comment" rows="6"><?= htmlspecialchars($meetingLogDetails['comment'] ?? '') ?></textarea>
                                <?php else: ?>
                                    <p id="comment"><?= nl2br(htmlspecialchars($meetingLogDetails['comment'] ?? 'No comments')) ?></p>
                                <?php endif; ?>
                            </div>

                            <?php if ($isLecturer && $meetingLogDetails['status'] !== 'approved'): ?>
                                <div class="form-buttons">
                                    <button type="submit" class="btn submit-btn" name="update">Update</button>
                                    <button type="reset" class="btn reset-btn">Reset</button>
                                </div>
                            <?php endif; ?>
                        </form>
                    <?php else: ?>
                        <p>No meeting log found.</p>
                    <?php endif; ?>
                </section>
            </div>
        </div>

        <?php $base->renderFooter(); ?>
    </div>
</body>
</html>
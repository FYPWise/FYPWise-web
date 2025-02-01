<?php
use App\Models\Base;
use App\Models\Db;
use App\Models\MeetingLog;

// debugging and error logging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Start session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if the user is logged in
if (!isset($_SESSION['mySession'])) {
    header("Location: login.php");
    exit();
}

$db = new Db();
$base = new Base("View Meetings", ["lecturer", "student"]);
$meetingLog = new MeetingLog($db);

$userID = $_SESSION['mySession']; 
$isLecturer = isset($_SESSION['role']) && $_SESSION['role'] === 'lecturer';

$meetingLogDetails = null;

if (isset($_GET['meeting_logID'])) {
    $meetingLogID = intval($_GET['meeting_logID']);
    try {
        $meetingLogDetails = $meetingLog->getMeetingLogDetails($meetingLogID);
    } catch (Exception $e) {
        echo "<p>Error: " . $e->getMessage() . "</p>";
    }
}

if ($proposalID) {
    try {
        $proposalDetails = $proposal->getProposalByID($proposalID) ?? null;
    } catch (Exception $e) {
        echo "<p>Error: " . $e->getMessage() . "</p>";
    }
}

// Handle form submission (only if lecturer)
if ($isLecturer && $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $newStatus = $_POST['status'];
    $newComment = $_POST['comment'];

    try {
        $meetingLog->updateMeetingLogStatus($meetingLogID, $newStatus, $newComment);
        echo "<script>alert('Meeting Log updated successfully!'); window.location.reload();</script>";
    } catch (Exception $e) {
        echo "<script>alert('Error updating meeting log: " . $e->getMessage() . "');</script>";
    }
}
?>

<head>
    <link rel="stylesheet" href="/FYPWise-web/src/css/form-style.css">
</head>
<body>
    <div id="outer-container">
        <?php $base->renderHeader(); ?>

        <div id="main-container">
            <?php $base->renderMenu() ?>

            <div class="content">
                <section class="main">
                    <h1 id="page-name"><?php echo $base->getTitle() ?></h1>

                    <?php if ($meetingLogDetails): ?>
                        <form class="meeting-update-form" id="meetingUpdateForm" method="POST">
                            <input type="hidden" name="meeting_logID" value="<?= htmlspecialchars($meetingLogDetails->meetinglogID) ?>">

                            <div class="form-group">
                                <label for="student-id">Student ID</label>
                                <p id="student-id"><?= htmlspecialchars($meetingLogDetails->studentID) ?></p>
                            </div>

                            <div class="form-group">
                                <label for="supervisor-id">Supervisor ID</label>
                                <p id="supervisor-id"><?= htmlspecialchars($meetingLogDetails->supervisorID) ?></p>
                            </div>

                            <div class="form-group">
                                <label for="meeting-id">Meeting ID</label>
                                <p id="meeting-id"><?= htmlspecialchars($meetingLogDetails->meetingID) ?></p>
                            </div>

                            <div class="form-group">
                                <label for="file">Meeting Log File</label>
                                <p id="file">
                                    <a href="../uploads/<?= htmlspecialchars($meetingLogDetails->file_path) ?>" target="_blank">
                                        <?= htmlspecialchars($meetingLogDetails->file_path) ?>
                                    </a>
                                </p>
                            </div>

                            <div class="form-group">
                                <label for="date">Submission Date</label>
                                <p id="date"><?= htmlspecialchars($meetingLogDetails->submission_date) ?></p>
                            </div>

                            <div class="form-group">
                                <label for="status">Status</label>
                                <?php if ($isLecturer): ?>
                                    <select id="status" name="status" required>
                                        <option value="Pending" <?= ($meetingLogDetails->status == 'Pending') ? 'selected' : '' ?>>Pending Supervisor Approval</option>
                                        <option value="Submitted" <?= ($meetingLogDetails->status == 'Submitted') ? 'selected' : '' ?>>Submitted</option>
                                        <option value="Rejected" <?= ($meetingLogDetails->status == 'Rejected') ? 'selected' : '' ?>>Rejected</option>
                                        <option value="Approved" <?= ($meetingLogDetails->status == 'Approved') ? 'selected' : '' ?>>Approved By Supervisor</option>
                                    </select>
                                <?php else: ?>
                                    <p id="status"><?= htmlspecialchars($meetingLogDetails->status) ?></p>
                                <?php endif; ?>
                            </div>

                            <div class="form-group">
                                <label for="comment">Comment</label>
                                <?php if ($isLecturer): ?>
                                    <textarea id="comment" name="comment" rows="6"><?= htmlspecialchars($meetingLogDetails->comment) ?></textarea>
                                <?php else: ?>
                                    <p id="comment"><?= nl2br(htmlspecialchars($meetingLogDetails->comment)) ?></p>
                                <?php endif; ?>
                            </div>

                            <div class="form-buttons">
                                <button type="submit" class="btn submit-btn" name="update">Update</button>
                                <button type="reset" class="btn reset-btn">Reset</button>
                            </div>
                        </form>
                    <?php else: ?>
                        <p>No meeting log found.</p>
                    <?php endif; ?>
                </section>
            </div>
        </div>

        <?php $base->renderFooter() ?>
    </div>
</body>

</html>

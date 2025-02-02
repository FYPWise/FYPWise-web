<?php
use App\Models\Base;
use App\Models\Db;
use App\Models\Presentation;

// Debugging and error logging
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

// Database connection
$db = new Db();
$base = new Base("View Meetings", ["lecturer", "student", "admin"]);
$presentation = new Presentation($db);

$userID = $_SESSION['mySession']; 
$isAdmin = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
// $isAdmin = true; // Debugging: Set as admin for testing

$presentationDetails = null;

if ($presentationID) {
    try {
        $presentationDetails = $presentation->getPresentationByID($presentationID) ?? null;
    } catch (Exception $e) {
        echo "<p>Error: " . htmlspecialchars($e->getMessage()) . "</p>";
    }
}

// Handle form submission (only if admin)
if ($isAdmin && $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $newStatus = $_POST['status'];
    $newComment = $_POST['comment'];

    try {
        $meetingLog->updateMeetingLogStatus($meeting_logID, $newStatus, $newComment);
        echo "<script>alert('Meeting Log updated successfully!');  window.location.reload();</script>";
    } catch (Exception $e) {
        echo "<script>alert('Error updating meeting log: " . htmlspecialchars($e->getMessage()) . "');</script>";
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
                    <!-- Presentation Form -->
                    <form class="form" id="presentationForm">
                    <?php if ($presentationDetails): ?>
                            <div class="form-group">
                                <label for="presentation-id">Presentation ID</label>
                                <p id="presentation-id" class="presentation-id"><?php echo htmlspecialchars($presentationDetails['presentationID'] ?? ''); ?></p>
                            </div>

                            <div class="form-group">
                                <label for="title">Presentation Title</label>
                                <p id="title" class="title"><?php echo htmlspecialchars($presentationDetails['presentation_title'] ?? ''); ?></p>
                            </div>

                            <div class="form-group">
                                <label for="project-id">Project ID</label>
                                <p id="project-id" class="project-id"><?php echo htmlspecialchars($presentationDetails['projectID'] ?? ''); ?></p>
                            </div>

                            <div class="form-group">
                                <label for="date">Presentation Date</label>
                                <p id="date" class="date"><?php echo htmlspecialchars($presentationDetails['date'] ?? ''); ?></p>
                            </div>

                            <div class="form-group">
                                <label for="time">Presentation Time</label>
                                <p id="time" class="time"><?php echo htmlspecialchars($presentationDetails['start_time'] ?? '') . " to " . htmlspecialchars($presentationDetails['end_time'] ?? ''); ?></p>
                            </div>

                            <div class="form-group">
                                <label for="mode">Mode of Presentation</label>
                                <p id="mode" class="mode"><?php echo htmlspecialchars($presentationDetails['mode'] ?? ''); ?></p>
                            </div>

                            <div class="form-group">
                                <label for="location">Location</label>
                                <p id="location" class="location"><?php echo htmlspecialchars($presentationDetails['location'] ?? ''); ?></p>
                            </div>

                            <div class="form-group">
                                <label for="url">Online Presentation URL</label>
                                <p id="url" class="url"><a href="<?php echo htmlspecialchars($presentationDetails['presentation_URL'] ?? '#'); ?>">URL</a></p>
                            </div>

                            <div class="form-group">
                                <label for="moderator-id">Moderator ID</label>
                                <p id="mod" class="mod"><?php echo htmlspecialchars($presentationDetails['moderatorName'] ?? ''); ?></p>
                            </div>

                            <div class="form-group">
                                <label for="supervisor-id">Supervisor ID</label>
                                <p id="supervisor-id" class="supervisor-id"><?php echo htmlspecialchars($presentationDetails['supervisorName'] ?? ''); ?></p>
                            </div>

                            <div class="form-group">
                                <label for="student-id">Student ID</label>
                                <p id="student-id" class="student-id"><?php echo htmlspecialchars($presentationDetails['studentName'] ?? ''); ?></p>
                            </div>

                            <div class="form-group">
                                <label for="status">Status</label>
                                <p id="status" class="status"><?php echo htmlspecialchars($presentationDetails['status'] ?? ''); ?></p>
                            </div>
                        <?php else: ?>
                            <p>No presentation found with the given ID.</p>
                        <?php endif; ?>
                    </form>
                </section>
            </div>
        </div>
        <?php $base->renderFooter() ?>
    </div>
</body>

</html>

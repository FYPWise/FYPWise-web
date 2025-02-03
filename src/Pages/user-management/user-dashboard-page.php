<?php

use App\Models\Base;
use App\Models\Db;
use App\Models\task;
use App\Models\Announcement;
use App\Models\User;

$userId = $_SESSION['mySession'];
$role = $_SESSION['role'];

$task = new task();
$announcement = new Announcement();
$announcement->latest();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['addTask'])) {
        $task->addTask();
    } elseif (isset($_POST['complete'])) {
        $task->completeTask();
    }
}

$base = new Base("Dashboard", ["student", "lecturer", "admin"]);
$db = new Db();
$projectModel = new User();
$milestones = $projectModel->projectProgress($userId, $role);
$submissions = $projectModel->submissionUpdates($userId, $role);


function task($db) {
    $sql = "SELECT * FROM task WHERE userID = '{$_SESSION['mySession']}' ORDER BY taskDate";
    $result = $db->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $taskId = $row['taskID'];
            $date = date('d F', strtotime($row['taskDate']));
            echo "<div class='task'>";
                echo "<input type='checkbox' id='task{$taskId}' name='tasks[]' value='{$taskId}'>";
                echo "<label for='task{$taskId}'>{$row['taskName']}</label>";
                echo "<p>{$date}</p>";
            echo "</div>";
        }
    } else {
        echo "No task found";
    }
}

// Fetch task dates
function getTaskDates($db) {
    $userId = $db->escapeString($_SESSION['mySession']);
    $sql = "SELECT taskDate FROM task WHERE userID = '$userId'";
    $result = $db->query($sql);
    $taskDates = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $taskDates[] = $row['taskDate'];
        }
    }
    return $taskDates;
}

$taskDates = getTaskDates($db);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="./src/css/user-dashboard-style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./src/css/calendar-style.css?v=<?php echo time(); ?>">
    <script src="./src/scripts/calendar.js?v=<?php echo time(); ?>"></script>
</head>

<body>
    <?php include "user-dashboard-sidebar.php" ?>

    <!-- Side Menu -->
    <?php $base->renderMenu() ?>

    <!-- Main Container -->
    <div class="container">
        <div class="non-footercontainer">
            <div class="header">
                <h1><?php echo $_SESSION["name"]; ?></h1>
                <div class="right-header">
                    <a href="profilemanagement"><img src="./src/assets/pfp/<?php echo $_SESSION['image'] ?>" alt="User"
                            class="user-image"></a>
                </div>
            </div>
            <hr>
            <!-- Container for Calendar and Task -->
            <div class="mini-container1">
                <!-- Calendar -->
                <?php include "./src/Pages/common-ui/calendar.html"; ?>
                <script>
                    var taskDates = <?php echo json_encode($taskDates); ?>;
                    document.addEventListener('DOMContentLoaded', function() {
                        // Double click for add task
                        document.querySelectorAll('td.day').forEach(function(dateElement) {
                            dateElement.addEventListener('dblclick', function() {
                                var clickedDate = this.getAttribute('data-date');
                                openUpWindow(clickedDate);
                            });
                        });
                    });
                </script>
                <!-- Task -->
                <div class="task-section">
                    <h2>Task</h2>
                    <form method="POST">
                        <div class="task-container">
                            <?php task($db); ?>
                        </div>
                        <div class="task-btn">
                            <button type="button" class="addTask-btn" id="addTask-btn" onclick="openUpWindow()">Add Task</button>
                            <button type="submit" id="completed-btn" name="complete">Completed</button>
                        </div>
                    </form>
                </div>
                <div class="addTaskPopUp">
                    <div class="addTaskPopUp-content">
                        <button class="close" onclick="closeUpWindow()">x</button>
                        <h2>Add Task</h2>
                        <form method="POST">
                            <div class="form-row">
                                <label for="taskName">Task Name:</label>
                                <input type="text" id="taskName" name="taskName" maxlength="20" required>
                            </div>
                            <div class="form-row">
                                <label for="taskDate">Due Date:</label>
                                <input type="date" id="taskDate" name="taskDate" min="<?php echo date('Y-m-d'); ?>" required> <!-- the min will set the minimum date to today and disable the past date -->
                            </div>
                            <button type="submit" name="addTask" class="addTask-btn" id="addTask-btn2">Add Task</button>
                        </form>
                    </div>
                </div>
                <script>
                    var addTaskPopUp = document.querySelector('.addTaskPopUp');
                    var close = document.querySelector('.close');

                    function openUpWindow(selectedDate) {
                        addTaskPopUp.style.display = 'flex';
                        document.getElementById('taskDate').value = selectedDate;
                    }
                    function closeUpWindow() {
                        addTaskPopUp.style.display = 'none';
                    }

                    window.addEventListener('click', function (e) {
                        if (e.target == addTaskPopUp) {
                            addTaskPopUp.style.display = 'none';
                        }
                    });
                </script>
            </div>
            <!-- Announcement Section -->
            <div class="announcement-section">
                <h2>Announcements</h2>
                <div class="announcement-box">
                <?php if ($announcement->getTitle() !== null){ ?>
                    <div class="announcement-header">
                        <img src="./src/assets/pfp/<?php echo $announcement->getFN(); ?>" alt="User" class="user-image">
                        <div class="user-details">
                            <p class="user-name"><?php echo $announcement->getName(); ?></p>
                            <p class="announcement-time"><?php echo $announcement->getTime(); ?> &nbsp; | &nbsp; <?php echo $announcement->getDate(); ?></p>
                        </div>
                    </div>
                    <div class="announcement-content">
                        <h4 class="announcement-title"><?php echo $announcement->getTitle(); ?></h4>
                        <p class="announcement-text"><?php echo $announcement->getDes(); ?></p>
                    </div>
                <?php } else { ?>
                <p>No announcement</p>
                <?php } ?>
                </div>
            </div>
            <!-- Container for Project progress, submission updates and quick shortcuts -->
            <div class="mini-container2">
                <!-- Project Progress Section -->
                 <?php if($role != 'admin'):?>
                <div class="project-progress-section task-section">
                    <h2>Project Progress</h2>
                    <div class="task-container">
                    <?php
                        foreach($milestones as $milestone){
                            echo "<div class='task pp'>
                                    <h4>{$milestone['project_title']}</h4>
                                    <p>Milestone: {$milestone['milestone_title']}</p>
                                    <p>Start: {$milestone['milestone_start_date']}</p>
                                    <p>End: {$milestone['milestone_end_date']}</p>
                                    <p>Status: {$milestone['status']}</p>
                                </div>";
                        }
                        ?>
                    </div>
                </div>
                <?php endif; ?>
                <!-- Submission Updates Section -->
                <div class="submission-updates-section task-section">
                    <h2><?php echo $role == 'student' ? 'Submission Updates': 'Student Monitoring'; ?></h2>
                    <div class="task-container">
                        <?php
                        foreach($submissions as $submission){
                            echo "<div class='task ss'>";
                                if ($role != 'student') {
                                    echo "<h4>Student: {$submission['name']}</h4>";
                                }
                                echo "<p>Title: {$submission['project_title']}</p>
                                    <p>Status: {$submission['project_status']}</p>
                                    <p>Category: {$submission['project_category']}</p>
                                    <p>Submitted: {$submission['end_date']}</p>
                                    </div>";
                        }
                        ?>
                    </div>
                </div>
                <!-- Quick Shortcuts Section -->
                <div class="quick-shortcuts-section task-section">
                    <h2>Quick Shortcuts</h2>
                    <div class="task-container">
                        <?php if ($role == 'student') { ?>
                            <div class="task">
                                <a href="projecttimelineplanning">Project Timeline Planning</a>
                            </div>
                            <div class="task">
                                <a href="new-meeting">Schedule a Meeting</a>
                            </div>
                            <div class="task">
                                <a href="submit-meeting-log">Submit Meeting Log</a>
                            </div>
                        <?php } elseif($role == 'lecturer') { ?>
                            <div class="task">
                                <a href="supervisorprojecttimeline">Project Timeline Planning</a>
                            </div>
                            <div class="task">
                                <a href="new-meeting">Schedule a Meeting</a>
                            </div>
                            <div class="task">
                                <a href="projectplanapproval">Project Approval</a>
                            </div>
                        <?php } else { ?>
                            <div class="task">
                                <a href="moderator-management">Assign Moderator</a>
                            </div>
                            <div class="task">
                                <a href="new-announcement">Make Announcement</a>
                            </div>
                            <div class="task">
                                <a href="new-user">Create Profile</a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- footer Section -->
        <?php $base->renderFooter() ?>
    </div>
</body>

</html>
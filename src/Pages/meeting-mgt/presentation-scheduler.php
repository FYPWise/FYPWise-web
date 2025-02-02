<?php
use App\Models\Base;
use App\Models\Presentation;
use App\Models\Db;
use App\Models\Project;

//debugging
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

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
$base = new Base("Schedule a Presentation", ["admin"]);
$presentation = new Presentation($db);
$project = new Project($db);
$userID = $_SESSION['mySession'];

$successMessage = "";
$errorMessage = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    // Validate required fields
    if (
        empty($_POST['date']) ||
        empty($_POST['start-time']) ||
        empty($_POST['end-time']) ||
        empty($_POST['mode']) ||
        empty($_POST['presentation-title']) ||
        empty($_POST['project'])
    ) {
        $errorMessage = "Please fill out all required fields.";
    } else {
        try {
            // Set status to "scheduled" by default
            $status = "scheduled";

            // Call createPresentation with correct parameters
            $presentationId = $presentation->createPresentation(
                $_POST['presentation-title'],         
                $_POST['start-time'],                 
                $_POST['end-time'],                  
                $_POST['date'],                      
                $_POST['mode'],                        
                $_POST['location'] ?? null,           
                $_POST['presentation-url'] ?? null,
                $status, // Default status set to "scheduled"
                $_POST['project']
            );
            $successMessage = "Presentation scheduled successfully!";
        } catch (\Exception $e) {
            $errorMessage = "Error scheduling the presentation: " . $e->getMessage();
        }
    }
}
?>

<head>
    <link rel="stylesheet" href="/FYPWise-web/src/css/meeting-style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="/FYPWise-web/src/css/form-style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="/FYPWise-web/src/css/calendar-style.css?v=<?php echo time(); ?>">
    <script src="/FYPWise-web/src/scripts/calendar.js?v=<?php echo time(); ?>"></script>
    <style>
        #search-participants {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 1em;
            margin-bottom: 10px;
        }

        .scrollable-list {
            max-height: 200px;
            overflow-y: auto;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            background-color: #f9f9f9;
        }

        .participant {
            display: block;
            padding: 10px;
            margin: 5px 0;
            cursor: pointer;
            border-radius: 4px;
            color: #06509f;
            background-color: #ffffff;
            transition: all 0.3s ease;
            border: 1px solid #06509f;
        }

        .participant:hover {
            background-color: #d0e4ff;
        }

        .participant.selected {
            background-color: #06509f;
            color: white;
        }
    </style>
</head>

<body>
    <div id="outer-container">
        <?php $base->renderHeader() ?>

        <div id="main-container">
            <?php $base->renderMenu() ?>

            <div class="content">
                <section class="main">
                    <h1 id="page-name"><?php echo $base->getTitle() ?></h1>
                    <div class="content">
                        <form class="form" id="presentationForm" method="POST" action="">
                            <div class="form-group">
                                <label for="presentation-title">Presentation Title</label>
                                <input type="text" id="presentation-title" name="presentation-title" placeholder="Enter presentation title" required>
                            </div>

                            <div class="form-group">
                                <label for="presentation-description">Presentation Description</label>
                                <textarea id="presentation-description" name="presentation-description" rows="3" placeholder="Enter presentation description"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="project">Project</label>
                                <select id="project" name="project" required>
                                    <option value="" disabled selected>Select project</option>
                                    <?php
                                    $projects = $project->getAllProjects();
                                    foreach ($projects as $project) {
                                        echo "<option value=\"{$project['projectID']}\">{$project['project_title']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="date">Presentation Date</label>
                                <div class="calendar-section">
                                    <!-- Calendar Header -->
                                    <div class="calendar-header">
                                        <button id="prev-month" class="nav-btn">&lt;</button>
                                        <span id="month-display" class="month-display"></span>
                                        <button id="next-month" class="nav-btn">&gt;</button>
                                    </div>
                            
                                    <!-- Calendar Table -->
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>S</th>
                                                <th>M</th>
                                                <th>T</th>
                                                <th>W</th>
                                                <th>T</th>
                                                <th>F</th>
                                                <th>S</th>
                                            </tr>
                                        </thead>
                                        <tbody id="calendar"></tbody>
                                    </table>
                                </div>
                                <!-- Hidden input to store selected date -->
                                <input type="hidden" id="date" name="date">
                            </div>

                            <div class="form-group">
                                <label for="start-time">Presentation Start Time</label>
                                <input type="time" id="start-time" name="start-time" required>
                            </div>

                            <div class="form-group">
                                <label for="end-time">Presentation End Time</label>
                                <input type="time" id="end-time" name="end-time" required>
                            </div>

                            <div class="form-group">
                                <label for="mode">Mode of Presentation</label>
                                <select id="mode" name="mode" required>
                                    <option value="" disabled selected>Select Mode</option>
                                    <option value="Online">Online</option>
                                    <option value="Physical">Physical</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="location">Location</label>
                                <input type="text" id="location" name="location" placeholder="Enter location">
                            </div>

                            <div class="form-group">
                                <label for="url">Online Presentation URL</label>
                                <input type="url" id="url" name="url" placeholder="Enter presentation URL">
                            </div>

                            <!-- submit and reset buttons -->
                            <div class="form-buttons">
                                <button type="submit" class="btn submit-btn" name="submit">Submit</button>
                                <button type="reset" class="btn reset-btn">Reset</button>
                            </div>
                        </form>
                    </div>
                    <?php if (!empty($successMessage)): ?>
                        <script>alert("<?php echo $successMessage; ?>");</script>
                    <?php endif; ?>
                    
                    <?php if (!empty($errorMessage)): ?>
                        <script>alert("<?php echo $errorMessage; ?>");</script>
                    <?php endif; ?>
                </section>
            </div>
        </div>
        <?php $base->renderFooter() ?>
    </div>
</body>
</html>

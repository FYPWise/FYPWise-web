<?php
use App\Models\Base;
use App\Models\Meeting;
use App\Models\Db;

$db = new Db();
$base = new Base("Schedule a Meeting", ["lecturer", "student"]);
// $base = new Base("Schedule a Meeting");
$meeting = new Meeting($db);

$successMessage = "";
$errorMessage = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    if (
        empty($_POST['date']) ||
        empty($_POST['start-time']) ||
        empty($_POST['end-time']) ||
        empty($_POST['mode']) ||
        empty($_POST['meeting-title'])
    ) {
        $errorMessage = "Please fill out all required fields.";
    } else {
        try {
            $meetingId = $meeting->createMeeting(
                $_POST['date'],
                $_POST['start-time'],
                $_POST['end-time'],
                $_POST['mode'],
                $_POST['location'] ?? null,
                $_POST['meeting-title'],
                $_POST['meeting-description'] ?? null,
                $_POST['meeting-url'] ?? null
            );
            $successMessage = "Meeting scheduled successfully!";
        } catch (\Exception $e) {
            $errorMessage = "Error scheduling the meeting: " . $e->getMessage();
        }
    }
}
?>

<head>
    <link rel="stylesheet" href="/FYPWise-web/src/css/meeting-style.css">
    <link rel="stylesheet" href="/FYPWise-web/src/css/form-style.css">
    <link rel="stylesheet" href="/FYPWise-web/src/css/calendar-style.css?v=<?php echo time(); ?>">
    <script src="/FYPWise-web/src/scripts/calendar.js?v=<?php echo time(); ?>"></script>
    <style>
        .scrollable-list {
            max-height: 200px; /* Set a fixed height for scrolling */
            overflow-y: auto; /* Enable vertical scrolling */
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
                        <form class="form" id="meetingForm" method="POST" action="" onsubmit="return validateForm()">
                            <div class="form-group">
                                <label for="meeting-title">Meeting Title</label>
                                <input type="text" id="meeting-title" name="meeting-title" placeholder="Enter meeting title" required>
                            </div>

                            <div class="form-group">
                                <label for="meeting-description">Meeting Description</label>
                                <textarea id="meeting-description" name="meeting-description" rows="3" placeholder="Enter meeting description"></textarea>    
                            </div>
                            
                            <div class="form-group">
                                <label for="date">Meeting Date</label>
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
                                <label for="start-time">Start Time</label>
                                <input type="time" id="start-time" name="start-time" required>
                            </div>

                            <div class="form-group">
                                <label for="end-time">End Time</label>
                                <input type="time" id="end-time" name="end-time" required>
                            </div>
                            
                            <div class="form-group">
                                <label>Select Participants</label>
                                <div id="participants-container">
                                    <div class="scrollable-list">
                                        <?php
                                        $users = $db->query("SELECT id, name, role FROM users WHERE role IN ('lecturer', 'student')");
                                        foreach ($users as $user) {
                                            echo "<div class='participant' data-id='{$user['id']}'>";
                                            echo "{$user['name']} ({$user['role']})";
                                            echo "</div>";
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>

                            <!-- Hidden input field to store selected participants -->
                            <input type="hidden" id="participants" name="participants" value="">

                            <!-- Display selected participants -->
                            <div class="form-group">
                                <label>Participants selected:</label>
                                <ul id="selected-participants"></ul>
                            </div>

                            <script>
                                document.addEventListener("DOMContentLoaded", function () {
                                    const participants = document.querySelectorAll(".participant");
                                    const selectedParticipantsList = document.getElementById("selected-participants");
                                    const hiddenInput = document.getElementById("participants");

                                    let selectedIds = [];

                                    participants.forEach(participant => {
                                        participant.addEventListener("click", function () {
                                            const participantId = this.getAttribute("data-id");

                                            // Toggle selection
                                            if (selectedIds.includes(participantId)) {
                                                selectedIds = selectedIds.filter(id => id !== participantId);
                                                this.classList.remove("selected");
                                            } else {
                                                selectedIds.push(participantId);
                                                this.classList.add("selected");
                                            }

                                            // Update the hidden input value
                                            hiddenInput.value = selectedIds.join(",");

                                            // Update the selected participants list
                                            selectedParticipantsList.innerHTML = "";
                                            selectedIds.forEach(id => {
                                                let selectedText = document.querySelector(`.participant[data-id='${id}']`).textContent;
                                                let li = document.createElement("li");
                                                li.textContent = selectedText;
                                                selectedParticipantsList.appendChild(li);
                                            });

                                            // If no participants are selected, show a placeholder message
                                            if (selectedIds.length === 0) {
                                                selectedParticipantsList.innerHTML = "<li>No participants selected</li>";
                                            }
                                        });
                                    });
                                });
                            </script>

                            <div class="form-group">
                                <label for="mode">Mode of Meeting</label>
                                <select id="mode" name="mode" required>
                                    <option value="" disabled selected>Select Mode</option>
                                    <option value="online">Online</option>
                                    <option value="physical">Physical</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="location">Location</label>
                                <input type="text" id="location" name="location" placeholder="Enter location">
                            </div>
                            

                            <div class="form-group">
                                <label for="meeting-url">Meeting URL</label>
                                <input type="url" id="meeting-url" name="meeting-url" placeholder="Enter meeting URL">
                            </div>
                            
                            <!-- submit and reset buttons -->
                            <div class="form-buttons">
                                <button type="submit" class="btn submit-btn" name="submit">Submit</button>
                                <button type="reset" class="btn reset-btn">Reset</button>
                            </div>
                        </form>
                    </div>

                    <script>
                        function validateForm() {
                            let date = document.getElementById('date').value;
                            let startTime = document.getElementById('start-time').value;
                            let endTime = document.getElementById('end-time').value;
                            let mode = document.getElementById('mode').value;
                            let title = document.getElementById('meeting-title').value;

                            if (!date || !startTime || !endTime || !mode || !title) {
                                alert("Please fill out all required fields.");
                                return false;
                            }
                            return true;
                        }
                    </script>

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
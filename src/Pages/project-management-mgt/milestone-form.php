<?php
use App\Models\Base;
use App\Models\Db;
use App\Models\Project;

$base = new Base("Milestone Form");
$db = new Db();
$projectModel = new Project($db);

// Get next milestone ID and timeline ID
$nextMilestoneID = $projectModel->getNextMilestoneID();
$timelineID = $_POST['timelineID'] ?? $projectModel->getLatestTimelineID(); // Ensure timelineID is set

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save'])) {
    $milestoneTitle = $_POST['milestone-title'] ?? null;
    $milestoneDescription = $_POST['milestone-description'] ?? null;
    $startDate = $_POST['start-date'] ?? null;
    $endDate = $_POST['end-date'] ?? null;
    $timelineID = $_POST['timelineID'] ?? $projectModel->getLatestTimelineID(); // Assign proper timeline ID

    // Debugging - Ensure all values are received
    echo "<pre>DEBUG: Form Data Received</pre>";
    print_r($_POST);

    if (!$timelineID || empty($timelineID)) {
        die("<script>alert('❌ Error: timelineID is missing or invalid. Please try again.');</script>");
    }

    if ($milestoneTitle && $milestoneDescription && $startDate && $endDate) {
        $saveResult = $projectModel->saveMilestone($milestoneTitle, $milestoneDescription, $startDate, $endDate, $timelineID);

        if ($saveResult) {
            echo "<script>alert('✅ Milestone saved successfully!'); window.location.href='/FYPWise-web/milestoneform';</script>";
            exit();
        } else {
            echo "<script>alert('❌ Error saving milestone. Please try again.');</script>";
        }
    } else {
        echo "<script>alert('⚠️ All fields are required.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Milestone Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .container {
            width: 100%;
            max-width: 600px;
            background: white;
            padding: 40px 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            margin-top: 50px;
            margin-bottom: 50px;
        }
        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        .btn {
            padding: 12px 18px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            font-size: 16px;
        }
        .submit-btn {
            background: #28a745;
            color: white;
        }
        .reset-btn {
            background: #dc3545;
            color: white;
        }
        .back-btn {
            background: #007bff;
            color: white;
            width: 100%;
            margin-top: 15px;
        }
        .btn:hover {
            opacity: 0.8;
        }
    </style>
</head>


<body>
    <div class="container">
        <h2>Milestone Form</h2>
        <hr>
        <form method="POST">
            <input type="hidden" name="milestoneID" value="<?= htmlspecialchars($nextMilestoneID) ?>">
            <input type="hidden" name="timelineID" value="<?= htmlspecialchars($timelineID) ?>">
            <input type="hidden" name="milestoneID" value="<?= htmlspecialchars($nextMilestoneID) ?>">
            
            <div class="form-group">
                <label>Milestone Title</label>
                <input type="text" name="milestone-title" placeholder="Enter milestone title..." required>
            </div>
            <div class="form-group">
                <label>Milestone Description</label>
                <textarea name="milestone-description" placeholder="Enter milestone description..." required></textarea>
            </div>
            <div class="form-group">
                <label>Start Date</label>
                <input type="date" name="start-date" required>
            </div>
            <div class="form-group">
                <label>End Date</label>
                <input type="date" name="end-date" required>
            </div>
            <div>
                <button type="submit" class="btn submit-btn" name="save">Submit</button>
                <button type="reset" class="btn reset-btn">Reset</button>
            </div>
        </form>
        <!-- Back Button -->
        <button class="btn back-btn" onclick="window.location.href='/FYPWise-web/projecttimelineplanning';">Back to Timeline Planning</button>
    </div>
</body>
</html>

<?php
use App\Models\Base;
use App\Models\Db;
use App\Models\Project;

$base = new Base("Milestone Form");
$db = new Db();
$projectModel = new Project($db);

$nextMilestoneID = $_GET['nextMilestoneID'] ?? $projectModel->getNextMilestoneID();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Milestone Form</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        #outer-container {
            width: 100%;
        }

        #main-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            width: 100%;
            padding-top: 100px;
            margin-bottom: 100px;
            /* Add space between form and footer */
        }

        .content {
            width: 50%;
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            margin-bottom: 50px;
            /* Additional spacing */
        }

        .form-title {
            color: #0044cc;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .form {
            width: 100%;
        }

        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }

        .form-group label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        textarea,
        input[type="date"],
        input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .form-buttons {
            display: flex;
            justify-content: space-between;
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

        .btn:hover {
            opacity: 0.8;
        }
    </style>
</head>

<body>
    <div id="outer-container">
        <?php $base->renderHeader() ?>

        <div id="main-container">
            <div class="content">
                <h2 class="form-title">Milestone Form</h2>
                <hr>
                <form id="milestone-form" class="form" method="POST" action="milestone-form.php">
                    <input type="hidden" name="milestoneID" value="<?= htmlspecialchars($nextMilestoneID) ?>">

                    <div class="form-group">
                        <label for="milestone-id">Milestone ID</label>
                        <p id="milestone-id"><?= htmlspecialchars($nextMilestoneID) ?></p>
                    </div>
                    <div class="form-group">
                        <label for="milestone-title">Milestone Title</label>
                        <input type="text" id="milestone-title" name="milestone-title"
                            placeholder="Enter milestone title..." required>
                    </div>
                    <div class="form-group">
                        <label for="milestone-description">Milestone Description</label>
                        <textarea id="milestone-description" name="milestone-description"
                            placeholder="Enter milestone description..." required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="start-date">Start Date</label>
                        <input type="date" id="start-date" name="start-date" required>
                    </div>
                    <div class="form-group">
                        <label for="end-date">End Date</label>
                        <input type="date" id="end-date" name="end-date" required>
                    </div>
                    <div class="form-buttons">
                        <button type="submit" class="btn submit-btn" name="save">Submit</button>
                        <button type="reset" class="btn reset-btn">Reset</button>
                    </div>
                </form>
            </div>
        </div>

        <?php $base->renderFooter() ?>
    </div>
</body>

</html>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save'])) {
    $milestoneID = $_POST['milestoneID'] ?? null;
    $milestoneTitle = $_POST['milestone-title'] ?? null;
    $milestoneDescription = $_POST['milestone-description'] ?? null;
    $startDate = $_POST['start-date'] ?? null;
    $endDate = $_POST['end-date'] ?? null;
    $timelineID = 1; // Assuming it belongs to timeline 1 (Modify as needed)

    if ($milestoneTitle && $startDate && $endDate) {
        $saveResult = $projectModel->saveMilestone($milestoneTitle, $startDate, $endDate, $timelineID);

        if ($saveResult) {
            echo "<script>alert('Milestone saved successfully!'); window.location.href='/FYPWise-web/milestoneform';</script>";
        } else {
            echo "<script>alert('Error saving milestone.');</script>";
        }
    } else {
        echo "<script>alert('All fields are required.');</script>";
    }
}
?>
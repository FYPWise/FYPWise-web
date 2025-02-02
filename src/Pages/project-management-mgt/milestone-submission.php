<?php
use App\Models\Base;
use App\Models\Db;
use App\Models\Project;

$base = new Base("Milestone Submission", ['lecturer']);
$db = new Db();
$projectModel = new Project($db);

$milestoneID = $_GET['milestoneID'] ?? null;

if (!$milestoneID) {
    die("Milestone ID not provided.");
}

$milestone = $projectModel->getMilestoneByID($milestoneID);

if (!$milestone) {
    die("Milestone with ID {$milestoneID} not found.");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Milestone Submission</title>
    <link rel="icon" type="image/png" href="../assets/main_logo.png" />
    <link rel="stylesheet" href="../css/form-style.css">
    <link rel="stylesheet" href="../css/common-ui.css">
    <link rel="stylesheet" href="../css/nav-bar.css">
    <link rel="stylesheet" href="../css/footer.css">

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
            padding-top: 50px;
        }

        .content {
            width: 70%;
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .form-title {
            color: #0044cc;
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 20px;
            border-bottom: 2px solid #0044cc;
            padding-bottom: 5px;
        }

        .info-group {
            margin-bottom: 15px;
            font-size: 16px;
            text-align: left;
        }

        .info-label {
            font-weight: bold;
            color: #06509f;
            display: block;
            margin-bottom: 5px;
        }

        .info-text {
            background-color: transparent;
            border: none;
            font-size: 16px;
            color: #333;
            padding: 5px 0;
            display: block;
        }

        .button-container {
            margin-top: 20px;
        }

        .back-btn {
            background: #007bff;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
            display: inline-block;
        }

        .back-btn:hover {
            background: #0056b3;
        }

        .footer-space {
            margin-bottom: 50px;
        }

        @media (max-width: 768px) {
            .content {
                width: 90%;
            }
        }
    </style>
</head>

<body>
    <!-- Outer Container -->
    <div id="outer-container">
        <?php $base->renderHeader(); ?>

        <?php $base->renderMenu(); ?>

        <div id="main-container">
            <div class="content">
                <h2 class="form-title">Milestone Submission</h2>

                <div class="info-group">
                    <span class="info-label">Milestone ID</span>
                    <span class="info-text"><?= htmlspecialchars($milestone['milestoneID']) ?></span>
                </div>

                <div class="info-group">
                    <span class="info-label">Milestone Title</span>
                    <span class="info-text"><?= htmlspecialchars($milestone['milestone_title']) ?></span>
                </div>

                <div class="info-group">
                    <span class="info-label">Milestone Description</span>
                    <p class="info-text"><?= nl2br(htmlspecialchars($milestone['milestone_description'])) ?></p>
                </div>

                <div class="info-group">
                    <span class="info-label">Start Date</span>
                    <span class="info-text"><?= htmlspecialchars($milestone['milestone_start_date']) ?></span>
                </div>

                <div class="info-group">
                    <span class="info-label">End Date</span>
                    <span class="info-text"><?= htmlspecialchars($milestone['milestone_end_date']) ?></span>
                </div>

                <!-- Back Button -->
                <div class="button-container">
                    <a href="/FYPWise-web/supervisorprojecttimeline" class="back-btn">⬅ Back to Project Timeline</a>
                </div>

            </div>
        </div>

        <div class="footer-space"></div>
        <?php $base->renderFooter(); ?>
    </div>
</body>

</html>

<?php

use App\Models\Base;
use App\Models\Db;
use App\Models\Project;
use App\Models\Proposal;

$base = new Base("Student Project Assignment");
$db = new Db();
$projectModel = new Project($db);
$proposalModel = new Proposal($db);

$projectID = $_GET['projectID'] ?? null;
$proposalID = $_GET['proposalID'] ?? null;

$proposal = $proposalModel->getProposalByID($proposalID);
$project = $projectModel->getProjectById($projectID);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["save"])) {
    $startDate = $_POST['start_date'];
    $endDate = $_POST['end_date'];
    $studentID = $_POST['student']; // User entered Student ID

    // Convert studentID to userID
    $userID = $projectModel->getUserIDByStudentID($studentID);

    if (!$userID) {
        echo "<script>alert('❌ Error: No user found for this Student ID. Please check and try again.');</script>";
    } else {
        try {
            $success = $projectModel->updateProjectAssignment($projectID, $startDate, $endDate, $userID);

            if ($success) {
                echo "<script>alert('✅ Project successfully updated!'); window.location.href='/FYPWise-web/projectmanagement';</script>";
                exit();
            } else {
                echo "<script>alert('❌ Error: Could not update project. Please try again.');</script>";
            }
        } catch (Exception $e) {
            echo "<script>alert('❌ Database Error: " . addslashes($e->getMessage()) . "');</script>";
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign Advisee</title>
    <link rel="stylesheet" href="../css/common-ui.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7f6;
            margin: 0;
            padding: 0;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            min-height: 100vh;
            background-color: #f4f7f6;
            margin-top: 80px;
        }

        .content {
            width: 90%;
            max-width: 700px;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .form-title {
            font-size: 26px;
            color: #333;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .form-group label {
            font-weight: bold;
            display: block;
            margin: 10px 0 5px;
            font-size: 16px;
            text-align: left;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 16px;
            background-color: #f9f9f9;
        }

        .form-group span,
        .form-group div {
            display: block;
            padding: 10px;
            background: #f9f9f9;
            border-radius: 6px;
            border: 1px solid #ccc;
            text-align: left;
            font-size: 16px;
        }

        .date-container {
            display: flex;
            justify-content: space-between;
            gap: 20px;
        }

        .date-container .form-group {
            flex: 1;
        }

        .form-buttons {
            margin-top: 20px;
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .btn {
            padding: 12px 20px;
            font-size: 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.3s ease-in-out;
        }

        .save-btn {
            background: #007bff;
            color: white;
        }

        .save-btn:hover {
            background: #0056b3;
        }

        .cancel-btn {
            background: #dc3545;
            color: white;
        }

        .cancel-btn:hover {
            background: #a71d2a;
        }

        @media (max-width: 768px) {
            .content {
                width: 100%;
                max-width: 90%;
            }

            .date-container {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>
    <div id="outer-container">
        <?php $base->renderHeader(); ?>

        <div class="container">
            <div class="content">
                <h2 class="form-title">Assign Advisee</h2>

                <form action="" method="POST">
                    <input type="hidden" name="projectID" value="<?php echo htmlspecialchars($projectID); ?>">
                    <input type="hidden" name="proposalID" value="<?php echo htmlspecialchars($proposalID); ?>">

                    <p><strong>PROPOSAL ID:</strong> <?php echo htmlspecialchars($proposalID); ?></p>
                    <p><strong>PROJECT ID:</strong> <?php echo htmlspecialchars($projectID); ?></p>

                    <div class="form-group">
                        <label><strong>Proposal Title:</strong></label>
                        <span><?php echo htmlspecialchars($proposal['proposal_title']); ?></span>
                    </div>

                    <div class="form-group">
                        <label><strong>Description:</strong></label>
                        <div><?php echo htmlspecialchars($proposal['proposal_description']); ?></div>
                    </div>

                    <div class="date-container">
                        <div class="form-group">
                            <label for="start_date">Start Date:</label>
                            <input type="date" id="start_date" name="start_date" required>
                        </div>

                        <div class="form-group">
                            <label for="end_date">End Date:</label>
                            <input type="date" id="end_date" name="end_date" required>
                        </div>
                    </div>

                    <div class="form-group">
                    <label for="student">Student ID:</label>
<input type="text" id="student" name="student" required placeholder="Enter Student ID">

                    </div>

                    <div class="form-buttons">
                        <button type="submit" class="btn save-btn" name="save">Save</button>
                        <button type="button" class="btn cancel-btn" onclick="window.history.back();">Cancel</button>
                    </div>
                </form>
            </div>
        </div>

        <?php $base->renderFooter(); ?>
    </div>
</body>
</html>

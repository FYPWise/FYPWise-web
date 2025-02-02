<?php

use App\Models\Base;
use App\Models\Db;
use App\Models\Project;
use App\Models\ProposalFetcher; 

$base = new Base("Student Project Assignment", ['lecturer']);
$db = new Db();
$projectModel = new Project($db);
$proposalFetcher = new ProposalFetcher($db); // Use the new ProposalFetcher

$projectID = $_GET['projectID'] ?? null;
$proposalID = $_GET['proposalID'] ?? null;

// Debugging: Ensure `proposalID` is passed
if (!$proposalID) {
    die("<script>alert('❌ ERROR: Proposal ID is missing. Please check project linkage.'); window.history.back();</script>");
}

// Fetch proposal safely using new model
try {
    $proposal = $proposalFetcher->fetchProposalByID($proposalID);
    if (!$proposal) {
        die("<script>alert('❌ ERROR: No matching proposal found in the database for ID " . htmlspecialchars($proposalID) . "'); window.history.back();</script>");
    }
} catch (Exception $e) {
    die("<script>alert('❌ SQL ERROR: " . addslashes($e->getMessage()) . "');</script>");
}

// Fetch project details
try {
    $project = $projectModel->getProjectById($projectID);
} catch (Exception $e) {
    error_log("Project Fetch Error: " . $e->getMessage());
    $project = null;
}

// Handling form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["save"])) {
    $startDate = $_POST['start_date'];
    $endDate = $_POST['end_date'];
    $studentID = $_POST['student'];

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
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7f6;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            min-height: 100vh;
        }

        #outer-container {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .header,
        .footer {
            width: 100%;
            background-color: #003366;
            /* Dark blue */
            color: white;
            text-align: center;
            padding: 15px 0;
            font-size: 18px;
            font-weight: bold;
        }

        .container {
            width: 100%;
            max-width: 600px;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
            margin-top: 100px;
            /* Push form below header */
        }

        .form-title {
            font-size: 28px;
            color: #333;
            margin-bottom: 20px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .form-group label {
            font-weight: bold;
            display: block;
            font-size: 16px;
            margin-bottom: 5px;
        }

        .form-group span,
        .form-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 16px;
            background-color: #f9f9f9;
            display: block;
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
            justify-content: space-between;
        }

        .btn {
            padding: 14px 20px;
            font-size: 18px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            width: 48%;
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

        /* Full-width fixed footer */
        .footer {
            margin-top: auto;
            padding: 20px;
            background-color: #003366;
            color: white;
            text-align: center;
            width: 100%;
            position: fixed;
            bottom: 0;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                width: 90%;
                max-width: 90%;
                margin-top: 80px;
            }

            .form-buttons {
                flex-direction: column;
                gap: 10px;
            }

            .btn {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <div id="outer-container">
        <?php $base->renderHeader(); ?>
       

        <div class="container">
            <h2 class="form-title">Assign Advisee</h2>

            <?php if (!$proposal): ?>
                <p style="color: red; font-weight: bold;">❌ Unable to load proposal details.</p>
            <?php else: ?>
                <form action="" method="POST">
                    <input type="hidden" name="projectID" value="<?php echo htmlspecialchars($projectID); ?>">
                    <input type="hidden" name="proposalID" value="<?php echo htmlspecialchars($proposalID); ?>">

                    <div class="form-group">
                        <label><strong>Proposal ID:</strong></label>
                        <span><?php echo htmlspecialchars($proposalID); ?></span>
                    </div>

                    <div class="form-group">
                        <label><strong>Project ID:</strong></label>
                        <span><?php echo htmlspecialchars($projectID); ?></span>
                    </div>

                    <div class="form-group">
                        <label><strong>Proposal Title:</strong></label>
                        <span><?php echo htmlspecialchars($proposal['proposal_title']); ?></span>
                    </div>

                    <div class="form-group">
                        <label><strong>Description:</strong></label>
                        <div><?php echo htmlspecialchars($proposal['proposal_description']); ?></div>
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
            <?php endif; ?>

        </div>

        <?php $base->renderFooter(); ?>
    </div>
</body>


</html>

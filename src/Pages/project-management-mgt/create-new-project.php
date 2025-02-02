<?php
use App\Models\Base;
use App\Models\Db;
use App\Models\Project;

$base = new Base("Create New Project", "lecturer");
$db = new Db();
$projectModel = new Project($db);

// Fetch accepted proposals from database
$acceptedProposals = $projectModel->getAcceptedProposals();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_project'])) {
    $proposalID = $_POST['proposalID'] ?? null;
    $projectTitle = $_POST['project_title'] ?? null;
    $startDate = $_POST['start_date'] ?? null;
    $endDate = $_POST['end_date'] ?? null;
    $projectDescription = $_POST['project_description'] ?? null;

    if (!isset($proposalID) || empty($proposalID)) {
        echo "<script>alert('⚠️ Please select a proposal before creating a project.');</script>";
    } else if ($proposalID && $projectTitle && $startDate && $endDate && $projectDescription) {
        $result = $projectModel->createProject($proposalID, $projectTitle, $startDate, $endDate, $projectDescription);
    

        if ($result) {
            echo "<script>
                    alert('✅ Project created successfully!');
                    window.location.href='/FYPWise-web/createproject';
                  </script>";
            exit();
        } else {
            echo "<script>alert('❌ Error creating project. Please try again.');</script>";
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
    <title>Create New Project</title>
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
        }
        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }
        select, input, textarea {
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
        <h2>Create New Project</h2>
        <hr>
        <form method="POST">
            <div class="form-group">
                <label>Select Accepted Proposal</label>
                <select name="proposalID" required>
                    <option value="" disabled selected>-- Select Proposal --</option>
                    <?php foreach ($acceptedProposals as $proposal) : ?>
                        <option value="<?= htmlspecialchars($proposal['proposalID']) ?>">
                            <?= htmlspecialchars($proposal['proposal_title']) ?> (Status: <?= htmlspecialchars($proposal['status']) ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Project Title</label>
                <input type="text" name="project_title" placeholder="Enter project title..." required>
            </div>
            <div class="form-group">
                <label>Start Date</label>
                <input type="date" name="start_date" required>
            </div>
            <div class="form-group">
                <label>End Date</label>
                <input type="date" name="end_date" required>
            </div>
            <div class="form-group">
                <label>Project Description</label>
                <textarea name="project_description" placeholder="Enter project description..." required></textarea>
            </div>
            <div>
                <button type="submit" class="btn submit-btn" name="save_project">Create Project</button>
                <button type="reset" class="btn reset-btn">Reset</button>
            </div>
        </form>
        <!-- Back Button -->
        <button class="btn back-btn" onclick="window.location.href='/FYPWise-web/projectmanagement';">Back to Project Management</button>
    </div>
</body>
</html>

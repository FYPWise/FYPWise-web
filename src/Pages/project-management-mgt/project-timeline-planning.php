<?php
use App\Models\Base;
use App\Models\Db;
use App\Models\Project;
use App\Models\File;

$base = new Base("Project Timeline Planning");
$db = new Db();
$projectModel = new Project($db);
$file = new File();

// Fetch all submitted milestones from database
$milestones = $projectModel->getSubmittedMilestones();
$nextMilestoneID = $projectModel->getNextMilestoneID();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['gantt_chartbtn'])) {
        $file->uploadFile('gantt_chart', './uploads/Gantt Chart/', 'project_timeline', 'gantt_chart_pdf');
    } elseif (isset($_POST['flow_chartbtn'])) {
        $file->uploadFile('flow_chart', './uploads/Flow Chart/', 'project_timeline', 'flow_chart_pdf');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Timeline Planning</title>

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 20px;
        }

        .page-header {
            background: #0044cc;
            color: white;
            padding: 18px;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .milestone-section, .file-upload-section {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            margin-bottom: 20px;
        }

        .milestone-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        .milestone-table th, .milestone-table td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: left;
            white-space: nowrap;
        }

        .milestone-table th:nth-child(2),
        .milestone-table td:nth-child(2) {
            width: 15%;
        }

        .milestone-table th:nth-child(3),
        .milestone-table td:nth-child(3) {
            width: 30%;
        }

        .milestone-table th {
            background: #ff4d4d;
            color: white;
        }

        .milestone-id {
            font-weight: bold;
            color: #0044cc;
        }

        .status-dropdown {
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            background: white;
            font-size: 14px;
            width: 100%;
        }

        .status-btn {
            background: #28a745;
            padding: 10px 18px;
            width: auto;
        }

        .add-milestone-btn {
            display: block;
            text-align: center;
            background: #0044cc;
            color: white;
            padding: 12px 16px;
            border-radius: 8px;
            font-weight: bold;
            text-decoration: none;
            width: 180px;
            margin: 20px auto;
            transition: 0.3s;
        }

        .add-milestone-btn:hover {
            background: #003399;
        }

        .file-upload {
            margin-top: 20px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            background: white;
        }

        .file-upload label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        .file-box {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            text-align: center;
            background: #f1f1f1;
            margin-bottom: 10px;
        }

        .btn {
            background: #0044cc;
            color: white;
            padding: 10px 16px;
            border: none;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
            display: block;
            text-align: center;
            width: 120px;
            margin: 10px auto;
        }

        .btn:hover {
            background: #003399;
        }

        /* Responsive Design */
        @media screen and (max-width: 900px) {
            .container {
                padding: 15px;
            }

            .milestone-table th, .milestone-table td {
                padding: 10px;
                font-size: 14px;
            }

            .milestone-table th:nth-child(2),
            .milestone-table td:nth-child(2) {
                width: 20%;
            }

            .milestone-table th:nth-child(3),
            .milestone-table td:nth-child(3) {
                width: 35%;
            }
        }

    </style>
</head>
<body>
    <div id="outer-container">
        <?php $base->renderHeader() ?>

        <div class="container">
            <div class="page-header">Project Timeline Planning</div>

            <!-- Milestones Section -->
            <div class="milestone-section">
                <h2 style="text-align: center;">Milestones</h2>
                <form action="/FYPWise-web/update-milestone-status" method="POST">
                    <table class="milestone-table">
                        <thead>
                            <tr>
                                <th>Milestone ID & Title</th>
                                <th>End Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($milestones as $milestone) : ?>
                                <tr>
                                    <td>
                                        <span class="milestone-id">#<?= htmlspecialchars($milestone['milestoneID']) ?></span> - 
                                        <?= htmlspecialchars($milestone['milestone_title']) ?>
                                    </td>
                                    <td><?= htmlspecialchars($milestone['milestone_end_date']) ?></td>
                                    <td>
                                        <input type="hidden" name="milestoneID[]" value="<?= htmlspecialchars($milestone['milestoneID']) ?>">
                                        <select name="status[]" class="status-dropdown">
                                            <option value="not-started" <?= $milestone['status'] == 'not-started' ? 'selected' : '' ?>>Not Started</option>
                                            <option value="in-progress" <?= $milestone['status'] == 'in-progress' ? 'selected' : '' ?>>In Progress</option>
                                            <option value="completed" <?= $milestone['status'] == 'completed' ? 'selected' : '' ?>>Completed</option>
                                        </select>
                                    </td>
                                    <td>
                                        <button type="submit" name="milestone" class="btn status-btn">Update</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </form>
                <a href="/FYPWise-web/milestoneform?nextMilestoneID=<?= htmlspecialchars($projectModel->getNextMilestoneID()) ?>" class="btn">Add Milestone</a>
                </div>

            <!-- File Upload Section -->
            <div class="file-upload-section">
                <h2 style="text-align: center;">Upload Gantt & Flow Charts</h2>

                <!-- Gantt Chart Upload -->
                <form method="POST" enctype="multipart/form-data">
                    <div class="file-upload">
                        <label for="gantt_chart">Gantt Chart (Upload PDF)</label>
                        <input type="file" name="gantt_chart" accept=".pdf">
                        <br>
                        <button type="submit" name="gantt_chartbtn" class="btn">Submit</button>
                    </div>
                </form>

                <!-- Flow Chart Upload -->
                <form method="POST" enctype="multipart/form-data">
                    <div class="file-upload">
                        <label for="flow_chart">Flow Chart (Upload PDF)</label>
                        <input type="file" name="flow_chart" accept=".pdf">
                        <br>
                        <button type="submit" name="flow_chartbtn" class="btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>

        <?php $base->renderFooter() ?>
    </div>
</body>
</html>
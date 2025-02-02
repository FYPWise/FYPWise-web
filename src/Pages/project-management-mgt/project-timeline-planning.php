<?php
use App\Models\Base;
$base = new Base("Page Skeleton");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Timeline Planning</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to external CSS -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 90%;
            margin: auto;
            padding: 20px;
        }
        .page-header {
            background: #0044cc;
            color: white;
            padding: 15px;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            background: white;
            border-collapse: collapse;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        th, td {
            padding: 15px;
            text-align: center;
        }
        th {
            background-color: #0044cc;
            color: white;
            font-size: 20px;
        }
        td {
            font-size: 18px;
        }
        .milestone-section {
            background: #ff4d4d;
            color: white;
            padding: 20px;
            border-radius: 5px;
            text-align: center;
            font-size: 18px;
        }
        .milestone-section ul {
            list-style-type: none;
            padding: 0;
        }
        .milestone-section li {
            padding: 5px 0;
            font-size: 16px;
        }
        .add-btn {
            background: white;
            color: #ff4d4d;
            padding: 10px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            display: inline-block;
            margin-top: 10px;
        }
        .button-group {
            margin-top: 10px;
        }
        .btn {
            background: #0044cc;
            color: white;
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }
        .btn:hover {
            background: #003399;
        }
    </style>
</head>
<body>
    <div id="outer-container">
        <?php $base->renderHeader() ?>

        <div class="container">
            <div class="page-header">Project Timeline Planning</div>
            <table>
                
                <tr>
                    <td style="width: 70%;">
                        <strong>Gantt Chart</strong>
                        <br>Click Edit to Access Your Gantt Chart
                        <br>
                        <div class="button-group">
                            <button class="btn" onclick="navigateToEdit('gantt')">Edit</button>
                            <button class="btn" onclick="submitChart('Gantt Chart')">Submit</button>
                        </div>
                    </td>
                    <td rowspan="2" class="milestone-section">
                        <strong>Milestones</strong>
                        <ul>
                            <li>Submit Project Proposal</li>
                            <li>Complete System Development</li>
                            <li>Prepare Final Presentation</li>
                        </ul>
                        <a href="../project-management-mgt/milestone-form.html" class="add-btn">Add Milestone</a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <strong>Flow Chart</strong>
                        <br>Click Edit to Access Your Flow Chart
                        <br>
                        <div class="button-group">
                            <button class="btn" onclick="navigateToEdit('flow')">Edit</button>
                            <button class="btn" onclick="submitChart('Flow Chart')">Submit</button>
                        </div>
                    </td>
                </tr>
            </table>
        </div>

        <?php $base->renderFooter() ?>
    </div>
</body>
</html>
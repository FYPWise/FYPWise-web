<?php
use App\Models\Base;
use App\Models\Marksheet;
use App\Models\CriteriaModel;
use App\Models\Db;

$base = new Base("Marksheet Details");
$db = new Db();
$marksheetModel = new Marksheet($db);
$criteriaModel = new CriteriaModel($db);

$marksheetID = isset($_GET['marksheetID']) ? htmlspecialchars($_GET['marksheetID']) : 'Unknown';
$criteriaScores = $criteriaModel->getCriteriaScoresByMarksheetID($marksheetID);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marksheet Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            text-align: center;
        }
        .container {
            max-width: 700px;
            margin: 3em auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1em;
        }
        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #007bff;
            color: blue;
        }
        .back-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 15px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .back-btn:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Marksheet Details</h2>
    <h3>Marksheet ID: <?= htmlspecialchars($marksheetID) ?></h3>

    <table>
        <thead>
            <tr>
                <th>Criteria</th>
                <th>Score</th>
                <th>Comments</th>
            </tr>
        </thead>
        <tbody>
        <?php
        if (!empty($criteriaScores)) {
            foreach ($criteriaScores as $row) {
                echo "<tr>";
                echo "<td>".htmlspecialchars($row['criteria'])."</td>";
                echo "<td>".htmlspecialchars($row['score'])."</td>";
                echo "<td>".htmlspecialchars($row['comment'])."</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No scores found.</td></tr>";
        }
        ?>
        </tbody>
    </table>

    <a href="/FYPWise-web/marksheetpage" class="back-btn">Back to Marksheet</a>
</div>

</body>
</html>

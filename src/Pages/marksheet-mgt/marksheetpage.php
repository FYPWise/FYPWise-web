<?php
use App\Models\Base;
use App\Models\Marksheet;
use App\Models\Db;

$base = new Base("Marksheet Page");
$db = new Db();
$marksheetModel = new Marksheet($db);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marksheet Page</title>
    <link rel="stylesheet" href="../css/common-ui.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .table-container {
            max-width: 900px;
            margin: 2em auto;
            background-color: white;
            padding: 2em;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1em;
        }

        th {
            background-color: #343a40;
            /* Dark gray for better contrast */
            color: #007bff;
            /* White text */
            padding: 12px;
            font-weight: bold;
        }


        td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }

        td a {
            text-decoration: none;
            font-weight: bold;
            color: #007bff;
        }

        td a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div id="outer-container">
        <?php $base->renderHeader(); ?>

        <div id="main-container">
            <div class="content">
                <section class="main">
                    <h1 id="page-name"><?php echo $base->getTitle(); ?></h1>

                    <div class="table-container">
                        <table>
                            <thead>
                                <tr>
                                    <th>Project ID</th>
                                    <th>Marksheet ID</th>
                                    <th>Date</th>
                                    <th>Total Score</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $marksheets = $marksheetModel->getAllMarksheet();
                                if (empty($marksheets)) {
                                    echo "<tr><td colspan='4'>No marksheets found.</td></tr>";
                                } else {
                                    foreach ($marksheets as $row) {
                                        echo "<tr>";
                                        echo "<td>" . htmlspecialchars($row['projectID']) . "</td>";
                                        echo "<td><a href='/FYPWise-web/criteriapage/" . urlencode($row['marksheetID']) . "'>" . htmlspecialchars($row['marksheetID']) . "</a></td>";
                                        echo "<td>" . htmlspecialchars($row['date']) . "</td>";
                                        echo "<td><a href='/FYPWise-web/marksheetdetails/" . urlencode($row['marksheetID']) . "'>" . htmlspecialchars($row['total_score']) . "</a></td>";
                                        echo "</tr>";
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
        </div>

        <?php $base->renderFooter(); ?>
    </div>
</body>

</html>
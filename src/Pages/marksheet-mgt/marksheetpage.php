<?php
use App\Models\Base;
use App\Models\Marksheet;
use App\Models\Db;

$base = new Base("Marksheet");
$db = new Db();
$marksheet = new Marksheet($db);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marksheet Page</title>
    <link rel="stylesheet" href="../css/common-ui.css">
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
                                $marksheets = $marksheet->getAllMarksheet();
                                if (empty($marksheets)) {
                                    echo "<tr><td colspan='4'>No marksheets found.</td></tr>";
                                } else {
                                    foreach ($marksheets as $row) {
                                        echo "<tr>";
                                        echo "<td>".htmlspecialchars($row['projectID'])."</td>";
                                        echo "<td><a href='/FYPWise-web/criteriapage/" . urlencode($row['marksheetID']) . "'>" . htmlspecialchars($row['marksheetID']) . "</a></td>";
                                        echo "<td>".htmlspecialchars($row['date'])."</td>";
                                        echo "<td>".htmlspecialchars($row['total_score'])."</td>";
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

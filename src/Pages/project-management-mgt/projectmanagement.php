<?php
use App\Models\Base;
use App\Models\Project;
use App\Models\Db;

$base = new Base("Project Management", ['lecturer']);
$db = new Db();
$project = new Project($db);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$userID = $_SESSION['userID'] ?? null; // Retrieve userID from session

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/common-ui.css">
    <style>
        .assign-btn {
            background-color: green;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
            font-size: 0.9rem;
        }

        .assign-btn:hover {
            background-color: darkgreen;
        }

        .error-text {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div id="outer-container">
        <?php $base->renderHeader(); ?>

        <?php $base->renderMenu(); ?>

        <div id="main-container">
            <div class="content">
                <section class="main">
                    <h1 id="page-name"><?php echo $base->getTitle(); ?></h1>
                </section>

                <table class="project-table">
                    <thead>
                        <tr>
                            <th>Project Title</th>
                            <th>Advisee</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        try {
                            $projects = $project->getAllProjects();

                            if (!empty($projects)) {
                                foreach ($projects as $row) {
                                    echo "<tr>";
                                    echo "<td><a href='/project/" . urlencode($row['projectID']) . "'>" . htmlspecialchars($row['project_title']) . "</a></td>";

                                    if (!empty($row['student_name']) && $row['student_name'] !== 'Unassigned') {
                                        echo "<td>" . htmlspecialchars($row['student_name']) . "</td>";
                                    } else {
                                        if (!empty($row['proposalID'])) { 
                                            echo "<td>
                                                <a href='/FYPWise-web/studentprojectassignment?projectID=" . 
                                                    urlencode($row['projectID']) . "&proposalID=" . 
                                                    urlencode($row['proposalID']) . "' class='assign-btn'>Assign Advisee</a>
                                                <br><small>Proposal ID: " . htmlspecialchars($row['proposalID']) . "</small>
                                            </td>";
                                        } else {
                                            echo "<td><span class='error-text'>❌ No Proposal ID Found</span></td>";
                                        }

                                    }

                                    echo "<td>" . htmlspecialchars($row['project_status']) . "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='3' class='error-text'>No projects found</td></tr>";
                            }
                        } catch (Exception $e) {
                            echo "<tr><td colspan='3' class='error-text'>Error: " . htmlspecialchars($e->getMessage()) . "</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <?php $base->renderFooter(); ?>
    </div>
</body>
</html>

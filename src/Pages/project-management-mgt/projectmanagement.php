<?php
use App\Models\Base;
use App\Models\Project;
use App\Models\Db;

$base = new Base("Project Management");
$db = new Db();
$project = new Project($db);

?>
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
    </style>
</head>
<body>
    <div id="outer-container">
        <?php $base->renderHeader() ?>

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
                                    echo "<td><a href='/project/{$row['projectID']}'>" . htmlspecialchars($row['project_title']) . "</a></td>";

                                    if ($row['student_name'] !== 'Unassigned') {
                                        echo "<td>" . htmlspecialchars($row['student_name']) . "</td>";
                                    } else {
                                        echo "<td><a href='/FYPWise-web/studentprojectassignment?projectID=" . htmlspecialchars($row['projectID']) . "&proposalID=" . htmlspecialchars($row['proposalID']) . "' class='assign-btn'>Assign Advisee</a></td>";
                                    }

                                    echo "<td>" . htmlspecialchars($row['project_status']) . "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='3'>No projects found</td></tr>";
                            }
                        } catch (Exception $e) {
                            echo "<tr><td colspan='3'>Error: " . $e->getMessage() . "</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <?php $base->renderFooter() ?>
    </div>
</body>
</html>

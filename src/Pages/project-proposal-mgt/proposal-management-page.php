<?php
use App\Models\Base;
use App\Models\SideMenu;
use App\Models\Proposal;
use App\Models\Db;

$base = new Base("Proposals");
$sideMenu = new SideMenu("student");
$db = new Db();
$proposal = new Proposal($db);

?>
<head>
    <link rel="stylesheet" href="./src/css/proposal-management-style.css">
</head>
<body>
    <div id="outer-container">
        <?php $base->renderHeader() ?>

        <!-- Main Content -->
        <div id="main-container">

            <!-- Side Menu -->
            <?php $sideMenu->render(); ?>

            <div class="content">
                <section class="main">
                    <h1 id="page-name"><?php echo $base->getTitle() ?></h1>
                    <!-- Proposal Table Section -->
                    <div class="proposals">
                        <table id="proposal-table">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="select-all"></th>
                                    <th>Proposal ID</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Submission Date</th>
                                    <th>Supervisor</th>
                                    <th>Status</th>
                                    <th>Updated At</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                            try {
                                // Retrieve proposals
                                $proposals = $proposal->getAllProposals();

                                if (!empty($proposals)) {
                                    foreach ($proposals as $row) {
                                        echo "<tr>";
                                        echo "<td><input type='checkbox' class='row-checkbox' value='{$row['proposalID']}'></td>";
                                        echo "<td>{$row['proposalID']}</td>";
                                        echo "<td><a href='/FYPWise-web/proposal/{$row['proposalID']}'>{$row['proposal_title']}</a></td>";
                                        echo "<td>".htmlentities($row['proposal_description'])."</td>"; //htmlentities = for special characters
                                        echo "<td>{$row['submission_date']}</td>";
                                        echo "<td>{$row['supervisor_name']}</td>";
                                        echo "<td>{$row['status']}</td>";
                                        echo "<td>{$row['updated_at']}</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='8'>No proposals found</td></tr>";
                                }
                            } catch (Exception $e) {
                                echo "<tr><td colspan='8'>Error: " . $e->getMessage() . "</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                </section>
            </div>
        </div>

        <?php $base->renderFooter() ?>
    </div>
</body>

</html>
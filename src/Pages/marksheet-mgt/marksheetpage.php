<?php
use App\Models\Base;
//use App\Models\SideMenu;
use App\Models\Marksheet;
use App\Models\Db;

$base = new Base("Marksheet");
//$sideMenu = new SideMenu();
$db = new Db();
$marksheet = new Marksheet($db);

?>

<body>
    <div id="outer-container">
        <?php $base->renderHeader() ?>

        <!-- Main Content -->
        <div id="main-container">

            <!-- Side Menu -->
            

            <div class="content">
                <section class="main">
                    <h1 id="page-name"><?php echo $base->getTitle() ?></h1>

                    <!-- Main Content -->
                    <div class="content">
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
                                        foreach ($marksheets as $row) { ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($row['projectID']); ?></td>
                                                <td><a href="criteriascore.php?marksheetID=<?php echo $row['marksheetID']; ?>"><?php echo htmlspecialchars($row['marksheetID']); ?></a></td>

                                    

                                                <td><?php echo htmlspecialchars($row['date']); ?></td>
                                                <td><?php echo htmlspecialchars($row['total_score']); ?></td>
                                            </tr>
                                        <?php }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <?php $base->renderFooter() ?>
    </div>
</body>
</html>
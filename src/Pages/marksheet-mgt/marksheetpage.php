<?php
use App\Models\Base;
use App\Models\SideMenu;
use App\Models\Marksheet;
use App\Models\Db;

$base = new Base("Marksheet");
$sideMenu = new SideMenu();
$marksheet = new Marksheet();
$db = new Db();

$marksheets = $marksheet->getAllMarksheet();
?>

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

                    <!-- Main Content -->
                    <div class="content">
                        <h2>Marksheet</h2>
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
                                    <?php while ($row = mysqli_fetch_assoc($marksheets)) { ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($row['projectID']); ?></td>
                                            <td><a href="../marksheet-mgt/criteria-score-page.php?marksheetID=<?php echo $row['marksheetID']; ?>"> <?php echo htmlspecialchars($row['marksheetID']); ?></a></td>
                                            <td><?php echo htmlspecialchars($row['date']); ?></td>
                                            <td><?php echo htmlspecialchars($row['total_score']); ?></td>
                                        </tr>
                                    <?php } ?>
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
<?php
use App\Models\Base;
use App\Models\SideMenu;
use App\Models\Marksheet;
use App\Models\Db;

$base = new Base("Page Skeleton");
$sideMenu = new SideMenu();
$marksheet = new Marksheet();
$db = new Db();


$marksheets = $marksheet->getAllMarksheet();
?>

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

                    <!-- Main Content -->
                    <div class="content">
                        <h2>Marksheet</h2>
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
                                    <?php while ($row = mysqli_fetch_assoc($marksheets)) { ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($row['projectID']); ?></td>
                                            <td><a href="../marksheet-mgt/criteria-score-page.php?marksheetID=<?php echo $row['marksheetID']; ?>"> <?php echo htmlspecialchars($row['marksheetID']); ?></a></td>
                                            <td><?php echo htmlspecialchars($row['date']); ?></td>
                                            <td><?php echo htmlspecialchars($row['total_score']); ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- Insert Form -->
                        <form action="marksheet-insert.php" method="POST">
                            <label for="total_score">Total Score:</label>
                            <input type="number" name="total_score" required>
                            <label for="date">Date:</label>
                            <input type="datetime-local" name="date" required>
                            <label for="projectID">Project ID:</label>
                            <input type="number" name="projectID" required>
                            <button type="submit">Insert Marksheet</button>
                        </form>
                    </div>
                </section>
            </div>
        </div>
        <?php $base->renderFooter() ?>
    </div>
</body>
</html>

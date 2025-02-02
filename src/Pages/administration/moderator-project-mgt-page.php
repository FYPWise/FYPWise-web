<?php
use App\Models\Base;
use App\Models\User;
use App\Models\project;
use App\Models\Db;

$base = new Base("Assign Moderator", "admin");

if(isset($_GET['view'])){
    $userID = $_GET['view'];
    $user = new User($userID);
}


$projectC = new project(new Db());

$projects = $projectC->getAllProjects();

?>

<head>
    <link rel="stylesheet" href="./src/css/moderator-mgt-style.css">
    <link rel="stylesheet" href="./src/css/user-mgt-style.css">
</head>

<body>
    <div id="outer-container">
        <?php $base->renderHeader() ?>

        <!-- Main Content -->
        <div id="main-container">

            <!-- Side Menu -->
            <?php $base->renderMenu() ?>

            <div class="content">
                <div class="table-header-container">
                    <h2>Moderator Management</h2>

                    <div>
                        <input type="text" id="search-bar-id" placeholder="UserID...">
                        <button class="create-new-btn" type="button"
                            onclick="location.href='new-user';"></button>
                    </div>
                </div>


                <div id="table-name">
                    <table id="tablename-table">
                        <thead>
                            <th>Project ID</th>
                            <th>Moderator Assigned</th>
                            <th>
                                </tr>
                        </thead>

                        <tbody>

                            <?php
                            
                            foreach($projects as $project){
                                $moderatorID = $projectC->getModerator($project['projectID']);
                                if($moderatorID == null){
                                    $moderatorID = "Unassigned";
                                }
                                echo '<tr>';
                                echo '<td><a href="assign-moderator?id='.$project['projectID'].'">'.$project['projectID'].'</a></td>';
                                echo '<td>'.$moderatorID.'</td>';
                                echo '<td><button class="more-btn" type="button">⋮</button></td>';
                                echo '</tr>';
                            }
                            
                            ?>
                        </tbody>


                    </table>
                </div>

                <div id="output"></div>
            </div>
        </div>

        <!-- footer Section -->
        <?php $base->renderFooter() ?>
    </div>

    <!-- JavaScript -->
    <script src="../scripts/table_search.js"></script>
    <script src="../scripts/side-menu.js"></script>

    <script>
        document.querySelectorAll('.assign-status').forEach(cell => {
            const text = cell.textContent.trim(); // Get the text content of the cell
            if (text === 'Assigned') {
                cell.classList.add('assigned'); // Add 'published' class
            } else if (text === 'Unassigned') {
                cell.classList.add('unassigned'); // Add 'unpublished' class
            }
        });
    </script>

    <!-- Initialize search functionality -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            initSearch("search-bar", "proposal-table");
        });
    </script>
</body>

</html>
<?php
use App\Models\Base;
use App\Models\SideMenu;

$base = new Base("Page Skeleton");
$SideMenu = new SideMenu("admin")
?>

<head>
    <link rel="stylesheet" href="./src/css/announcements-mgt-style.css">
    <link rel="stylesheet" href="./src/css/user-mgt-style.css">
</head>

<body>
    <div id="outer-container">
        <?php $base->renderHeader() ?>

        <!-- Main Content -->
        <div id="main-container">

            <!-- Side Menu -->
            <?php $SideMenu->render(); ?>

            <div class="content">
                <div class="table-header-container">
                    <h2>User Management</h2>

                    <div class="table-buttons">
                        <button id="filter-btn"><img src="./src/assets/filter.png" alt="filter"></button>
                        <button class="create-new-btn" type="button"
                            onclick="location.href='/FYPWise-Web/new-user';"><img
                                src="./src/assets/create-new-icon.png" alt="filter"></button>
                    </div>
                </div>


                <div class="table-name">
                    <table id="tablename-table">
                        <thead>
                            <th><input title="select all" type="checkbox" id="select-all"></th>
                            <th>User ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>
                                </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td><input title="U1" type="checkbox" class="row-checkbox" value="U001"></td>
                                <td><a href="#">121110332</a></td>
                                <td>Muhammad Firzan Ruzain bin Firdus</td>
                                <td>firzanruzain@gmail.com</td>
                                <td>
                                    <p class="role">Student</p>
                                </td>
                                <td><button class="more-btn" type="button">⋮</button></td>
                            </tr>

                            <tr>
                                <td><input title="U2" type="checkbox" class="row-checkbox" value="U002"></td>
                                <td><a href="#">121110332</a></td>
                                <td>Aisyah Nabila The Legend</td>
                                <td>aisyahggxo@gmai.com</td>
                                <td>
                                    <p class="role">Moderator</p>
                                </td>
                                <td><button class="more-btn" type="button">⋮</button></td>
                            </tr>

                            <tr>
                                <td><input title="U3" type="checkbox" class="row-checkbox" value="U003"></td>
                                <td><a href="#">SV001254</a></td>
                                <td>Mohamed Imran Mamak bin 1st Gen</td>
                                <td>imranmamak@gmail.com</td>
                                <td>
                                    <p class="role">Supervisor</p>
                                </td>
                                <td><button class="more-btn" type="button">⋮</button></td>
                            </tr>
                        </tbody>


                    </table>
                </div>

                <div id="output"></div>
            </div>
        </div>

        <?php $base->renderFooter() ?>
    </div>

    <!-- JavaScript -->
    <script src="./src/scripts/table_search.js"></script>
    <script src="./src/scripts/checkbox.js"></script>

    <script>
        document.querySelectorAll('.role').forEach(cell => {
            const text = cell.textContent.trim(); // Get the text content of the cell
            if (text === 'Student') {
                cell.classList.add('student'); // Add 'published' class
            } else if (text === 'Moderator') {
                cell.classList.add('moderator'); // Add 'unpublished' class
            } else if (text === 'Supervisor') {
                cell.classList.add('supervisor'); // Add 'unpublished' class
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
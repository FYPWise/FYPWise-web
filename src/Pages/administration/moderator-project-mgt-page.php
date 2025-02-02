<?php
use App\Models\Base;
use App\Models\User;

$base = new Base("Manage User", "admin");

if(isset($_GET['view'])){
    $userID = $_GET['view'];
    $user = new User($userID);
}

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


                <div class="table-name">
                    <table id="tablename-table">
                        <thead>
                            <th>Project ID</th>
                            <th>Moderator Assigned</th>
                            <th>Status</th>
                            <th>
                                </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td><a href="#">P001</a></td>
                                <td>M012454</td>
                                <td>
                                    <p class="assign-status">Assigned</p>
                                </td>
                                <td><button class="more-btn" type="button">⋮</button></td>
                            </tr>
                            <tr>
                                <td><a href="#">P002</a></td>
                                <td></td>
                                <td>
                                    <p class="assign-status">Unassigned</p>
                                </td>
                                <td><button class="more-btn" type="button">⋮</button></td>
                            </tr>
                        </tbody>


                    </table>
                </div>

                <div id="output"></div>
            </div>
        </div>

        <!-- footer Section -->
        <footer>
            <h3><a href="https://www.mmu.edu.my/">Multimedia University, Persiaran Multimedia, 63100 Cyberjaya,
                    Selangor,
                    Malaysia</a></h3>
            <div id="side">
                <a class="link" href="http://www.mmu.edu.my/">MMU Website</a>
                <a class="link" href="https://online.mmu.edu.my/">MMU Portal</a>
                <a class="link" href="https://clic.mmu.edu.my/">CLiC</a>
                <a class="link" href="https://servicedesk.mmu.edu.my/psp/crmprd/?cmd=login&languageCd=ENG&">Service
                    Desk</a>
            </div>
            FYP Wise &copy; <em id="date"></em>Syabel Imran Aida Firzan
        </footer>
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
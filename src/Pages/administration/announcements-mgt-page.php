<?php
use App\Models\Base;
use App\Models\Announcement;

$base = new Base("Manage User", "admin");

$ann = new Announcement();

$announcements = $ann->find();

echo $announcements[0];
?>

<head>
    <link rel="stylesheet" href="./src/css/announcements-mgt-style.css">
</head>


<body>
    <div id="outer-container">
        <?php $base->renderHeader() ?>

        <!-- Main Content -->
        <div id="main-container">

            <!-- Side Menu -->
            <?php $base->renderMenu() ?>

            <!-- Proposal Table Section -->
            <div class="content">
                <div class="table-header-container">
                    <h2>Announcements</h2>

                    <div>
                        <input type="text" id="search-bar-id" placeholder="UserID...">
                        <button class="create-new-btn" type="button"
                            onclick="location.href='new-user';"></button>
                    </div>
                </div>


                <div class="table-name">
                    <table id="tablename-table">
                        <thead>
                            <th><input title="select all" type="checkbox" id="select-all"></th>
                            <th>Announcement Title</th>
                            <th>Date</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>
                                </tr>
                        </thead>

                        <tbody>
                            <?php
                            
                                foreach ($announcements as $id) {
                                    $ann->read($id);
                                    $ann->renderTable();
                                }
                            
                            ?>
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
    <script src="../scripts/checkbox.js"></script>
    <script src="../scripts/side-menu.js"></script>

    <script>
        document.querySelectorAll('.status').forEach(cell => {
            const text = cell.textContent.trim(); // Get the text content of the cell
            if (text === 'Active') {
                cell.classList.add('published'); // Add 'published' class
            } else if (text === 'Archived') {
                cell.classList.add('unpublished'); // Add 'unpublished' class
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
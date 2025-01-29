<?php
use App\Models\Base;
use App\Models\SideMenu;

$base = new Base("Page Skeleton");
$SideMenu = new SideMenu("student")
?>
<head>
    <link rel="stylesheet" href="./src/css/proposal-management-style.css">
</head>


<body>
    <div id="outer-container">
        <!-- Header Section -->
        <header>
            <div class="menubutton"><input title="side-menu" type="checkbox" id="user-side-menu"><label
                    for="user-side-menu" class="fas"></label></div>
            <div id="logo"></div>
            <button id="home"><a href="./src/user-management-mgt/user-dashboard-page.html"><img src="./src/assets/home.png" alt="home icon"></a></button>
        </header>
        <!-- Main Content -->
        <div class="container">

            <!-- Side Menu -->
            <?php $SideMenu->render(); ?>
            <!-- Proposal Table Section -->
            <div class="content">
                <div class="header-container">
                    <h2>Proposals</h2>

                    <div class="table-buttons">
                        <button id="edit-btn"><a href='proposal-status-management-page-p1.html'><img src="./src/assets/edit.png" alt="edit"></a></button>
                        <button id="filter-btn"><a href='#'><img src="./src/assets/filter.png" alt="filter"></a></button>
                    </div>
                </div>

                <hr />

                <div class="proposals">
                    <table id="proposal-table">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="select-all"></th>
                                <th>Proposal ID</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Submission Date</th>
                                <th>Supervisor ID</th>
                                <th>Status</th>
                                <th>Updated At</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Table with sample data -->
                            <tr>
                                <td><input type="checkbox" class="row-checkbox" value="P002"></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div id="output"></div>
                
            </div>
        </div>
        <footer>
            <h3><a href="https://www.mmu.edu.my/">Multimedia University, Persiaran Multimedia, 63100 Cyberjaya, Selangor,
                    Malaysia</a></h3>
            <div id="side">
                <a class="link" href="http://www.mmu.edu.my/">MMU Website</a>
                <a class="link" href="https://online.mmu.edu.my/">MMU Portal</a>
                <a class="link" href="https://clic.mmu.edu.my/">CLiC</a>
                <a class="link" href="https://servicedesk.mmu.edu.my/psp/crmprd/?cmd=login&languageCd=ENG&">Service Desk</a>
            </div>
            FYP Wise &copy; <em id="date"></em>Syabell Imran Aida Firzan
        </footer>
    </div>

    <!-- JavaScript -->
    <script src="./src/scripts/table_search.js"></script>
    <script src="./src/scripts/checkbox.js"></script>

    <!-- Initialize search functionality -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            initSearch("search-bar", "proposal-table");
        });
    </script>
</body>
</html>
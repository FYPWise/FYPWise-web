<?php
use App\Models\Base;
use App\Models\Announcement;

$base = new Base("Manage Announcement", "admin");

$ann = new Announcement();

$announcements = $ann->find();
?>

<head>
    <link rel="stylesheet" href="./src/css/form-style.css">
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
                            onclick="location.href='new-announcement';"></button>
                    </div>
                </div>


                <div class="table-name">
                    <?php
                            if (isset($_GET["view"])) {
                                $id = $_GET["view"];
                                $ann->read($id);
                                $ann->formView();
                            }else{ ?>
                    <table id="tablename-table">

                        

                        <thead>
                            <th><input title="select all" type="checkbox" id="select-all"></th>
                            <th>Announcement Title</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>
                                </tr>
                        </thead>

                        <tbody>
                            <?php

                                if($announcements){
                                foreach ($announcements as $id) {
                                    $ann->read($id);
                                    $ann->renderTable();
                                }}
                            }
                                
                            
                            ?>
                        </tbody>


                    </table>
                </div>

                <div id="output"></div>
            </div>
        </div>

        <!-- footer Section -->
        <?php $base->renderFooter(); ?>
    </div>

    <!-- JavaScript -->
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
</body>

</html>
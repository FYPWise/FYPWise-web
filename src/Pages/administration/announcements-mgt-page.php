<?php
use App\Models\Base;
use App\Models\Announcement;

$base = new Base("Manage Announcement", "admin");

$ann = new Announcement();

$announcements = $ann->find();

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $status = $_GET['status'];
    $title = $_GET['title'];
    $description = $_GET['description'];

    if ($ann->update($id, $title, $description, $status)) {
        echo'
        <script> alert("Announcement Successfully Updated") </script>
        ';
        header('location:/FYPWise-web/manage-announcements?view='.$id);
    }
}
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


                <div id="table-name">
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

        var editbtn = document.getElementById("edit-btn");
        var savebtn = document.getElementById("save-btn");
        var cancelbtn = document.getElementById("cancel-btn");
        var textAreas = document.getElementsByTagName("textarea");
        var titleInput = document.getElementById("announcement-title");
        var statusSelect = document.getElementById("status");

        function edit(){
            enable(savebtn);
            enable(cancelbtn);
            disable(editbtn);

            for (i = 0; i< textAreas.length; i++){
                enable(textAreas[i]);
            }
            
            enable(statusSelect);
            enable(titleInput);
        }

        function cancel(){
            location.reload();
        }

        function enable(btn){
            btn.removeAttribute("disabled");
        }

        function disable(btn){
            btn.setAttribute("disabled", "true");
        }

        editbtn.onclick = function(e){
            e.preventDefault();
            edit();
        }

        cancelbtn.onclick = function(e){
            e.preventDefault();
            cancel();
        }

    </script>
</body>

</html>
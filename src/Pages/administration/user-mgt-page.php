<?php
use App\Models\Base;
use App\Models\SideMenu;

$base = new Base("Page Skeleton", "admin");
$SideMenu = new SideMenu();
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
                        <input type="text" id="search-bar-id" placeholder="UserID...">
                        <button id="filter-btn"><img src="./src/assets/filter.png" alt="filter"></button>
                        <button class="create-new-btn" type="button"
                            onclick="location.href='/FYPWise-Web/new-user';"><img
                                src="./src/assets/create-new-icon.png" alt="filter"></button>
                    </div>
                </div>


                <div id="table-name">
                        <h1 id="textHint" onclick="focusOnSearchBar()">Search Account by User ID</h1>
                </div>

                <div id="output"></div>
            </div>
        </div>

        <?php $base->renderFooter() ?>
    </div>

    <!-- JavaScript -->
    <script>
        function roleColour(){
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
        }

        roleColour();

        function userList(userID){
            if (userID !== ""){
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function(){
                    if (this.readyState == 4 && this.status == 200){
                        document.getElementById("table-name").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET", "userlist?userid="+userID, true);
                xmlhttp.send();
            }
        }

        function viewUser(userID){
            if (userID !== ""){
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function(){
                    if (this.readyState == 4 && this.status == 200){
                        document.getElementById("table-name").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET", "viewUser?userid="+userID, true);
                xmlhttp.send();
            }
        }

        var searchBar =document.getElementById("search-bar-id");

        searchBar.addEventListener("keypress", function(event){
            if (event.key == "Enter"){
                userList(searchBar.value);
            }
        });

        function focusOnSearchBar(){
            searchBar.focus();
        }
    </script>
</body>

</html>
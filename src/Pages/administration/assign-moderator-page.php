<?php
use App\Models\Base;
use App\Models\Project;
use App\Models\Db;

$base = new Base("Manage Announcement", "admin");
$project = new project(new Db());

if(isset($_GET['id'])){
    $projectId = $_GET['id'];
}else{
    $projectId = '';
}

if ($_SERVER['REQUEST_METHOD'] == "POST"){
    $id = $_POST['moderator-id'];
    $projectID = $_POST['project-id'];

    if ($project->assignModerator($id, $projectID)){
        header('location:moderator-management');
    }else{
        echo'
            <script> alert("Invalid Moderator ID"); </script>
        ';
    }
}

?>

<head>
    <link rel="stylesheet" href="src/css/form-style.css">
    <link rel="stylesheet" href="src/css/announcements-mgt-style.css">
    <link rel="stylesheet" href="src/css/moderator-mgt-style.css">
</head>

<body>
    <div id="outer-container">
        <?php $base->renderHeader() ?>

        <!-- Main Content -->
        <div id="main-container">

            <!-- Side Menu -->
            <?php $base->renderMenu() ?>

            <div class="content">
                <section class="main">
                    <h1 id="page-name">Assign Moderator</h1>

                    <form class="form" id="" method="POST">
                        <!-- auto-generated Proposal ID -->
                        <div class="form-group ">
                            <label for="project-id">Project ID</label>
                            <input type="text" id="project-id" name="project-id" value="<?php echo $projectId?>" required readonly>
                        </div>

                        <div class="form-group ">
                            <label for="moderator-id">Moderator ID</label>
                            <input type="text" id="moderator-id" name="moderator-id" required>
                        </div>

                        <!-- submit and reset buttons -->
                        <div class="form-buttons">
                            <button type="submit" class="btn submit-btn">Submit</button>
                            <button type="reset" class="btn reset-btn">Reset</button>
                        </div>
                    </form>
                </section>
            </div>


        </div>

        <?php $base->renderFooter() ?>
    </div>


</body>

</html>
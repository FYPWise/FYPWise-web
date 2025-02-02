<?php
use App\Models\Base;
use App\Models\Announcement;

$base = new Base("Manage Announcement", "admin");

$ann = new Announcement();

if (isset($_GET["title"])) {
    $ann->create($_GET['title'], $_GET['description']);
    echo '
        <script> alert("Announcement Created") </script>
    ';
    unset($_GET['title']);
    unset($_GET['description']);
    header('location:manage-announcements');
}


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

            <div class="content">
                <section class="main">
                    <h1 id="page-name">Create New Announcement</h1>

                    <form class="form" id="proposalForm">
                        <!-- auto-generated Proposal ID -->
                        <div class="form-group ">
                            <label for="announcement-title">Announcement Title*</label>
                            <input type="text" id="announcement-title" name="title" required>
                        </div>

                        <div class="form-group">
                            <label for="announcement-description">Description*</label>
                            <textarea id="announcement-description" name="description" rows="6"
                                required></textarea>
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

        <!-- footer Section -->
        <?php $base->renderFooter(); ?>
    </div>
</body>

</html>
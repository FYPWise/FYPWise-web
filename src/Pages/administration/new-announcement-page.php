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

            <div class="content">
                <section class="main">
                    <h1 id="page-name">Create New Announcement</h1>

                    <form class="form" id="proposalForm">
                        <!-- auto-generated Proposal ID -->
                        <div class="form-group ">
                            <label for="announcement-title">Announcement Title*</label>
                            <input type="text" id="announcement-title" name="announcement-title" required>
                        </div>

                        <div class="form-group">
                            <label for="announcement-date">Proposal Date*</label>
                            <input type="date" id="announcement-date" name="announcement-date"
                                onfocus="this.showPicker()" onchange="this.blur()" required>
                        </div>

                        <div class="form-group">
                            <label for="announcement-description">Description*</label>
                            <textarea id="announcement-description" name="announcement-description" rows="6"
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
            FYP Wise &copy; <em id="date"></em>Syabell Imran Aida Firzan
        </footer>

        <script src="../scripts/side-menu.js"></script>
    </div>
</body>

</html>
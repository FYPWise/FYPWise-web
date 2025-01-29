<?php
use App\Models\Base;
use App\Models\SideMenu;
use App\Models\Proposal;
use App\Models\Db;

$base = new Base("Proposals");
$sideMenu = new SideMenu();
$db = new Db();
$proposal = new Proposal($db);


echo "Proposal ID: " . $proposalID;
$proposalDetails = null;

if ($proposalID) {
    try {
        $proposalDetails = $proposal->getProposalByID($proposalID);
    } catch (Exception $e) {
        echo "<p>Error: " . $e->getMessage() . "</p>";
    }
}

?>
<head>
    <link rel="stylesheet" href="./src/css/proposal-management-style.css">
    <link rel="stylesheet" href="./src/css/form-style.css">
</head>
<body>
    <div id="outer-container">
        <?php $base->renderHeader() ?>

        <!-- Main Content -->
        <div id="main-container">

            <!-- Side Menu -->
            <?php $sideMenu->render(); ?>

            <div class="content">
                <h2 class="form-title">Proposal Submission</h2>
                <hr />
                <?php if ($proposalDetails): ?>
                    <form class="proposal-form" id="proposalForm">
                        <!-- Proposal ID -->
                        <div class="form-group">
                            <label for="proposal-id">Proposal ID</label>
                            <p id="proposal-id" class="proposal-id"><?php echo htmlspecialchars($proposalDetails['proposalID']); ?></p>
                        </div>

                        <!-- Proposal Title -->
                        <div class="form-group">
                            <label for="proposal-title">Proposal Title</label>
                            <p id="proposal-title" name="proposal-title"><?php echo htmlspecialchars($proposalDetails['proposal_title']); ?></p>
                        </div>

                        <!-- Description -->
                        <div class="form-group">
                            <label for="description">Description</label>
                            <p id="description" name="description"><?php echo nl2br(htmlspecialchars($proposalDetails['proposal_description'])); ?></p>
                        </div>

                        <!-- Submission Date -->
                        <div class="form-group">
                            <label for="submission-date">Submission Date</label>
                            <p id="submission-date" name="submission-date"><?php echo htmlspecialchars($proposalDetails['submission_date']); ?></p>
                        </div>

                        <!-- Specialisation -->
                        <div class="form-group">
                            <label for="specialisation">Specialisation</label>
                            <p id="specialisation" name="specialisation"><?php echo htmlspecialchars($proposalDetails['specialisation']); ?></p>
                        </div>

                        <!-- Category -->
                        <div class="form-group">
                            <label for="category">Category</label>
                            <p id="category" name="category"><?php echo htmlspecialchars($proposalDetails['category']); ?></p>
                        </div>

                        <!-- Supervisor Name -->
                        <div class="form-group">
                            <label for="supervisor-name">Supervisor Name</label>
                            <p id="supervisor-name" name="supervisor-name"><?php echo htmlspecialchars($proposalDetails['supervisor_name']); ?></p>
                        </div>

                        <!-- Status -->
                        <div class="form-group">
                            <label for="status">Status</label>
                            <p id="status" name="status"><?php echo htmlspecialchars($proposalDetails['status']); ?></p>
                        </div>

                        <!-- Comment -->
                        <div class="form-group">
                            <label for="comment">Comment</label>
                            <textarea id="comment" name="comment" rows="6" disabled><?php echo htmlspecialchars($proposalDetails['comment']); ?></textarea>
                        </div>
                    </form>
                <?php else: ?>
                    <p>No proposal found with the provided ID.</p>
                <?php endif; ?>
            </div>
        </div>

        <?php $base->renderFooter() ?>
    </div>
</body>

</html>

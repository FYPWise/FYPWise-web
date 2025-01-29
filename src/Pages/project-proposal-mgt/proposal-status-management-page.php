<?php
use App\Models\Base;
use App\Models\Proposal;
use App\Models\Db;

$base = new Base("Proposal Details");
$db = new Db();
$proposal = new Proposal($db);

// Check if proposalID is passed in the URL
if (isset($_GET['proposalID'])) {
    $proposalID = $_GET['proposalID'];
    
    try {
        // Retrieve proposal data by proposalID
        $proposalData = $proposal->getProposalByID($proposalID);
        
        // Check if proposal exists
        if (!$proposalData) {
            throw new Exception("Proposal not found.");
        }
    } catch (Exception $e) {
        $errorMessage = $e->getMessage();
    }
} else {
    $errorMessage = "Proposal ID is missing.";
}
?>

<head>
    <link rel="stylesheet" href="./src/css/proposal-management-style.css">
    <link rel="stylesheet" href="./src/css/form-style.css">
    <link rel="stylesheet" href="./src/css/common-ui.css">
</head>
<body>
    <div id="outer-container">
        <?php $base->renderHeader(); ?>

        <!-- Main Content -->
        <div id="main-container">

            <!-- Side Menu -->
            <?php $sideMenu->render(); ?>

            <div class="content">
                <h2 class="form-title">Proposal Details</h2>
                <hr />

                <?php if (isset($errorMessage)): ?>
                    <p class="error"><?php echo $errorMessage; ?></p>
                <?php else: ?>
                    <form class="proposal-form" id="proposalForm">
                        <div class="form-group">
                            <label for="proposal-id">Proposal ID</label>
                            <p id="proposal-id"><?php echo $proposalData['proposalID']; ?></p>
                        </div>

                        <div class="form-group">
                            <label for="proposal-title">Proposal Title</label>
                            <p id="proposal-title"><?php echo htmlentities($proposalData['proposal_title']); ?></p>
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <p id="description"><?php echo htmlentities($proposalData['proposal_description']); ?></p>
                        </div>

                        <div class="form-group">
                            <label for="submission-date">Submission Date</label>
                            <p id="submission-date"><?php echo $proposalData['submission_date']; ?></p>
                        </div>

                        <div class="form-group">
                            <label for="specialisation">Specialisation</label>
                            <p id="specialisation"><?php echo htmlentities($proposalData['specialisation']); ?></p>
                        </div>

                        <div class="form-group">
                            <label>Category</label>
                            <div class="radio-group">
                                <input type="radio" id="research-based" name="category" value="research" <?php echo ($proposalData['category'] == 'research') ? 'checked' : ''; ?> disabled>
                                <label for="research-based">Research-based</label>

                                <input type="radio" id="application-based" name="category" value="application" <?php echo ($proposalData['category'] == 'application') ? 'checked' : ''; ?> disabled>
                                <label for="application-based">Application-based</label>

                                <input type="radio" id="both" name="category" value="research-application" <?php echo ($proposalData['category'] == 'research-application') ? 'checked' : ''; ?> disabled>
                                <label for="both">Research & Application-based</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="supervisor-id">Supervisor ID</label>
                            <p id="supervisor-id"><?php echo $proposalData['supervisorID']; ?></p>
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>
                            <p id="status"><?php echo htmlentities($proposalData['status']); ?></p>
                        </div>

                        <div class="form-group">
                            <label for="comment">Comment</label>
                            <textarea id="comment" rows="6" disabled><?php echo htmlentities($proposalData['comment']); ?></textarea>
                        </div>

                        <div class="form-group">
                            <label for="admin-id">Admin ID</label>
                            <p id="admin-id"><?php echo $proposalData['adminID']; ?></p>
                        </div>
                    </form>
                <?php endif; ?>
            </div>
        </div>

        <?php $base->renderFooter(); ?>
    </div>
</body>
</html>

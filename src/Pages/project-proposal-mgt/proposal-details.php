<?php
use App\Models\Base;
use App\Models\SideMenu;
use App\Models\Proposal;
use App\Models\Db;

$base = new Base("Proposal Details");
$sideMenu = new SideMenu();
$db = new Db();
$proposal = new Proposal($db);

// Simulating user roles for testing
$isAdmin = true;
// $isAdmin = false;

// echo "Proposal ID: {$proposalID}";
$proposalDetails = null;

if ($proposalID) {
    try {
        $proposalDetails = $proposal->getProposalByID($proposalID) ?? null;
    } catch (Exception $e) {
        echo "<p>Error: " . $e->getMessage() . "</p>";
    }
}

// Handle form submission (only if admin)
if ($isAdmin && $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $newStatus = $_POST['status'];
    $newComment = $_POST['comment'];

    try {
        $proposal->updateProposalStatus($proposalID, $newStatus, $newComment);
        echo "<script>alert('Proposal status updated successfully!'); window.location.reload();</script>";
    } catch (Exception $e) {
        echo "<script>alert('Error updating proposal: " . $e->getMessage() . "');</script>";
    }
}
?>

<head>
    <link rel="stylesheet" href="/FYPWise-web/src/css/proposal-management-style.css">
    <link rel="stylesheet" href="/FYPWise-web/src/css/form-style.css">
</head>
<body>
    <div id="outer-container">
        <?php $base->renderHeader() ?>

        <!-- Main Content -->
        <div id="main-container">

            <!-- Side Menu -->
            <?php $sideMenu->render(); ?>

            <div class="content">
                <h2 class="form-title">Proposal Details</h2>
                <hr />
                
                <?php if ($proposalDetails): ?>
                    <form method="POST" action="/FYPWise-web/proposal/<?php echo $proposalDetails['proposalID']; ?>">
                        <!-- Hidden input for proposalID -->
                        <input type="hidden" name="proposalID" value="<?php echo htmlspecialchars($proposalDetails['proposalID']); ?>">
                        <div class="form-group">
                            <label for="proposal-id">Proposal ID</label>
                            <p><?php echo htmlspecialchars($proposalDetails['proposalID']); ?></p>
                        </div>

                        <div class="form-group">
                            <label for="proposal-title">Proposal Title</label>
                            <p><?php echo htmlspecialchars($proposalDetails['proposal_title']); ?></p>
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <p><?php echo nl2br(htmlspecialchars($proposalDetails['proposal_description'])); ?></p>
                        </div>

                        <div class="form-group">
                            <label for="submission-date">Submission Date</label>
                            <p><?php echo htmlspecialchars($proposalDetails['submission_date']); ?></p>
                        </div>

                        <div class="form-group">
                            <label for="specialisation">Specialisation</label>
                            <p><?php echo htmlspecialchars($proposalDetails['specialisation']); ?></p>
                        </div>

                        <div class="form-group">
                            <label for="category">Category</label>
                            <p><?php echo htmlspecialchars($proposalDetails['category']); ?></p>
                        </div>

                        <div class="form-group">
                            <label for="supervisor-name">Supervisor Name</label>
                            <p><?php echo htmlspecialchars($proposalDetails['supervisor_name']); ?></p>
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>
                            <?php if ($isAdmin && $proposalDetails['status'] !== 'accepted'): ?>
                                <select name="status" required>
                                    <option value="pending" <?php echo ($proposalDetails['status'] === 'pending') ? 'selected' : ''; ?>>Pending</option>
                                    <option value="accepted" <?php echo ($proposalDetails['status'] === 'accepted') ? 'selected' : ''; ?>>Accepted</option>
                                    <option value="rejected" <?php echo ($proposalDetails['status'] === 'rejected') ? 'selected' : ''; ?>>Rejected</option>
                                </select>
                            <?php else: ?>
                                <p><?php echo htmlspecialchars($proposalDetails['status']); ?></p>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="comment">Comment</label>
                            <?php if ($isAdmin && $proposalDetails['status'] !== 'accepted'): ?>
                                <textarea name="comment" rows="4"><?php echo htmlspecialchars($proposalDetails['comment']); ?></textarea>
                            <?php else: ?>
                                <p><?php echo nl2br(htmlspecialchars($proposalDetails['comment'])); ?></p>
                            <?php endif; ?>
                        </div>

                        <?php if ($isAdmin && $proposalDetails['status'] !== 'accepted'): ?>
                            <button type="submit" name="update" class="btn submit-btn">Save Changes</button>
                        <?php endif; ?>
                    </form>
                <?php else: ?>
                    <p>No proposal found with the provided ID.</p>
                <?php endif; ?>
            </div>
        </div>

        <?php $base->renderFooter(); ?>
    </div>
</body>
</html>

<?php
use App\Models\Base;
use App\Models\Db;
use App\Models\Project;

$base = new Base("Project Plan Approval");
$db = new Db();
$projectModel = new Project($db);

// Fetch project timelines from database
$projectTimelines = $projectModel->getAllProjectTimelines();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $timelineID = $_POST['timelineID'] ?? null;
    $newStatus = $_POST['status'] ?? null;

    if ($timelineID && $newStatus) {
        $projectModel->updateProjectTimelineStatus($timelineID, $newStatus);
        header("Location: /FYPWise-web/projectplanapproval?success=1"); 
        exit();
    }
}
?>

<body>
    <div id="outer-container">
        <?php $base->renderHeader() ?>

        <!-- Main Content -->
        <div id="main-container">
            <div class="content">
                <h2 class="form-title">Approve Project Plan</h2>
                <hr>

                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Timeline ID</th>
                                <th>Advisee</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($projectTimelines)): ?>
                                <?php foreach ($projectTimelines as $row): ?>
                                    <tr>
                                        <td>
                                            <a href="/FYPWise-web/supervisorprojecttimeline?timelineID=<?php echo htmlspecialchars($row['timelineID']); ?>">
                                                <?php echo htmlspecialchars($row['timelineID']); ?>
                                            </a>
                                        </td>
                                        <td><?php echo htmlspecialchars($row['student_name'] ?? 'Unassigned'); ?></td>
                                        <td>
                                            <form method="POST">
                                                <input type="hidden" name="timelineID" value="<?php echo $row['timelineID']; ?>">
                                                <select name="status" class="status-dropdown">
                                                    <option value="pending" <?php echo ($row['status'] == 'pending') ? 'selected' : ''; ?>>Pending</option>
                                                    <option value="on-going" <?php echo ($row['status'] == 'on-going') ? 'selected' : ''; ?>>On-going</option>
                                                    <option value="approved" <?php echo ($row['status'] == 'approved') ? 'selected' : ''; ?>>Approved</option>
                                                </select>
                                                <button type="submit">Update</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4">No project plans found</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <?php $base->renderFooter() ?>
    </div>
</body>
</html>

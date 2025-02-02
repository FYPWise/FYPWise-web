<?php
use App\Models\Base;
use App\Models\Db;
use App\Models\Project;

$base = new Base("Project Plan Approval", ['lecturer']);
$db = new Db();
$projectModel = new Project($db);

// Fetch project timelines from database
$projectTimelines = $projectModel->getAllProjectTimelines();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $timelineID = $_POST['timelineID'] ?? null;
    $newStatus = $_POST['status'] ?? null;

    if ($timelineID && $newStatus) {
        $success = $projectModel->updateProjectTimelineStatus($timelineID, $newStatus);
        if ($success) {
            echo "✅ Status updated successfully!";
        } else {
            echo "❌ Error updating status!";
        }
        exit(); // Stop further execution
    }
}
?>

<body>
    <div id="outer-container">
        <?php $base->renderHeader() ?>

        <?php $base->renderMenu(); ?>
        
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
                                            <a
                                                href="/FYPWise-web/supervisorprojecttimeline?timelineID=<?php echo htmlspecialchars($row['timelineID']); ?>">
                                                <?php echo htmlspecialchars($row['timelineID']); ?>
                                            </a>
                                        </td>
                                        <td><?php echo htmlspecialchars($row['student_name'] ?? 'Unassigned'); ?></td>
                                        <td>
                                        <form class="status-form">
                                                <input type="hidden" name="timelineID"
                                                    value="<?php echo $row['timelineID']; ?>">
                                                <select name="status" class="status-dropdown">
                                                    <option value="pending" <?php echo ($row['status'] == 'pending') ? 'selected' : ''; ?>>Pending</option>
                                                    <option value="in-progress" <?php echo ($row['status'] == 'in-progress') ? 'selected' : ''; ?>>In Progress</option>
                                                    <option value="completed" <?php echo ($row['status'] == 'completed') ? 'selected' : ''; ?>>Completed</option>
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
<script>
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".status-form").forEach(form => {
        form.addEventListener("submit", function (e) {
            e.preventDefault(); // Prevent page reload
            
            let formData = new FormData(this);

            fetch("/FYPWise-web/projectplanapproval", {
                method: "POST",
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                console.log("Response:", data);
                alert("✅ Status updated successfully!"); // Show success message
            })
            .catch(error => {
                console.error("Error:", error);
                alert("❌ Error updating status. Please try again.");
            });
        });
    });
});
</script>

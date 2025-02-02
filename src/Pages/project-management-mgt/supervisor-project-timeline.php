<?php
use App\Models\Base;
use App\Models\Db;
use App\Models\Project;

$base = new Base("Supervisor Project Timeline", ['lecturer']);
$db = new Db();
$projectModel = new Project($db);

// Fetch uploaded Gantt and Flow Chart files
$timelineFiles = $projectModel->getTimelineFiles();
$ganttChart = null;
$flowChart = null;

foreach ($timelineFiles as $file) {
    if ($file['file_category'] === 'gantt_chart') {
        $ganttChart = $file['file_path'];
    } elseif ($file['file_category'] === 'flow_chart') {
        $flowChart = $file['file_path'];
    }
}

// Fetch all milestones from the database
$milestones = $projectModel->getAllMilestones();
$milestoneList = [];

foreach ($milestones as $milestone) {
    $milestoneList[] = [
        'id' => $milestone['milestoneID'],
        'title' => $milestone['milestone_title']
    ];
}

// Default milestone values (if no milestones exist)
$currentMilestoneIndex = 0;
$firstMilestone = $milestoneList[$currentMilestoneIndex] ?? ['id' => null, 'title' => "No Milestones Available"];
?>

<body>
    <div id="outer-container">
        <?php $base->renderHeader(); ?>

        <?php $base->renderMenu(); ?>

        <div class="content">
            <div id="main-container" style="display: flex; justify-content: center; align-items: center; flex-direction: column; padding: 20px; background-color: #f5f5f5;">
                <div class="content" style="width: 80%; max-width: 900px; background: #ffffff; padding: 20px; border-radius: 10px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);">
                    
                    <!-- Main Section -->
                    <div class="main-content" style="text-align: center; margin-bottom: 20px;">
                        <h2 style="color: #333;">Project Planning Outline</h2>
                    </div>
                    
                    <!-- Gantt Chart Section -->
                    <div class="chart-box" style="margin-bottom: 20px; padding: 15px; border-radius: 8px; background: #f8f9fa;">
                        <div class="chart-title" style="font-size: 18px; font-weight: bold; margin-bottom: 10px;">Gantt Chart</div>
                        <div class="chart-content" style="margin-bottom: 10px; text-align: center;">
                            <?php if ($ganttChart): ?>
                                <iframe src="./uploads/Gantt Chart/<?= htmlspecialchars($ganttChart) ?>" width="100%" height="500px" style="border: 1px solid #ddd;"></iframe>
                                <br><a href="<?= htmlspecialchars($ganttChart) ?>" target="_blank" class="chart-link" style="color: #007bff; text-decoration: none;">📄 Open in New Tab</a>
                            <?php else: ?>
                                <p style="color: red;">No Gantt Chart uploaded</p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Flow Chart Section -->
                    <div class="chart-box" style="margin-bottom: 20px; padding: 15px; border-radius: 8px; background: #f8f9fa;">
                        <div class="chart-title" style="font-size: 18px; font-weight: bold; margin-bottom: 10px;">Flow Chart</div>
                        <div class="chart-content" style="margin-bottom: 10px; text-align: center;">
                            <?php if ($flowChart): ?>
                                <iframe src="<?= htmlspecialchars($flowChart) ?>" width="100%" height="500px" style="border: 1px solid #ddd;"></iframe>
                                <br><a href="<?= htmlspecialchars($flowChart) ?>" target="_blank" class="chart-link" style="color: #007bff; text-decoration: none;">📄 Open in New Tab</a>
                            <?php else: ?>
                                <p style="color: red;">No Flow Chart uploaded</p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Milestone Navigation -->
                    <div class="chart-box" style="padding: 15px; border-radius: 8px; background: #f8f9fa; text-align: center;">
                        <div class="chart-title" style="font-size: 18px; font-weight: bold; margin-bottom: 10px;">Milestones</div>
                        <div class="milestone-navigation" style="display: flex; justify-content: center; gap: 10px; align-items: center;">
                            <button class="nav-arrow" style="background: #007bff; color: white; border: none; padding: 6px 10px; border-radius: 5px; cursor: pointer; font-size: 14px;" onclick="navigateMilestone(-1)">&#8592;</button>
                            <a href="/FYPWise-web/milestonesubmission?milestoneID=<?= htmlspecialchars($firstMilestone['id']) ?>" id="milestone-link" class="milestone-link" style="color: #007bff; text-decoration: none; font-weight: bold;">
                                <?= htmlspecialchars($firstMilestone['title']) ?>
                            </a>
                            <button class="nav-arrow" style="background: #007bff; color: white; border: none; padding: 6px 10px; border-radius: 5px; cursor: pointer; font-size: 14px;" onclick="navigateMilestone(1)">&#8594;</button>
                        </div>
                    </div>

                    <!-- Back Button (Smaller) -->
                    <div style="margin-top: 15px; text-align: center;">
                        <a href="/FYPWise-web/projectplanapproval" class="back-btn" style="display: inline-block; background: #dc3545; color: white; padding: 10px 16px; font-size: 14px; font-weight: bold; border-radius: 6px; text-decoration: none;">⬅ Back</a>
                    </div>

                </div>
            </div>
        </div>

        <?php $base->renderFooter(); ?>
    </div>

    <script>
        let milestones = <?= json_encode($milestoneList) ?>;
        let currentMilestoneIndex = 0;
        const milestoneLink = document.getElementById("milestone-link");

        function navigateMilestone(direction) {
            if (milestones.length === 0) return;

            currentMilestoneIndex += direction;
            if (currentMilestoneIndex < 0) {
                currentMilestoneIndex = 0;
            } else if (currentMilestoneIndex >= milestones.length) {
                currentMilestoneIndex = milestones.length - 1;
            }

            milestoneLink.innerText = milestones[currentMilestoneIndex].title;
            milestoneLink.href = `/FYPWise-web/milestonesubmission?milestoneID=${milestones[currentMilestoneIndex].id}`;
        }
    </script>
</body>


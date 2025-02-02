<?php
use App\Models\Base;

$base = new Base("Page Skeleton");
?>

<body>
    <div id="outer-container">
        <?php $base->renderHeader(); ?>

        <div class="content">
            <!-- Main Content -->
            <div id="main-container" style="display: flex; justify-content: center; align-items: center; flex-direction: column; padding: 20px; background-color: #f5f5f5;">
                <div class="content" style="width: 80%; max-width: 900px; background: #ffffff; padding: 20px; border-radius: 10px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);">
                    <!-- Main Section -->
                    <div class="main-content" style="text-align: center; margin-bottom: 20px;">
                        <h2 style="color: #333;">Project Planning Outline</h2>
                    </div>
                    
                    <!-- Gantt Chart Section -->
                    <div class="chart-box" style="margin-bottom: 20px; padding: 15px; border-radius: 8px; background: #f8f9fa;">
                        <div class="chart-title" style="font-size: 18px; font-weight: bold; margin-bottom: 10px;">Gantt Chart</div>
                        <div class="chart-content" style="margin-bottom: 10px;">
                            <a href="https://dummy-excel-link.com" target="_blank" class="chart-link" style="color: #007bff; text-decoration: none;">Open Gantt Chart</a>
                        </div>
                        <div class="button-group" style="display: flex; gap: 10px; justify-content: center;">
                            <button class="btn" style="padding: 8px 12px; background: #28a745; color: white; border: none; border-radius: 5px; cursor: pointer;" onclick="approveChart('Gantt Chart')">Approve</button>
                            <button class="btn" style="padding: 8px 12px; background: #ffc107; color: black; border: none; border-radius: 5px; cursor: pointer;" onclick="toggleCommentBox('gantt-comment')">Comment</button>
                        </div>
                        <div id="gantt-comment" class="comment-box" style="margin-top: 10px; display: none;">
                            <textarea placeholder="Add your comment here..." style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #ccc;"></textarea>
                            <button class="btn save-btn" style="margin-top: 10px; padding: 8px 12px; background: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer;" onclick="saveComment()">Save</button>
                        </div>
                    </div>

                    <!-- Flow Chart Section -->
                    <div class="chart-box" style="margin-bottom: 20px; padding: 15px; border-radius: 8px; background: #f8f9fa;">
                        <div class="chart-title" style="font-size: 18px; font-weight: bold; margin-bottom: 10px;">Flow Chart</div>
                        <div class="chart-content" style="margin-bottom: 10px;">
                            <a href="https://dummy-diagram-link.com" target="_blank" class="chart-link" style="color: #007bff; text-decoration: none;">Open Flow Chart</a>
                        </div>
                        <div class="button-group" style="display: flex; gap: 10px; justify-content: center;">
                            <button class="btn" style="padding: 8px 12px; background: #28a745; color: white; border: none; border-radius: 5px; cursor: pointer;" onclick="approveChart('Flow Chart')">Approve</button>
                            <button class="btn" style="padding: 8px 12px; background: #ffc107; color: black; border: none; border-radius: 5px; cursor: pointer;" onclick="toggleCommentBox('flow-comment')">Comment</button>
                        </div>
                        <div id="flow-comment" class="comment-box" style="margin-top: 10px; display: none;">
                            <textarea placeholder="Add your comment here..." style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #ccc;"></textarea>
                            <button class="btn save-btn" style="margin-top: 10px; padding: 8px 12px; background: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer;" onclick="saveComment()">Save</button>
                        </div>
                    </div>

                    <!-- Milestone Section -->
                    <div class="chart-box" style="padding: 15px; border-radius: 8px; background: #f8f9fa; text-align: center;">
                        <div class="chart-title" style="font-size: 18px; font-weight: bold; margin-bottom: 10px;">Milestone</div>
                        <div class="milestone-navigation" style="display: flex; justify-content: center; gap: 10px; align-items: center;">
                            <button class="nav-arrow" style="background: #007bff; color: white; border: none; padding: 8px 12px; border-radius: 5px; cursor: pointer;" onclick="navigateMilestone(-1)">&#8592;</button>
                            <a href="../project-management-mgt/milestone-submission.html" id="milestone-link" class="milestone-link" style="color: #007bff; text-decoration: none; font-weight: bold;">M1</a>
                            <button class="nav-arrow" style="background: #007bff; color: white; border: none; padding: 8px 12px; border-radius: 5px; cursor: pointer;" onclick="navigateMilestone(1)">&#8594;</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php $base->renderFooter(); ?>
    </div>

    <script>
        let milestones = ["M1", "M2", "M3", "M4", "M5"];
        let currentMilestoneIndex = 0;
        const milestoneLink = document.getElementById("milestone-link");
        
        function navigateMilestone(direction) {
            currentMilestoneIndex += direction;
            if (currentMilestoneIndex < 0) {
                currentMilestoneIndex = 0;
            } else if (currentMilestoneIndex >= milestones.length) {
                currentMilestoneIndex = milestones.length - 1;
            }
            milestoneLink.innerText = milestones[currentMilestoneIndex];
            milestoneLink.href = `../project-management-mgt/milestone-submission.html?milestone=${milestones[currentMilestoneIndex]}`;
        }
    </script>
</body>

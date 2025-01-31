<?php
use App\Models\Base;

$base = new Base("student project assignment");
?>

<body>
    <div id="outer-container">
        <?php $base->renderHeader(); ?>

        <!-- Main Content -->
        <div class="container" style="display: flex; justify-content: center; align-items: center; flex-direction: column; padding: 20px; background-color: #f5f5f5; min-height: 100vh;">
            <div class="content" style="width: 80%; max-width: 900px; background: #ffffff; padding: 25px; border-radius: 12px; box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);">
                <h2 class="form-title" style="text-align: center; font-size: 26px; color: #333; margin-bottom: 20px;">Assign Advisee</h2>

                <!-- Form Section -->
                <div class="form assign-form">
                    <p><strong>PROPOSAL ID:</strong> P1</p>
                    <p><strong>PROJECT ID:</strong> P1</p>

                    <!-- Editable Proposal Title -->
                    <div class="form-group" style="display: flex; align-items: center; gap: 10px;">
                        <label style="font-weight: bold;">Proposal Title:</label>
                        <span id="title-text">Sentiment Analysis Software for Businesses</span>
                        <input type="text" id="title-input" class="editable hidden" style="flex: 1; padding: 8px; border-radius: 5px; border: 1px solid #ccc; display: none;">
                        <button class="edit-btn" onclick="toggleEdit('title')" style="background: transparent; border: none; cursor: pointer;">
                            <img src="/fypwise-web/src/assets/edit.png" alt="Edit" width="20" height="20">
                        </button>
                    </div>

                    <!-- Editable Description -->
                    <div class="form-group" style="margin-top: 15px;">
                        <label style="font-weight: bold;">Description:</label>
                        <div id="description-text" style="padding: 10px; background: #f9f9f9; border-radius: 5px;">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis sagittis nisl diam
                            inceptos elementum scelerisque eros. Nullam eu dolor adipiscing pellentesque pellentesque vitae diam dui.
                        </div>
                        <textarea id="description-input" class="editable hidden" rows="4" style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ccc; margin-top: 10px; display: none;"></textarea>
                        <button class="edit-btn" onclick="toggleEdit('description')" style="background: transparent; border: none; cursor: pointer;">
                            <img src="/fypwise-web/src/assets/edit.png" alt="Edit" width="20" height="20">
                        </button>
                    </div>

                    <!-- Start and End Dates -->
                    <div class="form-group" style="margin-top: 15px; display: flex; justify-content: space-between;">
                        <div>
                            <label for="start-date">Start Date:</label>
                            <input type="date" id="start-date" name="start-date" value="2024-10-31" style="padding: 8px; border-radius: 5px; border: 1px solid #ccc;">
                        </div>
                        <div>
                            <label for="end-date">End Date:</label>
                            <input type="date" id="end-date" name="end-date" value="2025-05-31" style="padding: 8px; border-radius: 5px; border: 1px solid #ccc;">
                        </div>
                    </div>

                    <!-- Category Radio Buttons -->
                    <div class="form-group" style="margin-top: 15px;">
                        <label style="font-weight: bold;">Category:</label>
                        <div style="display: flex; gap: 10px;">
                            <label><input type="radio" name="category" value="research"> Research-based</label>
                            <label><input type="radio" name="category" value="application"> Application-based</label>
                            <label><input type="radio" name="category" value="both"> Research & Application-based</label>
                        </div>
                    </div>

                    <!-- Supervisor & Student ID -->
                    <div class="form-group" style="margin-top: 15px;">
                        <label for="supervisor">Supervisor ID:</label>
                        <input type="text" id="supervisor" name="supervisor" placeholder="Enter Supervisor ID" readonly style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #ccc;">
                    </div>

                    <div class="form-group" style="margin-top: 15px;">
                        <label for="student">Student ID:</label>
                        <input type="text" id="student" name="student" placeholder="Enter Student ID" style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #ccc;">
                    </div>

                    <!-- Buttons -->
                    <div class="form-buttons" style="margin-top: 20px; text-align: center;">
                        <button class="btn save-btn" onclick="submitForm()" style="background: #007bff; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; font-size: 16px;">Save</button>
                        <button class="btn cancel-btn" style="background: #dc3545; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; margin-left: 10px;">Cancel</button>
                    </div>
                </div>
            </div>
        </div>

        <?php $base->renderFooter(); ?>
    </div>

    <script>
        function toggleEdit(field) {
            let text = document.getElementById(field + '-text');
            let input = document.getElementById(field + '-input');
            text.style.display = text.style.display === 'none' ? 'block' : 'none';
            input.style.display = input.style.display === 'none' ? 'block' : 'none';
        }
    </script>
</body>
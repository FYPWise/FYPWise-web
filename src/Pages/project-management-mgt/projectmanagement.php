<?php
use App\Models\Base;
//use App\Models\SideMenu;

$base = new Base("Page Skeleton");
//$SideMenu = new SideMenu();
?>

<body>
    <div id="outer-container">
        <?php $base->renderHeader() ?>

        <!-- Main Content -->
        <div id="main-container">

           

            <div class="content">
                <section class="main">
                    <h1 id="page-name">Project Management</h1>
                </section>

                <table class="project-table">
                    <thead>
                        <tr>
                            <th>Project Title</th>
                            <th>Advisee</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><a href="#">PocketFlow: Track Your Expenses with Fortune Cookie</a></td>
                            <td>Aisyah Nabila</td>
                            <td>Submitted</td>
                        </tr>
                        <tr>
                            <td><a href="#">Smart Food: AI-Powered Personalized Meal Recommendations</a></td>
                            <td>Imran Yunus</td>
                            <td>Approved</td>
                        </tr>
                        <tr>
                            <td><a href="#">Web-Based Catalog Application with Real-Time Chatbot Assistance</a></td>
                            <td>Firzan Zurain</td>
                            <td>Approved</td>
                        </tr>
                        <tr>
                            <td><a href="#">IoT-Based Smart Home Security System</a></td>
                            <td>Saleha</td>
                            <td>Submitted</td>
                        </tr>
                        <tr>
                            <td><a href="#">Blockchain for Secure Voting Systems</a></td>
                            <td>Embun</td>
                            <td>Approved</td>
                        </tr>
                        <tr>
                            <td><a href="#">AI-Driven Health Monitoring Wearable</a></td>
                            <td> Bulan</td>
                            <td>Pending</td>
                        </tr>
                        <tr>
                            <td><a href="#">E-Learning Platform with Gamification</a></td>
                            <td>Thomas Shelby</td>
                            <td>Submitted</td>
                        </tr>
                        <tr>
                            <td><a href="#">Machine Learning-Based Fraud Detection</a></td>
                            <td>Hehu</td>
                            <td>Approved</td>
                        </tr>
                        <tr>
                            <td><a href="#">Real-Time Language Translator App</a></td>
                            <td>Aminah</td>
                            <td>Approved</td>
                        </tr>
                        <tr>
                            <td><a href="#">Personalized Workout Planner</a></td>
                            <td>Roabeah</td>
                            <td>Submitted</td>
                        </tr>
                        <tr>
                            <td><a href="#">AR-Powered Navigation for Tourists</a></td>
                            <td>Shahirah</td>
                            <td>Pending</td>
                        </tr>
                        <tr>
                            <td><a href="#">Interactive Children's Storybook App</a></td>
                            <td>Emma Watson</td>
                            <td>Submitted</td>
                        </tr>
                        <tr>
                            <td><a href="#">AI-Powered Virtual Assistant for Offices</a></td>
                            <td>Adam</td>
                            <td>Approved</td>
                        </tr>
                        <tr>
                            <td><a href="#">Voice-Activated Smart Mirror</a></td>
                            <td>Ali</td>
                            <td>Pending</td>
                        </tr>
                        <tr>
                            <td><a href="#">Automated Stock Market Analysis Tool</a></td>
                            <td><a href="../project-management-mgt/student-project-assignment-page.html"
                                    class="assign-btn">Assign Advisee</a></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><a href="#">Virtual Reality Training for Engineers</a></td>
                            <td><a href="../project-management-mgt/student-project-assignment-page.html"
                                    class="assign-btn">Assign Advisee</a></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><a href="#">Eco-Friendly Renewable Energy Dashboard</a></td>
                            <td><a href="../project-management-mgt/student-project-assignment-page.html"
                                    class="assign-btn">Assign Advisee</a></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><a href="#">Intelligent AI-Driven Pronunciation Corrector</a></td>
                            <td><a href="../project-management-mgt/student-project-assignment-page.html"
                                    class="assign-btn">Assign Advisee</a></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><a href="#">Development of a Real-Time Surf Wave Measurement Application for Surf
                                    Forecasting for Surfers</a></td>
                            <td><a href="../project-management-mgt/student-project-assignment-page.html"
                                    class="assign-btn">Assign Advisee</a></td>
                            <td></td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>


        </div>

        <?php $base->renderFooter() ?>
    </div>
</body>

</html>
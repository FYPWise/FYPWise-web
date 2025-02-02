<?php
use App\Models\Base;
//use App\Models\SideMenu;

$base = new Base("Project Plan Approval");
//$SideMenu = new SideMenu();
?>

<body>
    <div id="outer-container">
        <?php $base->renderHeader() ?>

        <!-- Main Content -->
        <div id="main-container">

           

             <!-- Main Content -->
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
                            <tr>
                                <td><a href="../project-management-mgt/supervisor-project-timeline.html">T1</a></td>
                                <td>Luigi Mario</td>
                                <td>
                                    <select class="status-dropdown" onchange="updateStatus(this)">
                                        <option value="On-going" selected>On-going</option>
                                        <option value="Approved">Approved</option>
                                        <option value="Pending">Pending</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><a href="../project-management-mgt/supervisor-project-timeline.html">T2</a></td>
                                <td>Gracie Abrams</td>
                                <td>
                                    <select class="status-dropdown" onchange="updateStatus(this)">
                                        <option value="On-going">On-going</option>
                                        <option value="Approved" selected>Approved</option>
                                        <option value="Pending">Pending</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><a href="../project-management-mgt/supervisor-project-timeline.html">T3</a></td>
                                <td>Lee Zii Jia</td>
                                <td>
                                    <select class="status-dropdown" onchange="updateStatus(this)">
                                        <option value="On-going">On-going</option>
                                        <option value="Approved">Approved</option>
                                        <option value="Pending" selected>Pending</option>
                                    </select>
                                </td>
                            </tr>
                            <tr><td><a href="../project-management-mgt/supervisor-project-timeline.html">T4</a></td><td>Maria Sharapova</td><td><select class="status-dropdown" onchange="updateStatus(this)"><option value="On-going" selected>On-going</option><option value="Approved">Approved</option><option value="Pending">Pending</option></select></td></tr>
                            <tr><td><a href="../project-management-mgt/supervisor-project-timeline.html">T5</a></td><td>Roger Federer</td><td><select class="status-dropdown" onchange="updateStatus(this)"><option value="On-going">On-going</option><option value="Approved" selected>Approved</option><option value="Pending">Pending</option></select></td></tr>
                            <tr><td><a href="../project-management-mgt/supervisor-project-timeline.html">T6</a></td><td>Venus Williams</td><td><select class="status-dropdown" onchange="updateStatus(this)"><option value="On-going">On-going</option><option value="Approved">Approved</option><option value="Pending" selected>Pending</option></select></td></tr>
                            <tr><td><a href="../project-management-mgt/supervisor-project-timeline.html">T7</a></td><td>Serena Williams</td><td><select class="status-dropdown" onchange="updateStatus(this)"><option value="On-going" selected>On-going</option><option value="Approved">Approved</option><option value="Pending">Pending</option></select></td></tr>
                            <tr><td><a href="../project-management-mgt/supervisor-project-timeline.html">T8</a></td><td>Andy Murray</td><td><select class="status-dropdown" onchange="updateStatus(this)"><option value="On-going">On-going</option><option value="Approved" selected>Approved</option><option value="Pending">Pending</option></select></td></tr>
                            <tr><td><a href="../project-management-mgt/supervisor-project-timeline.html">T9</a></td><td>Novak Djokovic</td><td><select class="status-dropdown" onchange="updateStatus(this)"><option value="On-going">On-going</option><option value="Approved">Approved</option><option value="Pending" selected>Pending</option></select></td></tr>
                            <tr><td><a href="../project-management-mgt/supervisor-project-timeline.html">T10</a></td><td>Rafael Nadal</td><td><select class="status-dropdown" onchange="updateStatus(this)"><option value="On-going" selected>On-going</option><option value="Approved">Approved</option><option value="Pending">Pending</option></select></td></tr>
                            <tr><td><a href="../project-management-mgt/supervisor-project-timeline.html">T11</a></td><td>Coco Gauff</td><td><select class="status-dropdown" onchange="updateStatus(this)"><option value="On-going">On-going</option><option value="Approved" selected>Approved</option><option value="Pending">Pending</option></select></td></tr>
                            <tr><td><a href="../project-management-mgt/supervisor-project-timeline.html">T12</a></td><td>Naomi Osaka</td><td><select class="status-dropdown" onchange="updateStatus(this)"><option value="On-going">On-going</option><option value="Approved">Approved</option><option value="Pending" selected>Pending</option></select></td></tr>
                            <tr><td><a href="../project-management-mgt/supervisor-project-timeline.html">T13</a></td><td>Simona Halep</td><td><select class="status-dropdown" onchange="updateStatus(this)"><option value="On-going">On-going</option><option value="Approved">Approved</option><option value="Pending" selected>Pending</option></select></td></tr>
                            <tr><td><a href="../project-management-mgt/supervisor-project-timeline.html">T14</a></td><td>Stan Wawrinka</td><td><select class="status-dropdown" onchange="updateStatus(this)"><option value="On-going">On-going</option><option value="Approved">Approved</option><option value="Pending" selected>Pending</option></select></td></tr>
                            <tr><td><a href="../project-management-mgt/supervisor-project-timeline.html">T15</a></td><td>Victoria Azarenka</td><td><select class="status-dropdown" onchange="updateStatus(this)"><option value="On-going" selected>On-going</option><option value="Approved">Approved</option><option value="Pending">Pending</option></select></td></tr>
                        </tbody>
                    </table>
                </div>
            </div>


        </div>

        <?php $base->renderFooter() ?>
    </div>
</body>

</html>
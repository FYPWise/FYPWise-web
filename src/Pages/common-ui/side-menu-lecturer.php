
            <!-- Side Menu -->
            <nav id="side-menu">
                <div class="search-container">
                    <input type="text" id="search-bar" placeholder="Search">
                </div>
                <ul id="side-menu-shortcuts">

                    <!-- Dropdown List -->
                    <li class="side-menu-dropdown-list">
                        <button class="menu-button dropdown-button">
                            <span class="menu-label">Account</span>
                            <span class="expand-icon"></span>
                        </button>

                        <!-- Inner Dropdown List -->
                        <ul class="inner-dropdown">
                            <li class="inner-dropdown-list"><a class="menu-button"
                                    href="/FYPWise-web/dashboard">Dashboard</a>
                            </li>

                            <li class="inner-dropdown-list"><a class="menu-button"
                                    href="/FYPWise-web/about-us">About Us</a>
                            </li>
                        </ul>
                    </li>

                    <li class="side-menu-dropdown-list">
                        <button class="menu-button dropdown-button"><span class="menu-label">Proposal</span>
                            <span class="expand-icon"></span>
                        </button>
                    
                        <ul class="inner-dropdown">
                    
                            <li class="inner-dropdown-list"><a class="menu-button" href="/FYPWise-web/proposal">View All</a>
                            </li>
                    
                            <li class="inner-dropdown-list"><a class="menu-button" href="/FYPWise-web/submit-proposal">Create New</a>
                            </li>
                        </ul>
                    </li>

                    <li class="side-menu-dropdown-list">
                        <button class="menu-button dropdown-button"><span class="menu-label">Project</span>
                            <span class="expand-icon"></span>
                        </button>
                    
                        <ul class="inner-dropdown">
                    
                            <li class="inner-dropdown-list"><a class="menu-button" href="/FYPWise-web/createproject">Create New</a>
                            </li>
                    
                            <li class="inner-dropdown-list"><a class="menu-button" href="/FYPWise-web/projectmanagement">View All</a>
                            </li>
                    
                            <li class="inner-dropdown-list"><a class="menu-button" href="/FYPWise-web/projectplanapproval">Plan Approval</a>
                            </li>
                    
                            <li class="inner-dropdown-list"><a class="menu-button" href="/FYPWise-web/marksheetpage">Marksheet</a>
                            </li>
                        </ul>
                    </li>

                    <li class="side-menu-dropdown-list">
                        <button class="menu-button dropdown-button">
                            <span class="menu-label">Meeting</span>
                            <span class="expand-icon"></span>
                        </button>

                        <!-- Inner Dropdown List -->
                        <ul class="inner-dropdown">
                            <li class="inner-dropdown-list"><a class="menu-button"
                                    href="/FYPWise-web/view-meetings">View All</a>
                            </li>

                            <li class="inner-dropdown-list"><a class="menu-button"
                                    href="/FYPWise-web/new-meeting">Create New</a>
                            </li>

                            <li class="inner-dropdown-list"><a class="menu-button"
                                    href="/FYPWise-web/view-meeting-logs">View Logs</a>
                            </li>
                        </ul>
                    </li>

                    <li class="side-menu-dropdown-list">
                        <button onclick="location.href='/FYPWise-web/view-presentations'" class="menu-button"><span
                                class="menu-label">Presentation</span>
                    </li>

                    <li class="side-menu-dropdown-list">
                        <button onclick="location.href='/FYPWise-web/communication'" class="menu-button"><span
                                class="menu-label">Chat</span>
                    </li>

                    <li class="side-menu-dropdown-list">
                        <button onclick="showLogoutPopup()" class="menu-button"><span
                                class="menu-label">Logout</span>
                    </li>
                </ul>
            </nav>

<script src="/FYPWise-web/src/scripts/side-menu.js"></script>

<?php include './src/Pages/common-ui/logoutConfirm.html'; ?>
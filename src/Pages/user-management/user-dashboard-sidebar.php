<div class="sidebar">
        <div class="menubutton"><input title="side-menu" type="checkbox" id="user-side-menu">
            <label for="user-side-menu" class="fas sidebar-btn"></label></div>
        <div class="icons">
            <a href="communication"><button id="sidebar-btn"><img src="./src/assets/messages1.png"
                        alt="messages"></button></a>
            <a href="profilemanagement"><button id="sidebar-btn"><img src="./src/assets/profile.png" alt="logout"></button></a>
        </div>
        
        <button id="logout-btn" onclick="showLogoutPopup()"><img src="./src/assets/logout2.png" alt="logout"></button>
    </div>
    <!-- Logout Confirmation Popup -->
    <?php include './src/Pages/common-ui/logoutConfirm.html'; ?>
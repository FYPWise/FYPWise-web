<?php

namespace App\Models;
use App\Models\Head;
use App\Models\Authentication;
use App\Models\SideMenu;

class Base{
    private $pageTitle;
    private $head;
    private $auth;
    private $sideMenu;
    private $roles = [];

    public function __construct($pageTitle, $roles = null) {
        $this->pageTitle = $pageTitle;
        $this->head = new Head($pageTitle);
        $this->auth = new Authentication();
        if (isset($_SESSION["role"])) $this->sideMenu = new SideMenu($_SESSION["role"]);

        if ($roles) {
            is_array($roles) ? $this->roles = $roles : $this->roles = [$roles];
            $this->authenticateUser();
        }
    }

    public function getTitle(){
        return $this->pageTitle;
    }

    public function renderHeader(){
        echo'<!-- Header Section -->
        <header>
            <div class="menubutton"><input title="side-menu" type="checkbox" id="user-side-menu"><label
                    for="user-side-menu" class="fas"></label></div>
            <div id="logo" onClick="location.href=\'/FYPWise-web\'" ></div>
            <button id="home"><a href="/FYPWise-web/dashboard"><img src="./src/assets/home3.png"
                        alt="home icon" style="width:25px;"></a></button>
        </header>';
    }

    public function renderFooter(){
        echo '<footer>
            <h3><a href="https://www.mmu.edu.my/">Multimedia University, Persiaran Multimedia, 63100 Cyberjaya,
                    Selangor,
                    Malaysia</a></h3>
            <div id="side">
                <a class="link" href="http://www.mmu.edu.my/">MMU Website</a>
                <a class="link" href="https://online.mmu.edu.my/">MMU Portal</a>
                <a class="link" href="https://clic.mmu.edu.my/">CLiC</a>
                <a class="link" href="https://servicedesk.mmu.edu.my/psp/crmprd/?cmd=login&languageCd=ENG&">Service
                    Desk</a>
            </div>
            FYP Wise &copy; <em id="date"></em>Syabell Imran Aida Firzan
        </footer>';
    }

    public function renderMenu(){
        $this->sideMenu->render();
    }

    public function authenticateUser(){
        if (!isset($_SESSION['mySession'])) { // if not logged in
            header('Location: login');
            exit();
        }

        if ($this->roles){
            if(!in_array($_SESSION['role'], $this->roles)){
                include(ROOT_DIR . "/src/Pages/common-ui/403.php");
                exit();
            }
        }
    }
}
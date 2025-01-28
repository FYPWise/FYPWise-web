<?php

namespace App\Models;
use App\Models\Head;

class Base{
    private $pageTitle;
    private $head;

    public function __construct($pageTitle) {
        $this->pageTitle = $pageTitle;
        $this->head = new Head($pageTitle);
    }

    public function getTitle(){
        return $this->pageTitle;
    }

    public function renderHeader(){
        echo'<!-- Header Section -->
        <header>
            <div class="menubutton"><input title="side-menu" type="checkbox" id="user-side-menu"><label
                    for="user-side-menu" class="fas"></label></div>
            <div id="logo"></div>
            <button id="home"><a href="/testb"><img src="./src/assets/home.png"
                        alt="home icon"></a></button>
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
}
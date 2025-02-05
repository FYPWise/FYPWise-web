<?php

namespace App\Models;

class SideMenu{

    private $sideMenu;

    public function __construct($role) {
        if ($role == "student"){
            $this->sideMenu = "/../Pages/common-ui/side-menu-student.php";
        }else if ($role == "admin"){
            $this->sideMenu = "/../Pages/common-ui/side-menu-admin.php";
        }else if ($role == "lecturer"){
            $this->sideMenu = "/../Pages/common-ui/side-menu-lecturer.php";
        }

    }

    public function render(){
        include __DIR__ . $this->sideMenu;
    }
}
?>
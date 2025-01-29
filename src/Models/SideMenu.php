<?php

namespace App\Models;

class SideMenu{

    private $sideMenu;

    public function __construct() {
        $role = $_SESSION["role"];
        if ($role == "student"){
            $this->sideMenu = "/../Pages/common-ui/side-menu-student.html";
        }else if ($role == "admin"){
            $this->sideMenu = "/../Pages/common-ui/side-menu-admin.html";
        }else if ($role == "supervisor"){
            $this->sideMenu = "/../Pages/common-ui/side-menu-supervisor.html";
        }

    }

    public function render(){
        include __DIR__ . $this->sideMenu;
    }
}
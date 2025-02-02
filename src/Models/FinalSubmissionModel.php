<?php
namespace App\Models;

use App\Models\Db;
use PDO;
use PDOException;

class FinalSubmissionModel {
    private $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }
    
}

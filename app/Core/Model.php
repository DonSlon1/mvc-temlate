<?php
namespace App\Core;

use Doctrine\DBAL\Connection;

class Model {
    protected $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }
}

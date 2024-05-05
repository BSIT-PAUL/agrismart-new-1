<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;

class Base extends Model
{
    protected $db;

    public function __construct(ConnectionInterface $db = null){
        $this->db = $db;
        parent::__construct($db);
    }
}
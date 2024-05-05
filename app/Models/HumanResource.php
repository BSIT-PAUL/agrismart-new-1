<?php

namespace App\Models;


class HumanResource extends Base
{

    public function getVendors(){
        $sql = $this->db->table('sales_agent sa')
                        ->select("*")
                        ->orderBy('sa.ID', 'DESC')
                        ->get();

        return $sql->getResultArray();
    }

    public function getWorkers(){
        $sql = $this->db->table('worker w')
                        ->select("*")
                        ->orderBy('w.ID', 'DESC')
                        ->get();

        return $sql->getResultArray();
    }
}
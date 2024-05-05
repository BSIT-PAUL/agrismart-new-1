<?php

namespace App\Models;


class Tracking extends Base
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

    public function getSales(){
        $sql = $this->db->table('sales s')
                        ->select("s.*")
                        ->join('crops c', 'c.`Crop_ID` = s.`Crop_ID`', 'left')
                        ->where('c.User_ID', get_user()->user_login_ID)
                        ->groupBy('MarketID')
                        ->orderBy('s.MarketID', 'DESC')
                        ->get();

        return $sql->getResultArray();
    }

    public function modifySales($cropID, $amount){
        $data = array(
            'Crop_ID' => $cropID,
            'Amount' => $amount
        );

        $update = array(
            'Harvest_Date' => date('Y-m-d H:i:s')
        );
        

        $query = $this->db->table('market')
                          ->insert($data);

        $this->db->table('crop')
                    ->where('ID', $cropID)
                    ->update($update);

        if ($query) {
            return $this->db->affectedRows();
        } else {
            return false;
        }
    }

    public function removeSales($ID){
        $qry = $this->db->query("DELETE
                                FROM `market`
                                WHERE ID = ?",
                                [$ID]);

        return $this->db->affectedRows();
    }
}
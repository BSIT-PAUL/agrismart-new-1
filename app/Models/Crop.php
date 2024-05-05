<?php

namespace App\Models;

class Crop extends Base
{
    public function selectData($table, $join, $relationship, $where = array(), $group){
        $sql;
        if(empty($join)){
            $sql = $this->db->table($table)
                        ->select("*")
                        ->where($where)
                        ->groupby($group)
                        ->get();
        }else{
            $sql = $this->db->table($table)
                        ->select("*")
                        ->join($join,$relationship, 'left')
                        ->where($where)
                        ->get();
        }
        
        return $sql->getResultArray();
    }

    //Crops
    public function getCrops($where = array()){
        $sql = $this->db->table('crops c')
                        ->select("*")
                        ->where('c.User_ID', get_user()->user_login_ID)
                        ->where($where)
                        ->groupBy('c.Crop_ID')
                        ->orderBy('c.Crop_ID', 'DESC')
                        ->get();

        return $sql->getResultArray();
    }
    
    public function getCrop($where = array()){

        $sql = $this->db->table('crops c')
                        ->select("*")
                        ->where($where)
                        // ->where('harvestDate IS NULL')
                        ->get();

        return $sql->getResultArray();
    }

    public function getCropTotals($where = array()){

        $sql = $this->db->table('sales s')
                        ->select("SUM(Amount) AS totSales,
                        CONCAT('₱',FORMAT(SUM(Amount),2)) AS formatted_totSales")
                        ->where($where)
                        ->groupBy('s.Crop_ID')
                        ->get();

        return $sql->getResultArray();
    }


    public function getArea($where = array()){

        // $where['harvestDate IS NULL'] = null;

        $sql = $this->db->table('crops c')
                        ->select("*")
                        ->where($where)
                        ->where('harvestDate IS NULL')
                        // ->groupBy('Area_ID')
                        ->get();

        return $sql->getResultArray();
    }

    public function getPrice($where = array()){
        $sql = $this->db->table('seeds s')
                        ->select("*")
                        ->where($where)
                        ->get();
                        
        return $sql->getResultArray();
    }

    public function modifyCrop($price, $seed, $type, $areaID, $seedVol){

        $query = $this->db->query("CALL crop_insert('$price', '$seed', '$type', '$areaID', '$seedVol')");

        if ($query) {
            return $this->db->affectedRows();
        } else {
            return false;
        }
    }

    public function removeCrop($ID) {
        $qry = $this->db->query("DELETE
                                FROM crop
                                WHERE ID = ?",
                                [$ID]);

        return $this->db->affectedRows();
    }

    //Seeds
    public function getSeeds($ID, $where = array()){
        $sql;

        if(empty($ID)){
            $sql = $this->db->table('seeds s')
                        ->select("*")
                        ->orderBy('s.Seed_ID', 'DESC')
                        ->get();
        }else{
            $sql = $this->db->table('seeds s')
                        ->select("*")
                        ->orderBy('s.Seed_ID', 'DESC')
                        ->where($where)
                        ->get();
        }

        return $sql->getResultArray();
    }

    public function removeSeed($ID) {
        $qry = $this->db->query("DELETE
                                FROM seed
                                WHERE ID = ?",
                                [$ID]);

        return $this->db->affectedRows();
    }

    //Supplement
    public function getSupps($where = array()){
        $sql = $this->db->table('supplements s')
                        ->select("*")
                        ->where($where)
                        ->orderBy('s.ID', 'DESC')
                        ->get();

        return $sql->getResultArray();
    }
    
    public function modifySupp($type, $areaID, $qty, $supp, $price){
        $userID = get_user()->user_login_ID;
        $query = $this->db->query("CALL supplement_insert('$userID', '$type', '$areaID', '$qty', '$supp', '$price')");
        if ($query) {
            return $this->db->affectedRows();
        } else {
            return false;
        }
    }
    
    public function removeSupp($ID){
        $qry = $this->db->query("DELETE
                                FROM supplement
                                WHERE ID = ?",
                                [$ID]);

        return $this->db->affectedRows();
    }
    //Watering
    public function getwaterSchedules($where = array()){
        $sql = $this->db->table('waterSchedules ws')
                        ->select("ws.*,
                                a.address,
                                a.Field,
                                a.Area")
                        ->where($where)
                        ->join('`areas` a', 'a.fieldID = ws.`Field_ID`', 'left')
                        ->groupby('ws.ID')
                        ->orderBy('ws.ID', 'DESC')
                        ->get();

        return $sql->getResultArray();
    }

    public function modifyWatering($cropID, $cost){
        $data = array(
            'Crop_ID' => $cropID,
            'Cost' => $cost
        );

        $query = $this->db->table('water_sched')
                          ->insert($data);

        if ($query) {
            return $this->db->affectedRows();
        } else {
            return false;
        }
    }

    public function removeWatering($ID){
        $qry = $this->db->query("DELETE
                                FROM `water_sched`
                                WHERE ID = ?",
                                [$ID]);

        return $this->db->affectedRows();
    }
}
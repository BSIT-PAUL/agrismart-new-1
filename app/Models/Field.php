<?php

namespace App\Models;

class Field extends Base
{
    public function getFields($userID){
        $sql = $this->db->table('fields')
                    ->select("*")
                    ->where('User_ID', $userID)
                    ->get();
        return $sql->getResultArray();
    }
    
    public function getField($where = array()){
        $qry = $this->db->table('fields')
                        ->select("*")
                        ->where($where)
                        ->get();
        return $qry->getResultArray();
    }

    public function modifyField($userID, $brgyID){
        $query = $this->db->query("CALL addField('$userID', '$brgyID')");
        if ($query) {
            return $this->db->affectedRows();
        } else {
            return false;
        }
    }

    public function removeField($ID) {
        $qry = $this->db->query("DELETE
                                FROM field
                                WHERE ID = ?",
                                [$ID]);

        return $this->db->affectedRows();
    }

    public function getAreas($where = array(), $order = null){

        $sql;

        if(empty($order)){
            $sql = $this->db->table('areas a')
                            ->select('*')
                            ->where($where)
                            ->groupBy('Area_ID')
                            ->get();
        }else{
            $sql = $this->db->table('areas a')
                    ->where($where)
                    ->orderBy($order, 'DESC')
                    ->get();
        }
        
        return $sql->getResultArray();
    }

    public function getAreaName($fieldID){
        
        $sql = $this->db->table('area a')
                        ->select("a.Area as AreaName")
                        ->where('a.Field_ID',$fieldID)
                        ->orderBy( "Area", 'Desc')
                        ->limit(1)
                        ->get();

        return $sql->getResultArray();
    }

    public function getAreaByField($ID){
        $sql = $this->db->table('areas a')
                    ->where('fieldID',$ID)
                    ->get();

        return $sql->getResultArray();
    }

    public function modifyArea($ID, $fieldID, $lotArea){

        $query = $this->db->query("CALL addArea('$ID', '$fieldID', '$lotArea')");
        if ($query) {
            return $this->db->affectedRows();
        } else {
            return false;
        }

    }

    public function removeArea($ID) {
        $qry = $this->db->query("DELETE
                                FROM area
                                WHERE ID = ?",
                                [$ID]);

        return $this->db->affectedRows();
    }

    public function getExpenses($where = array()) {
        $sql = $this->db->table('expenses e')
                        ->select("*")
                        ->where($where)
                        ->orderBy( "e.dateCreated", 'DESC')
                        ->get();

        return $sql->getResultArray();
    }

}
<?php

namespace App\Models;

class Setup extends Base
{
    // fertilizer
    public function getFertilizers($ID, $where = array()){
        $sql;

        if(empty($ID)) {
            $sql = $this->db->table('fertilizers f')
                        ->select("*")
                        ->where('User_ID', get_user()->user_login_ID)
                        ->orderBy('Fertilizer_ID', 'DESC')
                        ->get();
        } else {
            $sql = $this->db->table('fertilizers f')
                        ->select("*")
                        ->where($where)
                        ->get();
        }

        return $sql->getResultArray();
    }

    public function modifyFertilizer($userID, $fert, $desc, $pric, $fer_ID, $photo) {
        $query;

        if($fer_ID == 'null') {
            $query = $this->db->query("CALL fertilizer_insert(?, ?, ?, ?, ?, ?)", array($userID, $fert, $desc, $pric, null, $photo));
        } else {
            $query = $this->db->query("CALL fertilizer_insert(?, ?, ?, ?, ?, ?)", array($userID, $fert, $desc, $pric, $fer_ID, $photo));
        }

        if ($query) {
            return $this->db->affectedRows();
        } else {
            return false;
        }
    }

    public function removeFertilizer($ID, $userID) {
        $qry = $this->db->table('fertilizer')
                        ->where('ID', $ID)
                        ->delete();

        $qry = $this->db->table('main_user')
                        ->where('Fertilizer_ID', $ID)
                        ->where('User_ID', $userID)
                        ->delete();

        return $this->db->affectedRows();
    }

    // insecticide
    public function getInsecticides($ID, $where = array()){
        $sql;

        if(empty($ID)) {
            $sql = $this->db->table('insecticides i')
                        ->select("*")
                        ->where('User_ID', get_user()->user_login_ID)
                        ->orderBy('Insecticide_ID', 'DESC')
                        ->get();
        } else {
            $sql = $this->db->table('insecticides i')
                        ->select("*")
                        ->where($where)
                        ->get();
        }

        return $sql->getResultArray();
    }

    public function modifyInsecticide($userID, $inse, $desc, $pric, $ins_ID, $photo) {
        $query;

        if($ins_ID == 'null') {
            $query = $this->db->query("CALL insecticide_insert(?, ?, ?, ?, ?, ?)", array($userID, $inse, $desc, $pric, null, $photo));
        } else {
            $query = $this->db->query("CALL insecticide_insert(?, ?, ?, ?, ?, ?)", array($userID, $inse, $desc, $pric, $ins_ID, $photo));
        }

        if ($query) {
            return $this->db->affectedRows();
        } else {
            return false;
        }
    }

    public function removeInsecticide($ID, $userID) {
        $qry = $this->db->table('insecticide')
                        ->where('ID', $ID)
                        ->delete();

        $qry = $this->db->table('main_user')
                        ->where('Insecticide_ID', $ID)
                        ->where('User_ID', $userID)
                        ->delete();

        return $this->db->affectedRows();
    }

    // seed
    public function getSeeds($ID, $where = array()){
        $sql;

        if(empty($ID)) {
            $sql = $this->db->table('seeds s')
                        ->select("*")
                        ->where('User_ID', get_user()->user_login_ID)
                        ->orderBy('Seed_ID', 'DESC')
                        ->get();
        } else {
            $sql = $this->db->table('seeds s')
                        ->select("*")
                        ->where($where)
                        ->get();
        }

        return $sql->getResultArray();
    }

    public function modifySeed($userID, $type, $variety, $price, $descp) {
        $query = $this->db->query("CALL seed_insert(?, ?, ?, ?, ?)", array($userID, $descp, $price, $type, $variety));

        if ($query) {
            return $this->db->affectedRows();
        } else {
            return false;
        }
    }

    public function removeSeed($ID, $userID) {
        $qry = $this->db->table('seed')
                        ->where('ID', $ID)
                        ->delete();

        $qry = $this->db->table('main_user')
                        ->where('Seed_ID', $ID)
                        ->where('User_ID', $userID)
                        ->delete();

        return $this->db->affectedRows();
    }
}
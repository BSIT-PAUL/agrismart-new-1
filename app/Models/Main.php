<?php

namespace App\Models;

class Main extends Base
{
    public function selectData($table, $join, $relationship, $where = array()){
        $sql;
        if($join == null){
            $sql = $this->db->table($table)
                        ->select("*")
                        ->where($where)
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

}
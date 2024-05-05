<?php

namespace App\Models;


class Dashboard extends Base
{

    public function getTotals($where = array()){
        $sql = $this->db->table('profits p')
                        ->select("CONCAT('₱ ', FORMAT(SUM(totExpenses),2)) AS totExpenses,
                                CONCAT('₱ ', FORMAT(SUM(totSales),2)) AS totSales,
                                CONCAT('₱ ', FORMAT(SUM(totalProfit),2)) AS profit")
                        ->where($where)
                        ->get();

        return $sql->getResultArray();
    }

    public function getProfit($where = array()){
        $sql = $this->db->table('profits p')
                        ->select("Type,
                                SUM(totExpenses) AS totExpenses,
                                SUM(totSales) AS totSales,
                                SUM(totalProfit) AS profit")
                        ->where($where)
                        ->groupBy('p.Type')
                        ->get();

        return $sql->getResultArray();
    }

    public function getCropSales(){
        $sql = $this->db->table('sales s')
                        ->select("s.Type, SUM(Amount) AS totSales")
                        ->groupBy('s.Type')
                        ->get();

        return $sql->getResultArray();
    }

    public function harvestCrops($chart, $where = array()){
        $where['harvestDate IS NOT NULL'] = null;
        if($chart == 0){
            $sql = $this->db->table('crops c')
                        ->select("count(c.Crop_ID) as harvestedCrops")
                        ->where($where)
                        ->get();
        }else{
            $sql = $this->db->table('crops c')
                        ->select("Type,count(c.Crop_ID) as harvestedCrops")
                        ->where($where)
                        ->groupBy('Type')
                        ->get();
        }
        
        return $sql->getResultArray();
    }

    public function getYr($where = array()){

        $where['harvestDate IS NOT NULL'] = null;

        $sql = $this->db->table('profits p')
                        ->select("YEAR(harvestDate) AS yr")
                        ->where($where)
                        ->groupBy('YEAR(harvestDate)')
                        ->get();

        return $sql->getResultArray();
    }

    public function getSales($where = array()){

        $sql = $this->db->table('sales s')
                        ->select("DATE_FORMAT(s.dateCreated, '%b') month_format,
                        SUM(s.Amount) AS totSales")
                        ->join('crops c', 'c.`Crop_ID` = s.`Crop_ID`', 'left')
                        ->where($where)
                        ->groupBy('MONTH(s.dateCreated)')
                        ->get();

        return $sql->getResultArray();
    }

    public function getExpenses($where = array()){

        $sql = $this->db->table('expenses e')
                        ->select("e.type,
                        e.item,
                        e.`Formatted_totAmount`")
                        ->join('crops c', 'c.`Crop_ID` = e.`Crop_ID`', 'left')
                        ->where($where)
                        ->orderBy('dateCreated', 'DESC')
                        ->get();

        return $sql->getResultArray();
    }


}
<?php

namespace App\Models;

// use CodeIgniter\Model;

class User extends Base
{
    protected $table            = 'user';
    // protected $primaryKey       = 'ID';
    // protected $allowedFields    = ['Username', 'Password'];

    public function getUserByUsername($username) {
        return $this->db->table('user_login ul')
                        ->select("*")
                        ->join('user u', 'u.User_ID = ul.User_ID', 'left')
                        ->where('Username', $username)
                        ->get()
                        ->getRowArray();
    }

    public function getUserDetails($userID) {
        $sql = $this->db->table('user u')
                    ->select("u.*,
                            CONCAT(Last_Name, ', ', First_Name) AS fname,
                            ul.ID AS user_login_ID,
                            ul.Username,
                            ul.Password")
                    ->join('user_login ul', 'u.`User_ID` = ul.User_ID', 'left')
                    ->where('ul.User_ID', $userID)
                    ->get();

        return $sql->getRow();
    }

    public function modifyUser($userID, $fname, $lname, $email, $contact, $profile = null) {

        if($profile != null){
            $data = [
                'Profile' => $profile
            ];
        }else{
            $data = [
                'First_Name' => $fname,
                'Last_Name' => $lname,
                'Email' => $email,
                'Contact' => $contact
            ];
        }
        
        return $this->db->table('user')
                            ->where('User_ID', $userID)
                            ->update($data);
    }

    public function modifyUserLogin($userID, $userName, $pass) {

        $data = [
            'Username' => $userName,
            'Password' => $pass,
        ];
    

        return $this->db->table('user_login')
                            ->where('User_ID', $userID)
                            ->update($data);
    }

    public function modifyUserLog($email, $hashPassword) {
        $userID = $this->db->table('user')
                            ->select('User_ID')
                            ->where('email', $email)
                            ->get()
                            ->getRow()->User_ID;

        $data = [
            'Password' => $hashPassword
        ];

        return $this->db->table('user_login')
                         ->where('User_ID', $userID)
                         ->update($data);
    }

    public function addUser($firstname, $lastname, $email, $contact, $username, $password) {
        $query = $this->db->query("CALL user_insert(?, ?, ?, ?, ?, ?)", array($firstname, $lastname, $email, $contact, $username, $password));

        if ($query) {
            return $this->db->affectedRows();
        } else {
            return false;
        }
    }

    public function getDB() {
        $query = $this->db->query("SELECT 'Total Sales' AS `type`, CONCAT('₱',FORMAT(SUM(Amount),2)) AS sales FROM sales UNION SELECT 'Total Expenses' AS `type`, CONCAT('₱',FORMAT(SUM(totAmount),2)) AS expenses FROM expenses UNION SELECT 'Total Profit' AS `type`, CONCAT('₱',FORMAT(((SELECT SUM(Amount) FROM sales) - (SELECT SUM(totAmount) FROM expenses)),2)) AS profit UNION SELECT 'Total Volume' AS `type`, CONCAT(FORMAT(SUM(Volume),2),' kg') AS harvest_vol FROM sales");

        return $query->getResultArray();
    }
}

<?php

namespace Services;
class DbCreation
{
    private $db;
    public function __construct()
    {
        $this->db = Db::getDbInstance();
    }

    public function createWorkersTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS workers( ".
            "id INT NOT NULL AUTO_INCREMENT, ".
            "department_id INT NOT NULL, ".
            "name VARCHAR(255) NOT NULL, ".
            "PRIMARY KEY (id)); ";
        $this->db->query($sql);
    }

    public function createPayrollsTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS payrolls( ".
            "payroll_id INT NOT NULL AUTO_INCREMENT, ".
            "worker_id INT NOT NULL, ".
            "products_amount INT NOT NULL, ".
            "salary VARCHAR(40) NOT NULL, ".
            "PRIMARY KEY (payroll_id), ".
            "FOREIGN KEY (worker_id) REFERENCES workers (id) ON DELETE CASCADE); ";
        $this->db->query($sql);
    }

    public function addWorkers()
    {
        $sql = "SELECT * FROM `workers` LIMIT 1";
        $res = $this->db->query($sql);
        if ($res[0] == false) {
            for($i = 1; $i < 31; $i++){
                $workerName = 'worker' . $i;
                $departmentId = 1;
                if ( $i < 11) {
                    $departmentId = 1;
                } elseif ($i >= 11 && $i <21) {
                    $departmentId = 2;
                } elseif ($i >= 21) {
                    $departmentId = 3;
                }
                $sql = "INSERT INTO `workers` SET `department_id` = $departmentId, `name` = '$workerName'";
                $this->db->query($sql);
            }
            return true;
        }
        return 'table workers already has data';
    }

}


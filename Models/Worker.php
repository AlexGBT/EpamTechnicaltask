<?php

namespace Models;

class Worker extends ActiveRecordEntity
{
    protected $name;
    protected $departmentId;
    protected $id;

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function  getDepartmentId()
    {
        return $this->departmentId;
    }

    public function setName($name){
        $this->name = $name;
    }

    public  function workersForCreationPayroll() {
        $allWorkers = $this->findAll();
        $workersByDepartments =[];
        foreach ($allWorkers as $worker) {
            switch ( $worker->getDepartmentId ) {
                case 1:
                    $workersByDepartments['computerDepartment'][$worker->getName()];
                    break;
                case 2:
                    $workersByDepartments['TVDepartment'][$worker->getName()];
                    break;
                case 3:
                    $workersByDepartments['MobilePhonesDepartment'][$worker->getName()];
                    break;
            }
        }
        return $workersByDepartments;
    }

    public static function getWorkersOfDepartment($departmentId) {
        $workers = self::getByParameter('department_id',$departmentId );
        $workersNamesAndIds = [];
        foreach ($workers as $worker) {
            $workersNamesAndIds[] = [
                'name' => $worker->getName(),
                'id'  => $worker->getId(),
            ];
        }
        return $workersNamesAndIds;
    }

    protected static function getTableName(): string
    {
        return 'workers';
    }

    public static function getDepartments() {
        $departments = [
            1 => 'Computers Department' ,
            2 =>'TV Department' ,
            3 => 'Mobile Phones Department' ,
        ];
        return $departments;
    }


}
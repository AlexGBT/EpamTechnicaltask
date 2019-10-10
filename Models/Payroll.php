<?php

namespace Models;

class Payroll extends ActiveRecordEntity
{
    protected $workerId;
    protected $productsAmount;
    protected $salary;
    protected $payrollId;

    public function getPayrollId()
    {
        return $this->payrollId;
    }

    public function getWorkerId()
    {
        return $this->workerId;
    }


    public function getSalary()
    {
        return $this->salary;
    }

    public function getProducedProducts()
    {
        return $this->productsAmount;
    }

    public function setPayrollId($payrollId)
    {
        $this->payrollId = $payrollId;
    }

    public function setWorkerId($workerId)
    {
        $this->workerId = $workerId;
    }

    public function setSalary($salary)
    {
        $this->salary = $salary;
    }

    public function setProducedProducts($productsAmount)
    {
        $this->productsAmount = $productsAmount;
    }

    public static function checkPayrollExistance($workerId)
    {
        $result = self::getByParameter('worker_id',$workerId);
        return $result;
    }

    public static function createFromArray(array $fields)
    {
         $payroll = new Payroll();
         $payroll->setWorkerId($fields['worker_id']);
         $payroll->setProducedProducts($fields['products_amount']);
         $payroll->setSalary($fields['salary']);
         $payroll->setPayrollId($fields['payroll_id']);

         $payroll->save();
         return $payroll;
    }

    protected static function getTableName(): string
    {
        return 'payrolls';
    }
}
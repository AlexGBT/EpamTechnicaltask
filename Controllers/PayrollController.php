<?php

namespace Controllers;

use Models\Payroll;
use Models\Worker;

class PayrollController extends AbstractController
{
    public function view(int $payrollId)
    {
        $payroll = Payroll::getByParameter('payroll_id', $payrollId);
        $payroll=$payroll[0];
        $worker = Worker::getById($payroll->getWorkerId());
        $departments = Worker::getDepartments();
        return $this->view->renderHtml('payrolls/view.php', [
            'payroll' => $payroll,
            'worker' => $worker,
            'departments' => $departments,
        ],302);
    }

    public function create()
    {
        $departments = Worker::getDepartments();
        return $this->view->renderHtml('payrolls/create.php', [
            'departments' => $departments,
        ]);
    }

    public function store()
    {
        $payroll = Payroll::createFromArray($_POST);
        if ($payroll) {
            header('Location: /payroll/view/' . $payroll->getPayrollId(), true, 302);
            exit();
        }
    }

    public function edit($payrollId)
    {
        $payroll = Payroll::getByParameter('payroll_id',$payrollId);
        if (empty($payroll)) {
            echo 'Payroll does not exist';
        } else {
            $payroll = $payroll[0];
            $worker = Worker::getByParameter('id',$payroll->getWorkerId());
            $worker = $worker[0];
            $workerName = $worker->getName();
            $depatments = Worker::getDepartments();
            $workerDepartment =  $depatments[$worker->getDepartmentId()];
            return $this->view->renderHtml('payrolls/edit.php', [
                'payroll' => $payroll,
                'workerName' => $workerName,
                'workerDepartment' => $workerDepartment,
            ]);
        }
    }

    public function getPayrollExistance($workerId)
    {
        $arr = Payroll::checkPayrollExistance($workerId);
        empty($arr) ? $result = false : $result = true;
        echo json_encode($result);
    }

    public function findWorkerByName($name)
    {
        $worker = Worker::getByParameter('name',$name);
        if (empty($worker)) {
            echo json_encode(0);
        } else {
            $worker = $worker[0];
            $payroll = Payroll::getByParameter('worker_id', $worker->getId() );
            if (empty($payroll)){
                $salary = '-' ;
                $products = '-';
                $payrollId = '-';
            } else {
                $payroll = $payroll[0];
                $salary = $payroll->getSalary();
                $products = $payroll->getProducedProducts();
                $payrollId = $payroll->getPayrollId();
            }

            $departments = Worker::getDepartments();
            echo json_encode([
                'name' => $worker->getName(),
                'department' => $departments[$worker->getDepartmentId()],
                'salary' =>  $salary,
                'products' => $products,
                'payroll_id' => $payrollId,
            ]);
        }
    }
}
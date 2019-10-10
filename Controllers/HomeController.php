<?php
namespace Controllers;

use Models\Worker;

class HomeController extends AbstractController
{
    public function main ()
    {
        $departments = Worker::getDepartments();

        $workersAndPayrolls = Worker::getWorkersAndTheirPayrolls();
        $this->view->renderHtml('main.php', [
            'workersAndPayrolls' => $workersAndPayrolls,
            'departments' => $departments,
        ]);
    }
    public function addDataToDb() {
        $dbData = new \Services\DbCreation();
        $dbData->createWorkersTable();
        $dbData->createPayrollsTable();
        $dbData->addWorkers();

        header('Location: /home', true);
        exit();
    }
}
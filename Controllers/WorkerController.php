<?php

namespace Controllers;
use Models\Worker;
class WorkerController extends AbstractController
{
    public function getWorkersOfDepartment($department_id)
    {
        $w = Worker::getWorkersOfDepartment($department_id);
        echo json_encode($w);
    }


}
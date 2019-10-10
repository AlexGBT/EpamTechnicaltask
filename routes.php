<?php



return [
    '~^$~' => [\Controllers\HomeController::class, 'main'],
    '~^home$~' => [\Controllers\HomeController::class, 'main'],
    '~^db/creation$~' => [\Controllers\HomeController::class, 'addDataToDb'],
    '~^department/workers/([0-9]+)$~' => [\Controllers\WorkerController::class, 'getWorkersOfDepartment'],
    '~^payroll/view/([0-9]+)$~' => [\Controllers\PayrollController::class, 'view'],
    '~^payroll/create$~' => [\Controllers\PayrollController::class, 'create'],
    '~^payroll/edit/([0-9]+)$~' => [\Controllers\PayrollController::class, 'edit'],
    '~^payroll/store$~' => [\Controllers\PayrollController::class, 'store'],
    '~^payroll/existance/([0-9]+)$~' => [\Controllers\PayrollController::class, 'getPayrollExistance'],
    '~^payroll/find/(.+)$~' => [\Controllers\PayrollController::class, 'findWorkerByName'],


];
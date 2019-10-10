<?php include __DIR__ . '/../header.php'; ?>
<table>
    <thead>
    <tr>
        <th>Department</th>
        <th>Worker name</th>
        <th>Prooduced Products</th>
        <th>Salary ($)</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td id="department"><?= $departments[$worker->getDepartmentId()] ?></td>
        <td id ="name"><?= $worker->getName() ?></td>
        <td id ="products"><?= $payroll->getProducedProducts() ?></td>
        <td id ="salary"><?= $payroll->getSalary()  ?></td>
    </tr>
    </tbody>
</table>
<span id="linkHolder"></span>
<br>
<br>
<form id="searchForm" method="post">
    <label for="searchName">
        Enter name of worker:
        <input type="search" id="searchName" /></br>
    </label>
    </br>
    <input type="submit" value="Поиск" id="searchButton"/></br>
</form>

<a href="/">Go to all workers</a>

<script src="/templates/js/searchWorkers.js"></script>

<?php include __DIR__ . '/../footer.php'; ?>






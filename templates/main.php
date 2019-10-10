<?php include __DIR__ . '/header.php'; ?>

<a href="/db/creation" >Create DB tables and put workers</a>
<table class="sort">
     <thead>
        <tr>
            <td>Department</td>
            <th>Worker name</th>
            <td>Prooduced Products</td>
            <td>Salary ($)</td>
            <th>Create/Edit Payroll</th>
        </tr>
    </thead>

    <tbody>
    <?php foreach ($workersAndPayrolls as $workerAndPayroll): ?>
        <tr>
            <td><?=$departments[ $workerAndPayroll->department_id ]?></td>
            <td><?=$workerAndPayroll->name ?></td>
            <td><?=$workerAndPayroll->products_amount ?? '-' ?></td>
            <td><?=$workerAndPayroll->salary  ?? '-' ?></td>
            <td>
                <?php if($workerAndPayroll->salary): ?>
                    <a href='payroll/edit/<?=$workerAndPayroll->payroll_id?>'>Edit Payroll</a>
                <?php else: ?>
                    <a href='payroll/create'>Create Payroll</a>
                <?php endif; ?>
             </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<script src="/templates/js/tableSort.js"></script>
<?php include __DIR__ . '/footer.php'; ?>

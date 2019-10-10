<?php include __DIR__ . '/../header.php'; ?>
<p>Worker name: <?= $workerName?></p>
<p>Worker Department: <?= $workerDepartment?></p>

<form action="/payroll/store" method="post">
    <label for="produced" >
        Produced products:
        <input id ="produced" type="number" name="products_amount" required onchange="calculateSalary(this.value)" onkeyup="calculateSalary(this.value)" >
    </label>

    <label for="salary" >
        Salary:
        <input id ="salary" readonly="readonly" type="number" name="salary"  required>
    </label>

    <input name="worker_id" type="hidden" value="<?=$payroll->getWorkerId() ?>" >
    <input name="payroll_id" type="hidden" value="<?=$payroll->getPayrollId() ?>" >
    <input type="submit" value="Edit payroll" >
</form>
<a href="/">Go to all workers</a>
<script src="/templates/js/workersOfDepartment.js"></script>
<?php include __DIR__ . '/../footer.php'; ?>


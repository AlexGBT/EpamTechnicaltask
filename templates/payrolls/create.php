    <?php include __DIR__ . '/../header.php'; ?>
    <script src="/templates/js/workersOfDepartment.js"></script>

    <select name="departments" id = "departments" onchange="putWorkersOfCurrentDepartment(this.value)" style="margin-bottom:100px">
        <?php foreach ($departments as $id => $department): ?>
            <option value=<?=$id ?>><?=$department ?></option>
        <?php endforeach; ?>
    </select>

    <form action="/payroll/store" method="post">
        <select name="worker_id"  size="7" id = 'workers' required  onchange="doesWorkerHavePayroll(this.value)"></select>
        <span id = message ></span>
        <br>
        <br>
        <label for="produced" >
            Produced products:
            <input id ="produced" type="number" name="products_amount" required onchange="calculateSalary(this.value)" onkeyup="calculateSalary(this.value)">
        </label>
        <br>
        <br>
        <label for="salary" >
            Salary:
            <input id ="salary" readonly="readonly" type="number" name="salary"  required>
        </label>
        <br>
        <br>
        <input id ="submitButton" type="submit" value="Create payroll" >
    </form>
    <a href="/home">Go to all workers</a>
    <?php include __DIR__ . '/../footer.php'; ?>




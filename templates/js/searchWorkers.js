let form = document.getElementById('searchForm');
let searchElement = document.getElementById('searchName');

form.onsubmit = function() {
    let workerName =  searchElement.value;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            let response  = JSON.parse(this.responseText);
            insertWorkerOnPage(response);
        }
    };
    xmlhttp.open("GET", "/payroll/find/"+workerName, true);
    xmlhttp.send();
    return false;
};

function insertWorkerOnPage(parameters) {
    if (parameters) {
        let department = document.getElementById('department');
        let name = document.getElementById('name');
        let products = document.getElementById('products');
        let salary = document.getElementById('salary');

        department.innerHTML = parameters['department'];
        name.innerHTML = parameters['name'];
        products.innerHTML = parameters['products'];
        salary.innerHTML = parameters['salary'];

        insertCreateEditLink(parameters['payroll_id']);

    } else {
        alert("We don't have this worker. Enter another name");
    }
 }

 function insertCreateEditLink(payrollId) {
         let linkHolder = document.getElementById('linkHolder');
         linkHolder.innerHTML = '';
         let a = document.createElement('a');
         if (payrollId == '-') {
             a.setAttribute('href', '/payroll/create');
             a.innerHTML = 'Create payroll';
         } else {
             a.setAttribute('href', '/payroll/edit/'+payrollId);
             a.innerHTML = 'Edit payroll';
         }

         linkHolder.append(a);
 }
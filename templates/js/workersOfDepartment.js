
let currentDepartment = 1;
let doesCurrentWorkerHavePayroll;
let currentWorkerId;
function putWorkersOfCurrentDepartment(departmentId) {
    currentDepartment = departmentId;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            let workersArray  = JSON.parse(this.responseText);
            let workersSelector = document.getElementById('workers');
            workersSelector.innerHTML = '';
            workersArray.forEach(function (worker) {
                let option = document.createElement('option');
                option.setAttribute('value',worker['id']);
                option.innerHTML  = worker['name'];
                workersSelector.append(option);
            });
        }
    };
    xmlhttp.open("GET", "/department/workers/"+departmentId, true);
    xmlhttp.send();
}
putWorkersOfCurrentDepartment(1);

function doesWorkerHavePayroll(id) {
    currentWorkerId = id;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            let isPayroll  = JSON.parse(this.responseText);
            let messageElement = document.getElementById('message')
            let messageText = '';
            isPayroll ? messageText = 'Current Worker already has payroll' : messageText = '';
            messageElement.innerHTML = messageText;
            activeDisableSubmitButton(isPayroll);
            doesCurrentWorkerHavePayroll = isPayroll;

        }
    };
    xmlhttp.open("GET", "/payroll/existance/"+id, true);
    xmlhttp.send();
}

function calculateSalary(products) {
     let salaryElement = document.getElementById('salary');
     let salary = getDepartmentPrice() * Number(products) * 0.15;
     if (salary > 1500) {
       salary = 1500;
     }
     salaryElement.value = salary;

     return salary;
}

function getDepartmentPrice() {
     switch (Number(currentDepartment)) {
        case 1:
            return 1500;
            break;
        case 2:
            return 1000;
            break;
        case 3:
            return 500;
            break;
        default:
            alert( "Нет таких значений" );
    }
}


function activeDisableSubmitButton(isPayroll) {
    let submitButton = document.getElementById('submitButton');
    if(isPayroll) {
        submitButton.setAttribute("disabled","disabled")
        clearSalary();
        clearProducedProducts();
    } else{
        submitButton.removeAttribute("disabled");
    }
}

function clearSalary() {
    let salaryElement = document.getElementById('salary');
    salaryElement.value = '';
}

function clearProducedProducts() {
    let productElement = document.getElementById('produced');
    productElement.value = '';
}

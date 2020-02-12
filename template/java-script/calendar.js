let timestamp = document.getElementById('calendar').getAttribute('data-timestamp');
let xhr = new XMLHttpRequest();
xhr.open('get', '/task/gettask/'+timestamp);
xhr.send();
xhr.onload = function(event){
    if(xhr.response){
        let tasksOnMonth = JSON.parse(xhr.response);
        hightLightDays(tasksOnMonth);
    }
};

let taskList = document.getElementById('taskList');
let newTask = document.getElementById('newTask');
let taskRead = document.getElementById('taskRead');
let taskReadContent = document.getElementById('taskReadContent');
let taskForm = document.getElementById('taskForm');
let close = document.getElementsByClassName('close');
let daysInCalendar = document.getElementsByTagName('td');
let calendar = document.getElementById('calendar');
let editTask = document.getElementById('editTask');
let removeTask = document.getElementById('removeTask');
let toDay = new Date().getDate();
document.querySelector("td[data-day='"+toDay+"']").setAttribute('id', 'toDay');

bindEvents();

function hightLightDays(tasks){
    for(i = 0; i < tasks.length; i++){
        let dayNumber = tasks[i]['deadline']['mday']; 
        let title = tasks[i]['title'];
        let day = document.querySelector("td[data-day='"+dayNumber+"']");
        day.className = 'task';
        if(day.hasAttribute('title')){
            day.setAttribute('title', day.getAttribute('title')+',\n'+title);
        }else{
            day.setAttribute('title', title);
        }
  }
}

function bindEvents(){
    for(i = 0; i < daysInCalendar.length; i++){
        if(daysInCalendar[i].hasAttribute('data-day')){
            daysInCalendar[i].onclick = updateTaskList;
        }
    }
    
    editTask.onclick = updateTask;
    
    calendar.onclick = setDateInForm;
    
    document.forms[0].onsubmit = validate;
    
    for(i = 0; i < close.length; i++){
        close[i].onclick = function(){
            this.parentElement.style.display = 'none';
        };
    }
    
    removeTask.onclick = function(event){
        if(!confirm('вы действительно хотите удалить задачу')){
            event.preventDefault();
        }
    };
    
    newTask.onclick = function(){
        let form = document.forms[0];
        form.elements[0].value = '';
        form.elements[1].value = '';
        form.elements[2][0].removeAttribute('selected');
        form.elements[2][1].removeAttribute('selected');
        form.elements[2][2].removeAttribute('selected');
        form.elements[2][0].setAttribute('selected', '');
        form.elements[3].value = '';
        form.setAttribute('action', '/task/newtask');
        taskRead.style.display = 'none';
        taskForm.style.display = 'block';
    };
    
    taskList.getElementsByTagName('ul')[0].onclick = function(event){
    if(event.target.tagName === 'LI'){
        updateTaskRead(event.target.getAttribute('data-id'));
    }
    };
}
////////////////////////////////////////////////////////////////////////////////
function setDateInForm(event){
    if(event.target.hasAttribute('data-date')){
        date = new Date(Number(event.target.getAttribute('data-date')+'000')).toLocaleDateString();
        document.forms[0].elements.date.value = date;
    }
}
function updateTaskRead(id){
        let xhr = new XMLHttpRequest();
        xhr.open('get', '/task/gettaskbyid/'+id);
        xhr.send();
        xhr.onload = (function(){
            if(xhr.response){
                let response = JSON.parse(xhr.response);
                taskReadContent.innerHTML = '';
                let title = taskRead.getElementsByTagName('h3')[0];
                let date = document.createElement('p');
                let priority = document.createElement('p');
                let status = document.createElement('p');
                let content = document.createElement('p');
                let editTask = document.getElementById('editTask');
                let checkTask = document.getElementById('checkTask');
                let removeTask = document.getElementById('removeTask');
                editTask.setAttribute('data-id', response.id);
                removeTask.setAttribute('href', '/task/remove/'+response.id);
                checkTask.setAttribute('href', '/task/check/'+response.id);
                date.innerText = response.deadline.mday+' '+response.deadline.month+' '+response.deadline.year;
                title.innerText = response.title;
                priority.innerText = getPriority(response.priority);
                status.innerText = getStatus(response.status);
                content.innerText = response.content;
                taskReadContent.append(date);
                taskReadContent.append(priority);
                taskReadContent.append(status);
                taskReadContent.append(content);
                taskForm.style.display = 'none';
                taskRead.style.display = 'block';
            }
        });
}

function updateTaskList(event){
    let date = event.target.getAttribute('data-date');
    let xhr = new XMLHttpRequest();
    xhr.open('get', '/task/gettaskbyday/'+date);
    xhr.send();
    xhr.onload = function (){
        if(xhr.response){
            let response = JSON.parse(xhr.response);
            let tasks = response.tasks;
            date = 'задачи на '+response.date.mday+' '+response.date.month+' '+response.date.year;
            taskList.getElementsByTagName('h2')[0].innerHTML = date;
            let ul = taskList.getElementsByTagName('ul')[0];
            ul.innerHTML = '';
            for(i = 0; i < tasks.length; i++){
                let li = document.createElement('li');
                li.setAttribute('data-id', tasks[i].id);
                li.innerHTML = tasks[i].title;
                if(tasks[i].status === '0'){
                    li.classList.add('checked');
                }
                ul.append(li);
            }
            taskRead.style.display = 'none';
        }
    };
}

function getPriority(priority){
    switch (priority){
        case '1': return 'низкий приоритет';
        case '2': return 'средний приоритет';
        case '3': return 'высокий приоритет';
    }
}

function getStatus(status){
    switch (status){
        case '1': return 'статус активна';
        case '0': return 'выполнена';
    }
}

function validate(event){
    event.preventDefault();
    let errors = document.getElementById('showErrors');
    let form = document.forms[0];
    let elements = form.elements;
    if(elements.title.value.length === 0 || elements.content.value.length === 0 || elements.date.value.length === 0){
        errors.classList.remove('hide');
        errors.classList.add('show');
        setTimeout(function(){
            errors.classList.remove('show');
            errors.classList.add('hide');
        }, 2000);
    }else{
        elements.date.removeAttribute('disabled');
        this.submit();
    }
}

function updateTask(){
    let id = this.getAttribute('data-id');
    let xhr = new XMLHttpRequest();
    xhr.open('get', '/task/gettaskbyid/'+id);
    xhr.send();
    xhr.onload = function(){
        if(xhr.response){
            let response = JSON.parse(xhr.response);
            let form = document.forms[0];
            let date = new Date(Number(response.deadline[0]+'000'));
            form.elements[0].value = response.title;
            form.elements[1].value = date.toLocaleDateString();
            form.elements[2][response.priority-1].setAttribute('selected', '');
            form.elements[3].value = response.content;
            form.setAttribute('action', '/task/update/'+id);
            taskRead.style.display = 'none';
            taskForm.style.display = 'block';
        }
    }
}

@extends('app')

@section('content')
    <div class="container">
        
        @include('common.errors')
        
            <div class="card mt-4 w-100">
                <div class="card-header">
                    <span class="float-left">Current Tasks</span>
                    <span class="float-right">
                        <button class="btn btn-sm btn-dark" onСlick="getTasks()">Show</button>
                        <button class="btn btn-sm btn-primary ml-4" data-toggle="modal" data-target="#addTaskModal">Add</button>
                    </span>
                </div>

                <div class="card-body">
                   <table class="table table-striped">
                       <tbody id="tasksListDiv">
                       </tbody>
                   </table>
                </div>

                <div class="modal" id="addTaskModal">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body">
                                <h5>Add Task</h5>
                                <div class="form-group">
                                    <input type="text" name="name" id="taskName" class="form-control" />
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button class="btn btn-light" data-dismiss="modal">Escave</button>
                                <button class="btn btn-success" onClick="createTask(event)">Добавить</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal" id="errorModal">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header bg-danger text-white">
                                <h5>Error</h5>
                            </div>

                            <div class="modal-body">
                                <span id="errorModalText"></span>
                            </div>

                            <div class="modal-footer">
                                <button class="btn btn-light" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>


<script>
    document.addEventListener("DOMContentLoaded", getTasks);
    function renderTask(taskId, taskName) {
        let cElementTr = document.createElement('tr');
        cElementTr.id = `task-${taskId}`;
        document.getElementById('tasksListDiv').appendChild(cElementTr);

        let cElement = document.createElement('td');
        cElement.innerText = taskId;
        cElementTr.appendChild(cElement);

        cElement = document.createElement('td');
        cElement.innerText = taskName;
        cElementTr.appendChild(cElement);

        cElement = document.createElement('td');
        cClickButton = document.createElement('button');
        cClickButton.innerText = 'Delete';
        cClickButton.className = 'btn btn-sm btn-danger';
        cClickButton.id = `delButton-${taskId}`;
        cElement.appendChild(cClickButton);

        cElementTr.appendChild(cElement);

        document.getElementById(`delButton-${taskId}`).addEventListener('click', function() {
            deleteTask(taskId);
        });
    }

    function deleteTask(delId) {
        let request = new XMLHttpRequest();
        let data = "task="+encodeURIComponent(delId);

        request.onreadystatechange = function () {
            if(request.readyState == 4 && request.status == 200) {
                document.getElementById('tasksListDiv').removeChild(
                    document.getElementById(`task-${delId}`)
                );
            }
        }
                    
        request.open('delete', `/ajax/${delId}`, true);
        request.responseType = 'json';
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        request.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
        request.send(data);
    }

    function getTasks() {
        let request = new XMLHttpRequest();

        request.onreadystatechange = function() {
            if(request.readyState == 4 && request.status == 200) {
                let tasksList = request.response;
                document.getElementById('tasksListDiv').innerHTML = '';

                for(oneTask of tasksList) {
                    renderTask(oneTask.id, oneTask.name);
                }
            }
        }

        request.open('GET', '/ajax/tasks', true);
        request.responseType = 'json';
        request.send();
    }

  
 
 function createTask(e) {
     e.preventDefault();

     let request = new XMLHttpRequest();
     let data = "name="+encodeURIComponent(document.getElementById('taskName').value);

     request.onreadystatechange = function() {
         if(request.readyState == 4) {
             if(request.status == 200) {
                 let newTask = request.response;

                 if(newTask) {
                     renderTask(newTask.id, newTask.name);

                     $('#addTaskModal').modal('hide');
                     document.getElementById('taskName').value = '';
                 }
             }
             else {
                 let errorsText = '<p>The following errors occured on adding: </p> <ul class="mb-0">';
                 for(err of request.response.errors) {
                     errorsText += '<li>' + err + '</li>';
                 }
                 errorsText += '</ul>';
                 document.getElementById('errorModalText').innerHTML = errorsText;

                 $('#addTaskModal').modal('hide');
                 $('#errorModal').modal('show');
             }
         }
     }

     request.open('POST', '{{ url("/ajax") }}', true);
     request.responseType = 'json';

     request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
     request.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');

     request.send(data);
 }
</script>
            </div>
    </div>
@endsection
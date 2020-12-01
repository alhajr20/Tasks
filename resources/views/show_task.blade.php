@extends('app')

@section('content')
 <div class="container">
     <div class="row">
     @include('common.errors')
         <div class="card col-12">
             <div class="card-body">

                         <form action="{{ url('task/'.$task->id) }}" method="POST" >
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="name" class="control-label">Task</label>
                                <div>
                                    <input type="text" name="name" id="name" class="form-control" value="{{ $task->name }}" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="status" class="control-label">Task Status</label>
                                <select class="form-control" name="status" id="status">
                                    @foreach($statuses as $status)
                                    <option value=" {{ $status->id }} "
                                        @if ($status->id == $task->status['id'])
                                            selected="selected" 
                                        @endif   
                                    > {{ $status->name }} </option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="form-group mb-0">
                                <div class="w-100">
                                    <a href="{{ url('/') }}" class="btn btn-default mr-4">Back</a>
                                    <button type="submit" class="btn btn-success">Save task</button>
                                </div>

                            </div>
                        </form>
             </div>
         </div>
     </div>
<div class="col-12">
     <div class="card mt-4">
        <div class="card-header">
            <span class="float-left">Groups of executors</span>
            <span class="float-right">
                <button class="btn btn-sm btn-dark" data-toggle="modal" data-target="#addModal"> Add</button>
            </span>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <tbody>
                    @foreach($groups as $group)
                        <tr>
                            <td>{{ $group->name }}</td>
                            <td>
                                <form action="{{ url('task/'.$task->id.'/delgroup/'.$group->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
     </div>
     </div>

    <form action="{{ url('task/'.$task->id.'/addgroup') }}" method="POST">
        <div class="modal" id="addModal">
            <div class="modal-dialog modal-dialog-centered">
            {{ csrf_field() }}
            <div class="modal-content">
                <div class="modal-body">
                    <h5>Add group</h5>
                    <div class="form-group">
                        <select class="form-control custom-select" name="group" id="group">
                        @foreach($allgroups as $onegroup)
                        <option value="{{ $onegroup->id }}">
                            {{ $onegroup->name }}
                        </option>
                        @endforeach
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Cansel</button>
                    <button type="submit" class="btn btn-success">Add</button>
                </div>
            </div>
            </div>
        </div>
</form>

 </div>
@endsection
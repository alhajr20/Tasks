@extends('app')

@section('content')
    <div class="container">
        <div class="row">

        @include('common.errors')
        
            <div class="card w-100">
                <div class="card-body">
                    <form action="{{ url('task') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="name" class="control-label">Task</label>
                            <div>
                                <input type="text" name="name" id="name" class="form-control" />
                            </div>
                        </div>

                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="image" name="image" 
                            accept="image/jpeg,image/png">
                            <label for="image" class="custom-file-label">Choose image</label>
                        </div>


                        <div class="form-group mb-0 mt-4">
                            <div class="w-100">
                                <button type="submit" class="btn btn-primary">Add task</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
            <div class="card mt-4 w-100">
                <div class="card-header">
                    Current tasks
                </div>
                <div class="card-body">
                   <table class="table table-striped">
                       <tbody>
                           @foreach($tasks as $task)
                           <tr>

                                <td>
                                    @if($task->image)
                                        <img src="{{ asset(url($task->image)) }}" width="80">
                                    @endif
                                </td>

                                <td class="table-text">
                                    <a href="{{ url('task/'.$task->id) }}">{{ $task->name }}</a>
                                </td>

                                <td class="table-text">
                                     {{ $task->status['name'] }}
                                </td>

                                <td>
                                    <form id="delform-{{$task->id}}" action="{{ url('task/'.$task->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <button type="button" onclick="clickdelButton(event, 'delform-{{$task->id}}')" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                           </tr>
                           @endforeach
                       </tbody>
                   </table>
            
                   {{ $tasks->links('vendor.pagination.bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection
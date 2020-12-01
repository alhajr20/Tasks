@extends('app')

@section('content')
    <div class="container">
        <div class="row">
        @include('common.errors')
            <div class="card w-100">
                <div class="card-body">
                    <form action="{{ url('statuses') }}" method="POST" >
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="name" class="control-label">Status</label>
                            <div>
                                <input type="text" name="name" id="name" class="form-control" />
                            </div>
                        </div>

                        <div class="form-group mb-0">
                            <div class="w-100">
                                <button type="submit" class="btn btn-primary">Add status</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
            <div class="card mt-4 w-100">
                <div class="card-header">
                    Status List
                </div>
                <div class="card-body">
                   <table class="table table-striped">
                       <tbody>
                           @foreach($statuses as $status)
                           <tr>
                                <td class="table-text">
                                    <a href="{{ url('statuses/'.$status->id) }}">{{ $status->name }}</a>
                                </td>
                                <td>
                                    <form id="delform-{{$status->id}}" action="{{ url('statuses/'.$status->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <button type="button" onclick="clickdelButton(event, 'delform-{{$status->id}}')" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                           </tr>
                           @endforeach
                       </tbody>
                   </table>
                   {{ $statuses->links('vendor.pagination.bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection
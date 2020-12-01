@extends('app')

@section('content')
    <div class="container">
        <div class="row">
        @include('common.errors')
            <div class="card w-100">
                <div class="card-body">
                    <form action="{{ url('groups') }}" method="POST" >
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="name" class="control-label">Group</label>
                            <div>
                                <input type="text" name="name" id="name" class="form-control" />
                            </div>
                        </div>

                        <div class="form-group mb-0">
                            <div class="w-100">
                                <button type="submit" class="btn btn-primary">Add group</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
            <div class="card mt-4 w-100">
                <div class="card-header">
                   Group List
                </div>
                <div class="card-body">
                   <table class="table table-striped">
                       <tbody>
                           @foreach($groups as $group)
                           <tr>
                                <td class="table-text">
                                    <a href="{{ url('groups/'.$group->id) }}">{{ $group->name }}</a>
                                </td>
                                <td>
                                    <form id="delform-{{$group->id}}" action="{{ url('groups/'.$group->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <button type="button" onclick="clickdelButton(event, 'delform-{{$group->id}}')" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                           </tr>
                           @endforeach
                       </tbody>
                   </table>
                   {{ $groups->links('vendor.pagination.bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection
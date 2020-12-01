@extends('app')

@section('content')
 <div class="container">
     <div class="row">
     @include('common.errors')
         <div class="card col-12">
             <div class="card-body">

                         <form action="{{ url('groups/'.$group->id) }}" method="POST" >
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="name" class="control-label">Group</label>
                                <div>
                                    <input type="text" name="name" id="name" class="form-control" value="{{ $group->name }}" />
                                </div>
                            </div>

                            <div class="form-group mb-0">
                                <div class="w-100">
                                    <a href="{{ url('groups') }}" class="btn btn-default mr-4">Back</a>
                                    <button type="submit" class="btn btn-success">Save group</button>
                                </div>

                            </div>
                        </form>
             </div>
         </div>
     </div>
 </div>
@endsection
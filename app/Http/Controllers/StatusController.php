<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Status;
use Validator;

class StatusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $statuses_from_controller = Status::orderBy('name','asc')->paginate(3);
        return view('statuses.index', ['statuses'=>$statuses_from_controller]);
    }

    public function create(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        
        ]);
        
        if($validator->fails()) {
            return redirect('/statuses')->withInput()->withErrors($validator);
        }

        $status = new Status();

        $status->name = $request->name;
        $status->save();

        return redirect('/statuses');
    }

    
    public function delete(Status $status) {
        $status->delete();

        return redirect('/statuses');
    }

    public function show(Status $status) {
        return view('statuses.show', ['status' => $status]);
    }

    public function update(Request $request, Status $status) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        
        ]);
        
        if($validator->fails()) {
            return redirect('/statuses/'.$status->id)->withInput()->withErrors($validator);
        }

        $status->name = $request->name;
        $status->update();
        return redirect('/statuses');
    }
}

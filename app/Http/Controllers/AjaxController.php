<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Task;

use Validator;

class AjaxController extends Controller
{
    public function index() {
        return view('ajax.index');
    }

    public function task_list() {
     $tasks_from_controller = Task::orderBy('created_at','desc')->get();

     return  $tasks_from_controller; 
    }


    public function create(Request $request) {
        $validator = Validator::make($request->all(), ['name' => 'required|max:255',]);
        
        if($validator->fails()) {
            //return redirect('/')->withInput()->withErrors($validator);
            return response()->json(['errors' => $validator->errors()->all()], 201);
        }

        $task = new Task;
        $task->name = $request->name;
        $task->status_id = 1;
        $task->image = "";

        return $task;
    }

    public function delete(Task $task) {
        $task->delete();
        return response()->json(['message' => 'It is deleted'], 200);
    }
}

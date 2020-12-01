<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Status;
use App\Group;
use Validator;

class TasksController extends Controller
{
public function __construct() {
    $this->middleware('auth');
}

    public function index(Request $request) {
        //$tasks_from_controller = Task::orderBy('created_at','desc')->paginate(3);
        $tasks_from_controller = $request->user()->tasks()->orderBy('created_at','desc')->paginate(3);

        return view('tasks', ['tasks'=>$tasks_from_controller]);
    }

    public function create(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        
        ]);
        
        if($validator->fails()) {
            return redirect('/')->withInput()->withErrors($validator);
        }

        $filename = "";
        if($request->hasFile('image')) {
            $file = $request->file('image');
            $store_filename = time().'_'.$file->getClientOriginalName();

            $file->move(public_path().'/uploads', $store_filename);
            $filename = '/uploads/'.$store_filename;
        }

        // $task = new Task;
        // $task->name = $request->name;
        // $task->status_id = 5;
        // $task->save();

        $request->user()->tasks()->create([
            'name' => $request->name,
            'image' => $filename,
            'status_id' => 1
        ]);

        return redirect('/');
    }

    public function delete(Request $request, Task $task) {
        if( $request->user()->tasks()->find($task->id)) {
            $task->delete();
        }
       

        return redirect('/');
    }
    public function show(Request $request, Task $task) {
        $statuses = Status::all();
        $allgroups = Group::all();//1

        if( $request->user()->tasks()->find($task->id)) {
            $groups = $task->groups;//2

            return view('show_task', [
                'task' => $task,
                'statuses' => $statuses,
                'allgroups' => $allgroups,//3
                'groups' => $groups//4
                ]);
        } else {
           return redirect('/');
        }
        
    }
    public function update(Request $request, Task $task) {
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);
        
        if($validator->fails()) {
            return redirect('task/'.$task->id)->withInput()->withErrors($validator);
        }

        // $task->name = $request->name;
        // $task->status_id = $request->status;
        // $task->update();
        
        if( $request->user()->tasks()->find($task->id) ) {
            $task->update([
                'name' => $request->name,
                'status_id' => $request->status
            ]);
        }
        return redirect('/');
    }

    public function add_group(Request $request, Task $task) {
        if( $request->user()->tasks()->find($task->id) ) {
            if($group = Group::find($request->group)) {
                if(!$task->groups->find($group->id)) {
                    $task->groups()->attach([$group->id]);
                }
            }
        }
        
        return redirect('task/'.$task->id);
    }

    public function del_group(Request $request, Task $task, Group $group) {
        if($request->user()->tasks()->find($task->id)) {
            if($task->groups->find($group->id)) {
                $task->groups()->detach([$group->id]);

            }
        }
        return redirect('task/'.$task->id);
    }
}


<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(){
        $tasks = Task::paginate(10);
        return view('index',compact('tasks'));
    }
    public function create(){
        return view('create');
    }
    public function show($id){
        $task = Task::findOrFail($id);
        return view('show',compact('task'));
    }
    public function edit($id){
        $task = Task::findOrFail($id);
        return view('edit',compact('task'));
    }
    public function insert(TaskRequest $request){
        $validated=$request->validated();
        if($validated){
            $task = Task::create([
                'title'=>$request->title,
                'description'=>$request->description,
                'long_description'=>$request->long_description,
                'completed'=>false
            ]);
            session()->flash('success', 'Task created successfully!');
            return redirect()->route('tasks.show',['id'=>$task->id]);
        }
    }
    public function update(TaskRequest $request,$id){
        $task=Task::findOrFail($id);
        $validated=$request->validated();
        if($validated){
            $task->where('id',$id)->update([
                'title'=>$request->title,
                'description'=>$request->description,
                'long_description'=>$request->long_description
            ]);
            session()->flash('success', 'Task updated successfully!');
            return redirect()->route('tasks.show',['id'=>$task->id]);
        }
        else{
            session()->flash('Error','Please follow the rules');
        }
    }
    public function mark($id){
        $task=Task::findOrFail($id);
        $task->completed=!$task->completed;
        Task::where('id',$id)->update([
            'completed'=>$task->completed
        ]);
        return redirect()->back()->with('success', 'Task updated successfully!');
    }
    public function delete($id){
        Task::destroy($id);
        session()->flash('success', 'Task deleted successfully!');
        return redirect()->route('tasks.index');
    }
}

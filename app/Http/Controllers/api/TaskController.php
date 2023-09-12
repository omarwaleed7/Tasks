<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Models\Task;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    use ApiResponseTrait;
    public function index(){
        $tasks = Task::all();
        if($tasks){
            return $this->apiResponse($tasks,'Tasks retrieved successfully',200);
        }
        else{
            return $this->apiResponse(null,'Tasks not retrieved',404);
        }
    }
    public function show($id){
        $task = Task::find($id);
        if($task){
            return $this->apiResponse($task,'Task retrieved successfully',200);
        }
        else{
            return $this->apiResponse(null,'Task not retrieved',404);
        }
    }
    public function insert(TaskRequest $request)
    {
            $task = Task::create([
                'title'=>$request->title,
                'description'=>$request->description,
                'long_description'=>$request->long_description,
                'completed'=>false
            ]);
            return $this->apiResponse($task, 'inserted', 201);
    }
    public function update(TaskRequest $request,$id){
        $task=Task::find($id);
        if(!$task){
            return $this->apiResponse(null,'Task not found',404);
        }
            $task->update([
                'title'=>$request->title,
                'description'=>$request->description,
                'long_description'=>$request->long_description
            ]);
            return $this->apiResponse($task,'Task updated successfully',200);
    }
    public function mark($id){
        $task=Task::find($id);
        if (!$task) {
            return $this->apiResponse(null, 'Task not found', 404);
        }
        $task->completed=!$task->completed;
        $task->update([
            'completed'=>$task->completed
        ]);
        return $this->apiResponse($task,'Task updated successfully',200);
    }
    public function delete($id)
    {
        $task = Task::find($id);
        if (!$task) {
            return $this->apiResponse(null, 'Task not found', 404);
        }
        $task->delete();
        return $this->apiResponse(null, 'Task deleted successfully', 200);
    }
}

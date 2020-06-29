<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()) {
            $tasks= Task::orderBy('id','asc')->get();
            return datatables()->of($tasks)
                ->editColumn('name', function (Task $tasks){
                    return view('tasks.include.name',compact('tasks'));
                })
                ->editColumn('action', function (Task $tasks){
                    return view('tasks.include.action',compact('tasks'));
                })
                ->make(true);
        }

        $title='قائمة كافة المهام';
        return view('tasks.index',compact('title'));
    }
    public function completed()
    {
        if(request()->ajax()) {
            $tasks= Task::where('status','completed')->orderBy('id','asc')->get();
            return datatables()->of($tasks)
                ->editColumn('name', function (Task $tasks){
                    return view('tasks.include.name',compact('tasks'));
                })
                ->editColumn('action', function (Task $tasks){
                    return view('tasks.include.action',compact('tasks'));
                })
                ->make(true);
        }

        $title='قائمة المهام المكتملة';
        return view('tasks.completed',compact('title'));
    }
    public function uncompleted()
    {
        if(request()->ajax()) {
            $tasks= Task::where('status','!=','completed')->orderBy('id','asc')->get();
            return datatables()->of($tasks)
                ->editColumn('name', function (Task $tasks){
                    return view('tasks.include.name',compact('tasks'));
                })
                ->editColumn('action', function (Task $tasks){
                    return view('tasks.include.action',compact('tasks'));
                })
                ->make(true);
        }

        $title='قائمة المهام الغير المكتملة';
        return view('tasks.uncompleted',compact('title'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $taskId = $request->task_id;
        $today = Carbon::today()->format('Y-m-d');
        if($request->start_date <= $today){
            $status = 'inprogress';
        }else{
            $status = 'pending';
        }
        $tasks = Task::updateOrCreate(
            ['id' => $taskId],
                ['name' => $request->name,
                'description' => $request->description,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'status' => $status,
                'user_id' => Auth::user()->id,]
        );
        return Response()->json($tasks);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tasks = Task::findOrFail($id);
        return Response()->json($tasks);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tasks = Task::findOrFail($id);
        $tasks->delete();
    }

    public function complete($id){
        $tasks=Task::findorfail($id);
        $tasks->status='completed';
        $tasks->update();
        return Response()->json($tasks);
    }
}

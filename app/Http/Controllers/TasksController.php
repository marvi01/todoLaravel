<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use App\Models\User;
use App\Models\UserTasks;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Tasks::all();


        return view('tasks.list-tasks', compact('tasks'));
    }

    public function search(Request $request)
    {
        $params = $request->all();
        $tasks = Tasks::where('title','LIKE', '%'.$params['value'].'%')
                    ->orWhere('description','LIKE', '%'.$params['value'].'%')
            ->get();
        return view('tasks.list-tasks', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();

       // return  view('create', compact('users'));
        return view('tasks.create-task', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $data = $request->all();
            $task =Tasks::create($data);
            foreach ($data['user_id'] as $user_id){
                UserTasks::create(
                    [
                        'user_id'=>$user_id,
                        'task_id'=>$task->id
                    ]
                );
            }
            return redirect('tasks');
        }catch (\Exception $exception){

        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $users = User::all();
        $task = Tasks::find($id);
        $usersTask = UserTasks::where('task_id', $id)->get()->pluck('user_id');

        return view('tasks.edit-task', compact('users', 'task', 'usersTask'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $task = Tasks::find($id);
        if($data['finalDate'] == null){
            $data['status'] =1;
        }else if (strtotime($data['finalDate']) > strtotime($data['expectedFinalDate'])) {
            $data['status']= 4;
        }else {
            $data['status'] =3;
        }

        $task->update($data);
       return redirect('tasks');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete= Tasks::where('id', $id)->delete();
        if($delete){
            return 'deletado com sucesso';
        }else {
            return 'erro ao deletar';
        }
    }

    public function reportView()
    {

        $tasks = Tasks::with('userTasks.users')->get();
        //dd($tasks[111]->userTasks[0]->users->name);
        return view('reports.report-tasks', compact('tasks'));
    }
    public function reportValues(Request $request)
    {
        $params = $request->all();
        try {


            $tasks = Tasks::where(function ($q) use ($params){
                if(isset($params['initialDate']) && $params['initialDate'] != null){
                    $q->whereDate('initialDate','>=',$params['initialDate'] );
                }
            } )
                ->where(function ($q) use ($params){
                    if(isset($params['status'])){
                        if($params['status'] != '0'){
                            $q->where('status', $params['status']);
                        }
                    }

                })
               // ->orderBy($params['order'])
                ->with('userTasks.users')
                ->get();
            return view('reports.report-tasks', compact('tasks'));
        }catch (\Exception $exception){
            dd($exception, $params);
        }

    }
    public function dashboard()
    {
        $tasks =Tasks::all();
        $result = collect();
        foreach ($tasks->groupBy('status') as $status=>$taskStatus){
            $result->push([
               'status' =>$status,
               'quantity' => count($taskStatus)
            ]);
        }

        return view('dashboard', compact('result'));
    }
}

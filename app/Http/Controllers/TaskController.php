<?php

namespace App\Http\Controllers;

use App\Task;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\TaskRepository;

class TaskController extends Controller
{
    /**
     * The task repository instance.
     *
     * @var TaskRepository
     */
    protected $tasks;

    /**
     * Create a new controller instance.
     *
     * @param  TaskRepository  $tasks
     * @return void
     */
    public function __construct(TaskRepository $tasks)
    {
        //$this->middleware('auth');

        $this->tasks = $tasks;
    }

    /**
     * Display a list of all of the user's task.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    {
        $tasks = Task::orderBy('created_at', 'asc')->get();

        return view('tasks.index', [
            'tasks' => $tasks,
        ]);
    }

    /**
     * Create a new task.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required|max:255',
            ],
            [
                'required' => 'Preencha o nome da tarefa',
                'max' => 'O nome da tarefa não pode ser maior que 255 caracteres.'
            ]
        );

        Task::create([
            'name' => $request->name,
            'status' => $request->status
        ]);

        return redirect('/');
    }

    /**
     * Destroy the given task.
     *
     * @param  Task  $task
     * @return Response
     */
    public function destroy($task)
    {
        $task = Task::findOrFail($task);
        $task->delete();
        return redirect('/');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::findOrFail($id);

        return view('update')->withTask($task);
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
        $task = Task::findOrFail($id);

        $task->update($request->all());
        return redirect("/");
    }

    public function changeStatus($id)
    {
        $task = Task::findOrFail($id);

        $task->status = !$task->status;

        $task->update();
        return redirect("/");
    }
}

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
        $this->tasks = $tasks;
    }

    /**
     * Exibe as tarefas
     *
     * @param  Request  $request
     * @return View tasks
     */
    public function index(Request $request)
    {
        $tasks = Task::orderBy('created_at', 'asc')->get();

        return view('tasks.index', [
            'tasks' => $tasks,
        ]);
    }

    /**
     * Cria uma nova tarefa
     *
     * @param  Request  $request
     * @return View tasks
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
     * Apaga a tarefa
     *
     * @param  Task  $task
     * @return View tasks
     */
    public function destroy($task)
    {
        $task = Task::findOrFail($task);
        $task->delete();
        return redirect('/');
    }

    /**
     * Retorna a view de modo edição
     *
     * @param  int  $id
     * @return View update
     */
    public function edit($id)
    {
        $task = Task::findOrFail($id);

        return view('update')->withTask($task);
    }

    /**
     * Atualiza a tarefa
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return View tasks
     */
    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        $task->update($request->all());
        return redirect("/");
    }

    /**
     * Altera a situação da tarefa
     *
     * @param  int  $id
     * @return View tasks
     */
    public function changeStatus($id)
    {
        $task = Task::findOrFail($id);

        $task->status = !$task->status;

        $task->update();
        return redirect("/");
    }
}

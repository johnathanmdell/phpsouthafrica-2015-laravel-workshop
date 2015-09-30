<?php
namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Task;
use Illuminate\Contracts\Auth\Guard;
use App\Http\Requests;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Guard $guard
     * @return Response
     */
    public function index(Guard $guard)
    {
        $tasks = Task::where('user_id', '=', $guard->user()->id)
            ->orderBy('completed', 'asc')->orderBy('id', 'desc')->paginate(10);

        return view('tasks.index', compact('tasks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TaskRequest $taskRequest
     * @param Guard $guard
     * @return Response
     */
    public function store(TaskRequest $taskRequest, Guard $guard)
    {
        $task = Task::create($taskRequest->input());

        if (!$task instanceof Task) {
            throw new BadRequestHttpException('Task could not be created.');
        }

        $task->user()->associate($guard->user())->save();

        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Task $task
     * @return Response
     */
    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Task $task
     * @return Response
     */
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Task $task
     * @param TaskRequest $taskRequest
     * @return Response
     */
    public function update(Task $task, TaskRequest $taskRequest)
    {
        $task->update($taskRequest->input());

        return redirect()->route('tasks.show', $task->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Task $task
     * @return Response
     * @throws \Exception
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index');
    }

    /**
     * Marks the specific task as either completed or not.
     *
     * @param Task $task
     * @return Response
     */
    public function mark(Task $task)
    {
        $task->update(['completed' => $task->completed === 0 ? 1 : 0]);

        return redirect()->route('tasks.index');
    }
}

<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use App\Enums\TaskStatus;

class TaskCompleteController extends Controller
{
    public function __invoke(int $id, Request $request)
    {
        $task = Task::findOrFail($id);
        $task->load('event');

        $task->event->authorized(auth()->user(), false);

        $task->update([
            'status' => TaskStatus::Done,
        ]);

        return redirect()->back();
    }
}

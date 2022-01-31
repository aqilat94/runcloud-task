<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;

    public function viewTask(User $user, Task $task)
    {
        return $user->id == $task->user_id;
    }

    public function statusIncomplete(User $user, Task $task)
    {
        if($task->status == 0)
        {
            return true;
        }
    }

}

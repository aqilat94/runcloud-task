<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Workspace;
use Illuminate\Auth\Access\HandlesAuthorization;

class WorkspacePolicy
{
    use HandlesAuthorization;

    public function viewWorkspace(User $user, Workspace $workspace)
    {
        return $user->id == $workspace->user_id;
    }

}

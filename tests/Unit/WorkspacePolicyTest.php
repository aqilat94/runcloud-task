<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\Workspace;
use PHPUnit\Framework\TestCase;
use App\Policies\WorkspacePolicy;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WorkspacePolicyTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */

    public function test_other_user_cant_see_other_user_workspace()
    {
        $workspace_policy = new WorkspacePolicy;

        $user = User::factory()->create([
            'name' => 'testuser',
        ]);

        $this->actingAs($user);

        $workspace = Workspace::factory()->create([
            'user_id' => $user->id,
        ]);

        $result = $workspace_policy->viewWorkspace($user, $workspace);

        $this->assertTrue($result);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Workspace extends Model
{
    protected $primaryKey = 'workspace_id';
    protected $fillable = ['name'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'workspace_user')
            ->withPivot('joined_at');
    }

    public function addUsersToWorkspace($userIds)
    {
        // Logic to add users to workspace
    }

    public function removeUserFromWorkspace($userId)
    {
        // Logic to remove a user from workspace
    }
}
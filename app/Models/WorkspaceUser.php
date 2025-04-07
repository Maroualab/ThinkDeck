<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkspaceUser extends Model
{
    protected $table = 'workspace_user';
    protected $fillable = ['workspace_id', 'user_id', 'joined_at'];

    public function workspace()
    {
        return $this->belongsTo(Workspace::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pages()
    {
        return $this->hasMany(Page::class);
    }
}
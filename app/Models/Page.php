<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Page extends Model
{
    protected $primaryKey = 'page_id';
    protected $fillable = ['title', 'content'];

    public function workspaceUser()
    {
        return $this->belongsTo(WorkspaceUser::class);
    }

    public function blocks()
    {
        return $this->hasMany(Block::class);
    }

    // Methods for page actions
    public function createPage()
    {
        // Create page logic
    }

    public function editPage()
    {
        // Edit page logic
    }

    public function deletePage()
    {
        // Delete page logic
    }

    public function savePage()
    {
        // Save page logic
    }

    public function viewPage()
    {
        // View page logic
    }
}
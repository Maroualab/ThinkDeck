<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    protected $primaryKey = 'block_id';
    protected $fillable = ['type', 'content'];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    // Methods for block actions
    public function editBlock()
    {
        // Edit block logic
    }

    public function deleteBlock()
    {
        // Delete block logic
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'status', 'todolist_id'];

    // relations
    public function todolist()
    {
        return $this->belongsTo(Todolist::class);
    }
}

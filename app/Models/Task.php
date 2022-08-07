<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'todolist_id'];

    public static function add(Todolist $todolist, $request )
    {  
        return $todolist->tasks()->create( $request->all() );
    }

    public static function remove(Todolist $todolist, $task )
    {
        return $todolist->tasks()->where('id', $task)->delete();
    }

    // relations
    public function todolist()
    {
        return $this->belongsTo(Todolist::class);
    }
}

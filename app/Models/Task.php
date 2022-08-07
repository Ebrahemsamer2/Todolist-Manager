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

    public static function modify(Todolist $todolist, $task, $request)
    {
        return $todolist->tasks()->where('id', $task)->update([
            'title' => $request->title 
        ]);
    }

    // relations
    public function todolist()
    {
        return $this->belongsTo(Todolist::class);
    }
}

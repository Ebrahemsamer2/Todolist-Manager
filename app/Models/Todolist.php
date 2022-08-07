<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todolist extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'user_id'];

    public static function getUserTodoLists()
    {
        return self::where('user_id', auth()->id())->orderBy('id', 'DESC')->get();
    }

    public static function add($request)
    {
        return self::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $request->user()->id,
        ]);
    }

    public static function modify($request, $id)
    {
        $todolist = self::where('id', $id)->first();
        if( $todolist ) {
            $todolist->update([
                'title' => $request->title,
                'description' => $request->description
            ]);
            return $todolist;
        }
        abort(404, 'Todolist does not exist');
    }

    public static function remove($id) {
        return self::destroy( $id );
    }

    public static function get($id) {
        $todolist = self::where( 'id', $id )->first();
        if( $todolist )
            return $todolist;

        abort(404, 'Todolist does not exist');
    }

    // Relations
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}

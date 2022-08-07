<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todolist extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'user_id'];

    public static function getAll()
    {
        return self::all();
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
        $todolist->update([
            'title' => $request->title,
            'description' => $request->description
        ]);
        return $todolist;
    }

    public static function remove($id) {
        return self::destroy( $id );
    }

    public static function get($id) {
        return self::where( 'id', $id )->first();
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

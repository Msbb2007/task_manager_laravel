<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    public $timestamps = false;
    protected $fillable = ['name','color'];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

}

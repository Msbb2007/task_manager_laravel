<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable=[
        'name',
        'category_id'
        ,'status',
        'priority',
        'due_date'
    ];

    public function users(){
        return $this->belongsToMany(User::class,'task_user');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}

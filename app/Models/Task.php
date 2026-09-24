<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;
    protected $fillable=[
        'title',
        'description',
        'category_id'
        ,'status',
        'priority',
        'due_date'
    ];

    public function users(){
        return $this->belongsToMany(User::class,'task_user')->withPivot('state_of_this_task_user', 'is_hidden')
        ->withTimestamps();
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    protected function casts(): array
    {
        return [
            'due_date' => 'datetime',
        ];
    }

}

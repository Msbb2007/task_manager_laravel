<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{

    use HasFactory, Notifiable, SoftDeletes;

    const ROLE_USER = 'user';
    const ROLE_EDITOR = 'editor';
    const ROLE_ADMIN = 'admin';

    protected $fillable=[
        'name'
        ,'family'
        , 'email'
        , 'password'
        ,'role'
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isEditor(): bool
    {
        return in_array($this->role, [self::ROLE_EDITOR, self::ROLE_ADMIN]);
    }

    public function tasks ()
    {
        return $this->belongsToMany(Task::class, 'task_user')->withPivot('state_of_this_task_user', 'is_hidden')
        ->withTimestamps();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTasks extends Model
{
    use HasFactory;
    protected $fillable = [
       'id',
        'user_id',
        'task_id',

    ];
    public function users()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}

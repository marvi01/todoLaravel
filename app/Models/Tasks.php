<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'title',
        'description',
        'initialDate',
        'expectedFinalDate',
        'finalDate',
        'status',
    ];
    public function userTasks()
    {
        return $this->hasMany(UserTasks::class, 'task_id', 'id');
    }
}

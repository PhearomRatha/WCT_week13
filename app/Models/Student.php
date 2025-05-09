<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['name', 'age'];

    public function teachers()
    {
        return $this->hasMany(Teacher::class);
    }
}

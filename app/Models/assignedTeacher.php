<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class assignedTeacher extends Model
{
    use HasFactory;

    public function teacher()
    {
        return $this->belongsTo(teacher::class,'teacher_id');
    }
}

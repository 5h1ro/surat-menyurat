<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fixing extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'detail',
        'number',
        'to',
        'letter',
        'id_type',
        'id_student',
        'status',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function fixing()
    {
        return $this->belongsTo(Fixing::class, 'id_type');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'id_student');
    }
}

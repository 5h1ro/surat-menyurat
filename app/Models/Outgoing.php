<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outgoing extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'detail',
        'number',
        'to',
        'letter',
        'id_type',
        'id_teacher',
        'id_staff',
        'id_student',
        'status',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function type()
    {
        return $this->belongsTo(OutgoingType::class, 'id_type');
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'id_teacher');
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'id_staff');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'id_student');
    }

    public function scopeSearch($query, $keywords)
    {
        return $query->where('number', 'LIKE', '%' . $keywords . '%');
    }
}

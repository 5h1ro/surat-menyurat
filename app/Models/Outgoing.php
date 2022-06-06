<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outgoing extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'detail',
        'number',
        'to',
        'letter',
        'fk_type',
        'fk_teacher',
        'fk_staff',
        'status',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function type()
    {
        return $this->belongsTo(OutgoingType::class, 'fk_type');
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'fk_teacher');
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'fk_staff');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'fk_student');
    }

    public function scopeSearch($query, $keywords)
    {
        return $query->where('number', 'LIKE', '%' . $keywords . '%');
    }
}

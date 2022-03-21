<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disposition extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_incoming',
        'id_teacher',
        'id_staff',
        'letter',
        'status',
        'information',
        'instruction'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function incoming()
    {
        return $this->belongsTo(Incoming::class, 'id_incoming');
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'id_teacher');
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'id_staff');
    }
}

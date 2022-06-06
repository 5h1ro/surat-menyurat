<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disposition extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'fk_incoming',
        'fk_teacher',
        'fk_staff',
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
        return $this->belongsTo(Incoming::class, 'fk_incoming');
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'fk_teacher');
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'fk_staff');
    }
}

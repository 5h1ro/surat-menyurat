<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $primaryKey = 'nisn';

    public $incrementing = false;

    protected $fillable = [
        'name',
        'birthplace',
        'birthday',
        'class',
        'ni',
        'nisn',
        'fk_user',
        'gender',
        'religion',
        'parent',
        'parent_job',
        'address',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'fk_user');
    }

    public function fixing()
    {
        return $this->hasMany(Fixing::class, 'fk_student');
    }
}

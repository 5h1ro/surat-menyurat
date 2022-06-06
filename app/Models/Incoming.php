<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incoming extends Model
{
    use HasFactory;

    protected $primaryKey = 'number';

    public $incrementing = false;

    protected $fillable = [
        'number',
        'title',
        'letter_number',
        'letter_date',
        'detail',
        'letter',
        'fk_type',
        'fk_admin',
        'fk_headmaster',
        'status',
        'status_teacher'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function type()
    {
        return $this->belongsTo(IncomingType::class, 'fk_type');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'fk_admin');
    }

    public function headmaster()
    {
        return $this->belongsTo(Headmaster::class, 'fk_headmaster');
    }

    public function disposition()
    {
        return $this->hasMany(Disposition::class, 'fk_incoming');
    }
}

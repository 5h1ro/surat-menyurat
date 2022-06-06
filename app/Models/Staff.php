<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $primaryKey = 'nip';

    public $incrementing = false;

    protected $fillable = [
        'nip',
        'name',
        'fk_user',
        'rank',
        'class',
        'fk_type'
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

    public function disposition()
    {
        return $this->hasMany(Disposition::class, 'fk_staff');
    }

    public function outgoing()
    {
        return $this->hasMany(Outgoing::class, 'fk_staff');
    }

    public function type()
    {
        return $this->belongsTo(StaffType::class, 'fk_type');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $fillable = [
        'nip',
        'name',
        'fk_user',
        'status'
    ];

    protected $primaryKey = 'nip';

    public $incrementing = false;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'fk_user');
    }

    public function incoming()
    {
        return $this->hasMany(Incoming::class, 'fk_admin');
    }
}

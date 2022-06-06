<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Headmaster extends Model
{
    use HasFactory;

    protected $primaryKey = 'nip';

    public $incrementing = false;

    protected $fillable = [
        'name',
        'nip',
        'fk_user',
        'rank',
        'class'
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

    public function incoming()
    {
        return $this->hasMany(Incoming::class, 'fk_headmaster');
    }
}

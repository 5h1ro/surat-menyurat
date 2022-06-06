<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Superadmin extends Model
{
    use HasFactory;

    protected $primaryKey = 'nip';

    public $incrementing = false;

    protected $fillable = [
        'name',
        'nip',
        'fk_user',
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
}

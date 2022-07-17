<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Incoming extends Model
{
    use HasFactory;

    protected $primaryKey = 'number';

    public function getNumberEncryptAttribute()
    {

        $data = Crypt::encrypt($this->number);
        return $data;
    }

    public function getNumberMd5Attribute()
    {
        $data = md5($this->number);
        return $data;
    }

    public function getDateAttribute()
    {
        $tanggal = substr($this->created_at, 8, 2);
        $bulan = $this->month(substr($this->created_at, 5, 2));
        $tahun = substr($this->created_at, 0, 4);
        return $tanggal . ' ' . $bulan . ' ' . $tahun;
    }

    public function getLetterDateAttribute($value)
    {
        $tanggal_surat = substr($value, 8, 2);
        $bulan_surat = $this->month(substr($value, 5, 2));
        $tahun_surat = substr($value, 0, 4);
        return $tanggal_surat . ' ' . $bulan_surat . ' ' . $tahun_surat;
    }

    public function getTypeAttribute()
    {
        $data = IncomingType::find($this->fk_type);
        return $data;
    }

    public function getResponsiveIdAttribute()
    {
        return '';
    }

    protected $appends = ['number_encrypt', 'number_md5', 'date', 'type', 'responsive_id'];
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

    public function month($month)
    {
        if ($month == '01') {
            $month = 'Januari';
        } elseif ($month == '02') {
            $month = 'Februari';
        } elseif ($month == '03') {
            $month = 'Maret';
        } elseif ($month == '04') {
            $month = 'April';
        } elseif ($month == '05') {
            $month = 'Mei';
        } elseif ($month == '06') {
            $month = 'Juni';
        } elseif ($month == '07') {
            $month = 'Juli';
        } elseif ($month == '08') {
            $month = 'Agustus';
        } elseif ($month == '09') {
            $month = 'September';
        } elseif ($month == '10') {
            $month = 'Oktober';
        } elseif ($month == '11') {
            $month = 'November';
        } elseif ($month == '12') {
            $month = 'Desember';
        }
        return $month;
    }
}

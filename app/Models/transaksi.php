<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaksi extends Model
{
    use HasFactory;
    protected $table = 'transaksi';
    protected $fillable = [
        'kode_pembelian',
        'date',
        'pegawai_id',
        'hargatotal',
        'paytotal'
    ];

    public function pegawai(){
        return $this->belongsTo(User::class);
    }

}

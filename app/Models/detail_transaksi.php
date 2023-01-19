<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detail_transaksi extends Model
{
    use HasFactory;
    protected $table = 'detail_transaksi';
    protected $fillable = [
            'transaksi_id',
            'barang_id',
            'quantity',
            'subtotal'
    ];
    
    public function barang(){
        return $this->belongsTo(barang::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konsumen extends Model
{
    use HasFactory;

    protected $table = 'konsumen';

    protected $fillable = [
        'kode_konsumen',
        'nama',
        'email',
        'alamat',
        'telephone',
        'foto'
    ];

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_konsumen');
    }
}

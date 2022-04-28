<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';
    protected $fillable = [
        'nama',
        'kode'
    ];

    /**
     * Get all of the gudang for the Barang
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gudang()
    {
        return $this->hasMany(Gudang::class);
    }

    /**
     * Get all of the akomodasi for the Barang
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function akomodasi()
    {
        return $this->hasMany(Akomodasi::class);
    }
}

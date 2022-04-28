<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Status extends Model
{
    use HasFactory;

    protected $table = 'status';
    protected $fillable = [
        'nama'
    ];

    /**
     * Get all of the gudang for the Status
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gudang()
    {
        return $this->hasMany(Gudang::class);
    }

    /**
     * The barang that belong to the Status
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function barang(): BelongsToMany
    {
        return $this->belongsToMany(Barang::class);
    }

    /**
     * Get all of the akomodasi for the Status
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function akomodasi()
    {
        return $this->hasMany(Akomodasi::class);
    }

}

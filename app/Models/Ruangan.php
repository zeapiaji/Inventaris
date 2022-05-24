<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ruangan extends Model
{
    use HasFactory;

    protected $table = 'ruangan';
    protected $fillable = [
        'nama'
    ];
    public $timestamps = false;
    /**
     * Get all of the akomodasi_kelas for the Kelas
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function akomodasi()
    {
        return $this->hasMany(Akomodasi::class);
    }

}

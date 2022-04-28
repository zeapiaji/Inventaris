<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';
    protected $fillable = [
        'nama'
    ];
    public $timestamps = false;
    /**
     * Get all of the akomodasi_kelas for the Kelas
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Akomodasi()
    {
        return $this->hasMany(akomodasi_kelas::class);
    }

}

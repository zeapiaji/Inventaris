<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Akomodasi extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'akomodasi';
    protected $fillable = [
        'total',
        'barang_id',
        'ruangan_id',
        'status_id'
    ];

    /**
     * Get the barang that owns the Akomodasi
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }

    /**
     * Get the status that owns the Akomodasi
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    /**
     * Get the kelas that owns the Akomodasi
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'ruangan_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nave_Piloto extends Model
{
    use HasFactory;
    protected $table = 'nave_piloto';
    protected $primaryKey = ['nave_id', 'piloto_id', 'fecha_asociacion'];
    protected $keyType = ['int','int','string'];
    public $incrementing = false;
    protected $fillable = ['nave_id', 'piloto_id', 'fecha_asociacion', 'fecha_fin_asociacion'];
    protected $hidden = ['created_at', 'updated_at'];

    public function nave()
    {
        return $this->belongsTo(
            Nave::class,
            'nave_id'
        );
    }

    public function piloto()
    {
        return $this->belongsTo(
            Piloto::class,
            'piloto_id'
        );
    }
}

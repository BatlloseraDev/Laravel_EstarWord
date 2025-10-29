<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Piloto extends Model
{
    use HasFactory;
    protected $fillable =['nombre','altura','anio_nacimiento','genero'];
      protected $hidden = ['created_at', 'updated_at'];


    public function naves(){
        return $this->belongsToMany(
            Nave::class,
            'nave_piloto',
            'piloto_id',
            'nave_id'
        );
    }
}

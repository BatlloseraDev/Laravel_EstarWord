<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nave extends Model
{
    use HasFactory;
    protected $fillable =['planeta_id','nombre','modelo','tripulacion','pasajeros','clase_nave'];
      protected $hidden = ['created_at', 'updated_at'];
    public function pilotos(){
        return $this->belongsToMany(
            Piloto::class,
            'nave_piloto',
            'nave_id',
            'piloto_id'
        );
    }

    public function planeta(){
        return $this->belongsTo(
            Planeta::class,
            'planeta_id'
        );
    }

}

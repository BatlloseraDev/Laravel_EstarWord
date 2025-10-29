<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mantenimiento extends Model
{
    use HasFactory;
    protected $fillable =['idnave','fecha','descripcion','coste'];
    protected $hidden = ['created_at', 'updated_at'];

    public function nave(){
        return $this->belongsTo(
            Nave::class,
            'idnave'
        );
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planeta extends Model
{

    use HasFactory;

    protected $fillable =['nombre','periodo_rotacion','poblacion','clima'];
    protected $hidden = ['created_at', 'updated_at'];


}

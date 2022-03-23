<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vaga extends Model
{
    use HasFactory;

    public function donoVaga()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function users()
    {
        return $this->belongsToMany('App\Models\User')->withPivot('status');
    }
}

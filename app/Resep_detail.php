<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resep_detail extends Model
{
    protected $guarded = [];
    public function material() {
        return $this->belongsToMany(Material::class,'name');
    }
}
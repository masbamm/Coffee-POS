<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resep_detail extends Model
{
    protected $guarded = [];
    public function material() {
        return $this->hasOne(Material::class,'id', 'id_material');
    }
}
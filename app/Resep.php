<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resep extends Model
{
    protected $guarded = [];
    protected $primaryKey = 'id';
    public function product()
    {
        return $this->hasMany(Product::class);
    }

    public function resepMat()
    {
        return $this->hasMany(Resep_detail::class, 'id_reseps');
    }
}
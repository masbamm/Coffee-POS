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
}
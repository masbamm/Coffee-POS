<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function resep()
    {
        return $this->belongsTo(Resep::class);
    }

    public function getStatusLabelAttribute()
    {
        if ($this->status == "0") {
            return '<span class="badge badge-secondary"> Tidak Aktif </span>';
        }
        return '<span class="badge badge-success">Aktif</span>';
    }
}
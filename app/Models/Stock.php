<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function varientDataInfo()
    {
        return $this->hasMany(VarientData::class, 'varient_id', 'varient_id');
    }
}

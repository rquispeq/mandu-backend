<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;
    protected $fillable = ['name','colaboradores','division_id','level'];

    public function subdivisions()
    {
        return $this->hasMany(Division::class);
    }

    public function divisionParent()
    {
        return $this->belongsTo(Division::class,'division_id');
    }
}

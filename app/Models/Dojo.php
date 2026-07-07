<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dojo extends Model
{
    /** @use HasFactory<\Database\Factories\DojoFactory> */
    use HasFactory;

    protected $fillable = ['name', 'location', 'description'];

    public function ninjas()
    {
        return $this->hasMany(Ninja::class);
    }    
}

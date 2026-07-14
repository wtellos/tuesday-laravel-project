<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
class Role extends Model
{
    protected $fillable = ['name'];
    
    // Relationship of Role with User model
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}

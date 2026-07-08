<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ninja extends Model
{
    /** @use HasFactory<\Database\Factories\NinjaFactory> */
    use HasFactory;

    protected $fillable = ['name', 'skill', 'bio', 'dojo_id', 'upvotes_count', 'downvotes_count'];

    // Define Ninja relationship with the Dojo model
    public function dojo()
    {
        return $this->belongsTo(Dojo::class);
    }    

    // Define Ninja relationship with the Vote model
    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

    public function upVotes()
    {
        return $this->hasMany(Vote::class)->where('type', 'up');
    }

    public function downVotes()
    {
        return $this->hasMany(Vote::class)->where('type', 'down');
    }    
}

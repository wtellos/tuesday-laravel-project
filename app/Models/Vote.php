<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vote extends Model
{
    // Tip: when you generate the model, you may use the [--migration or -m option]
    // Tip: to determine all of a model's available attributes use [php artisan model:show Vote] 
    // Source: https://laravel.com/docs/13.x/eloquent

    // public $timestamps = false;

    protected $fillable = ['user_id', 'ninja_id', 'type'];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function ninja(): BelongsTo
    {
        return $this->belongsTo(Ninja::class);
    }    

}

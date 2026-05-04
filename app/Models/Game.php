<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = [
        'title',
        'genre',
        'platform',
        'description',
        'image_url',
        'price',
        'stock',
    ];

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }}

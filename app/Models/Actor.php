<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Movie;

class Actor extends Model
{
    protected $fillable = [
        'name'
    ];

    public function rules() {
        return [
            'name' => 'required|unique:actors'
        ];
    }

    public function starryMovies() {
        return $this->belongsToMany(Movie::class, 'casts');
    }
}

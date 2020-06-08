<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Movie;

class Director extends Model
{
    protected $fillable = [
        'name'
    ];

    public function rules() {
        return [
            'name' => 'required|unique:directors'
        ];
    }

    public function movies() {
        return $this->hasMany(Movie::class, 'director_id', 'id');
    }
}

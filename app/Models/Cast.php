<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cast extends Model
{
    protected $fillable = [
        'movie_id',
        'actor_id',
    ];

    public function rules() {
        return [
            'movie_id' => 'required',
            'actor_id' => 'required',
        ];
    }
}

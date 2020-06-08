<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Director;
use App\Models\Actor;

class Movie extends Model
{
    protected $fillable = [
        'name',
        'classification',
        'director_id'
    ];

    public function rules() {
        return [
            'name' => 'required',
            'classification' => 'required'
        ];
    }

    public function director() {
        return $this->belongsTo(Director::class);
    }

    public function movieCast() {
        return $this->belongsToMany(Actor::class, 'casts');
    }
}

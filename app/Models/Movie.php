<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Movie extends Model
{
    /** @use HasFactory<\Database\Factories\MoviesFactory> */
    use HasFactory, HasUuids;

    protected $table = 'Movies';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'title',
        'synopsis',
        'poster',
        'year',
        'available',
        'genre_id'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid(); 
            }
        });
    }

    public function genre()
	{
		return $this->belongsTo(Genre::class, 'genre_id', 'id');
	}

    public function castMovie()
    {
        return $this->hasMany(CastMovie::class, 'movie_id');
    }

    public function review()
	{
		return $this->hasMany(Review::class);
	}
}
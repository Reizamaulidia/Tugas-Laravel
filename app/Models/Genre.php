<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Genre extends Model
{
    /** @use HasFactory<\Database\Factories\GenresFactory> */
    use HasFactory;
    protected $table = 'genres';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'name',
    ];

    protected static function boot()
    {
        parent::boot();

        // Membuat UUID otomatis saat membuat data baru
        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid();
            }
        });
    }

    public function movie()
	{
		return $this->hasMany(Movie::class);
	}
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Profile extends Model
{
    /** @use HasFactory<\Database\Factories\ProfilesFactory> */
    use HasFactory;
    protected $table = 'profiles';

    protected $fillable = [
        'biodata',
        'age',
        'avatar',
        'user_id',
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

    public function user()
	{
		return $this->belongsTo(User::class);
	}
}
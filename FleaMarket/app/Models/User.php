<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function profile()
    {
        return $this->hasOne('App\Model\Profile');
    }

    public function likes()
    {
        return $this->hasMany('App\Models\Like');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    public function items()
    {
        return $this->hasMany('App\Models\Item');
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class, 'user_id');
    }

    public function reviewsDone()
    {
        return $this->hasMany(Evaluation::class, 'evaluator_id');
    }

    public function averageStars()
    {
        $avg = \App\Models\Evaluation::where('user_id', $this->id)->avg('stars');
        return $avg ? round($avg) : null;
    }
}

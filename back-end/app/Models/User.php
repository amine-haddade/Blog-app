<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    // ce fonction retourne l‘identfiant de le user souvent c‘esi le clès primère l‘Id
    public function getJWTIdentifier(){
        return $this->getKey();
    }
    //ajouter les info de user connècter pour ajouter sur le token JWT
    public function getJWTCustomClaims(){
        return [];
    }


    protected $with=['article','comment'];

    public function article(){
        return $this->hasMany(Article::class);
    }

    public function comment(){
        return $this->hasMany(Comment::class);
    }
}

<?php

namespace App;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'updated_at'
    ];

    public function companies()
    {
        return $this->hasMany('App\Company');
    }

    public function getCompanies()
    {
        return $this->companies;
    }

    public function getId(): int
    {
        return (int) $this->getAttribute('id');
    }

    public function orders()
    {
      return $this->hasMany(Order::class, 'user_id', 'id');
    }

    public function products()
    {
      return $this->hasMany(Product::class);
    }

    public function getEmail():string
    {
        return $this->getAttribute('email');
    }

    public function getName(): string
    {
        return $this->getAttribute('name');
    }
}

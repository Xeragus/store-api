<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Location;

class Company extends Model
{
    protected $table = 'companies';

    protected $fillable = ['name', 'address', 'email', 'user_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getId(): int
    {
        return (int) $this->getAttribute('id');
    }

    public function products()
    {
      // this returns a relation
      return $this->hasMany('App\Product');
    }

    public function locations()
    {
        return $this->hasMany('Location');
    }

    public function getProducts()
    {
      // this returns the actual database rows as Product objects
      return $this->products()->get();
    }

    public function getEmail()
    {
        return $this->getAttribute('email');
    }

    public function setEmail(string $email)
    {
        $this->setAttribute('email', $email);
    }

    public function setName(string $name)
    {
        $this->setAttribute('name', $name);
    }

    public function setAddress(string $address)
    {
        $this->setAttribute('address', $address);
    }


}

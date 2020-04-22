<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Location;

class Company extends Model
{
    protected $table = 'companies';

    protected $fillable = ['name', 'address'];

    public function products()
    {
      // this returns a relation
      return $this->hasMany('App\Product');
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

    public function locations()
    {
        return $this->hasMany('Location');
    }
}

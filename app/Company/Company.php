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

    public function setUser(User $user)
    {
        $this->user()->associate($user);
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

    public function type()
    {
        return $this->belongsTo(CompanyType::class, 'type_id', 'id');
    }

    public function setType(CompanyType $type)
    {
        $this->type()->associate($type);
    }

    public function getType(): ?CompanyType
    {
        return $this->type()->get()->first();
    }

    public function deliveryCompany()
    {
        return $this->belongsTo(Company::class, 'delivery_company_id', 'id');
    }

    public function getDeliveryCompany(): ?Company
    {
        return $this->deliveryCompany;
    }

    public function setDeliveryCompany(Company $company)
    {
        $this->deliveryCompany()->associate($company);
    }

    public function deliveringCompanies()
    {
        return $this->hasMany(Company::class,'delivery_company_id', 'id');
    }

    public function getDeliveringCompanies(): array
    {
        $this->deliveringCompanies;
    }
}

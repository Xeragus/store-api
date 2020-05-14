<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyType extends Model
{
    protected $table = 'company_types';

    protected $fillable = ['name', 'code'];

    public function companies()
    {
        return $this->hasMany(Company::class, 'type_id', 'id');
    }

    public function getCompanies(): array
    {
        return $this->companies()->get()->all();
    }

    public function getName(): string
    {
        return $this->getAttribute('name');
    }

    public function setName(string $name)
    {
        $this->setAttribute('name', $name);
    }

    public function getCode(): string
    {
        return $this->getAttribute('code');
    }

    public function setCode(string $code)
    {
        $this->setAttribute('code', $code);
    }
}

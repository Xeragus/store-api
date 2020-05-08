<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table = 'locations';

    protected $fillable = ['address', 'address_number', 'entry', 'company_id'];

    public function getId(): int
    {
        return (int) $this->getAttribute('id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function getCompany(): Company
    {
        return $this->company;
    }

    public function setCompany(Company $company)
    {
        $this->company()->associate($company);
    }

    public function getAddress() : string
    {
        return $this->getAttribute('address');
    }

    public function setAddress(string $address)
    {
        $this->setAttribute('address',$address);
    }

    public function getAddressNumber() : string
    {
        return $this->getAttribute('address_number');
    }

    public function setAddressNumber(string $addressNumber)
    {
        $this->setAttribute('address_number',$addressNumber);
    }

    public function getEntry() : string
    {
        return $this->getAttribute('entry');
    }

    public function setEntry(string $entry)
    {
        $this->setAttribute('entry', $entry);
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'address' => $this->getAddress(),
            'address_number' => $this->getAddressNumber(),
            'entry' => $this->getEntry(),
            'company_id' => $this->getCompany()->getId()
        ];
    }
}

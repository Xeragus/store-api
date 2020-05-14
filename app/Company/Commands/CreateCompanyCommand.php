<?php

namespace App\Company\Commands;

use App\Company;
use App\CompanyType;
use App\Repositories\Contracts\CompanyRepositoryInterface;
use App\User;

class CreateCompanyCommand
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $address;

    /**
     * @var string
     */
    private $email;

    /**
     * @var User
     */
    private $user;

    /**
     * @var CompanyType
     */
    private $type;

    /**
     * @var Company|null
     */
    private $deliveryCompany;

    public function __construct(
        string $name,
        string $address,
        string $email,
        User $user,
        CompanyType $type,
        ?Company $deliveryCompany = null
    ) {
        $this->name = $name;
        $this->address = $address;
        $this->email = $email;
        $this->user = $user;
        $this->type = $type;
        $this->deliveryCompany = $deliveryCompany;
    }

    public function handle(CompanyRepositoryInterface $companyRepository)
    {
        $company = new Company();

        $company->setName($this->name);
        $company->setAddress($this->address);
        $company->setEmail($this->email);
        $company->setUser($this->user);
        $company->setType($this->type);

        if ($this->deliveryCompany) {
            $company->setDeliveryCompany($this->deliveryCompany);
        }

        $companyRepository->store($company);
    }
}

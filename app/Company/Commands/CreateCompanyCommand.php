<?php

namespace App\Company\Commands;

use App\Company;
use App\Repositories\Contracts\CompanyRepositoryInterface;

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

    public function __construct(string $name, string $address, string $email)
    {
        $this->name = $name;
        $this->address = $address;
        $this->email = $email;
    }

    public function handle(CompanyRepositoryInterface $companyRepository)
    {
        $company = new Company();

        $company->setName($this->name);
        $company->setAddress($this->address);
        $company->setEmail($this->email);

        $companyRepository->store($company);
    }
}

<?php


namespace App\Company\Commands;


use App\Company;
use App\Repositories\Contracts\CompanyRepositoryInterface;

class CreateCompanyFromDataCommand
{
    /**
     * @var array
     */
    private $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function handle(CompanyRepositoryInterface $companyRepository)
    {
        $company = new Company();

        $company->setName($this->data['name']);
        $company->setAddress($this->data['address']);
        $company->setEmail($this->data['email']);

        $companyRepository->store($company);
    }
}

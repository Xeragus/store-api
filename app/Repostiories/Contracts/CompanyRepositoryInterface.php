<?php

namespace App\Repositories\Contracts;

use App\Company;
use Illuminate\Http\Request;

interface CompanyRepositoryInterface
{
    public function get(int $id): ?Company;

    public function findOrFail(int $id): Company;

    public function store(Company $company);

    public function all(): array;

    public function delete(Company $company);

//    public function update(int $id, Request $request) : ?Company;
}

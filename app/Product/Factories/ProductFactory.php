<?php

namespace App\Product\Factories;

use App\Company;
use App\Product;

class ProductFactory
{
    public function make(array $data, Company $company)
    {
        $product = new Product();

        $product->setPrice($data['price']);
        $product->setName($data['name']);
        $product->setDescription($data['description']);
        $product->setCompany($company);

        return $product;
    }
}

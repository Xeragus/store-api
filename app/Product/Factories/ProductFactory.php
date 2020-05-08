<?php

namespace App\Product\Factories;

use App\Company;
use App\Product;

class ProductFactory
{
    public function make(array $data, Company $company)
    {
        $product = new Product();

        $product->setPrice($data->get('price'));
        $product->setName($data->get('name'));
        $product->setDescription($data->get('description'));
        $product->setCompany($company);

        return $product;
    }
}

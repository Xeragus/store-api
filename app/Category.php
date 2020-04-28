<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'name',
        'description'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getProduct()
    {
        return $this->product;
    }

    public function setProduct(Product $product)
    {
        $this->product()->associate($product);
    }

    public function getName(): string
    {
        return $this->getAttribute('name');
    }

    public function setName(string $name)
    {
        $this->setAttribute('name', $name);
    }

    public function getDescription(): string
    {
        return $this->getAttribute('description');
    }

    public function setDescription(string $des)
    {
        $this->setAttribute('description', $des);
    }


}

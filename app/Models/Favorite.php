<?php

namespace App\Models;

use Illuminate\Support\Facades\Session;
use App\Models\Admin\Product;

class Favorite
{

    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function put($id)
    {
        $product = $this->product->getToSession($id);
        Session::put("favorite.$id", $product);
        Session::save();
    }

    public function getAll()
    {
        return Session::get('favorite');
    }
}

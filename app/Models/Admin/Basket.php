<?php

namespace App\Models\Admin;

use Illuminate\Support\Facades\Session;

use App\Models\Admin\Product;

class Basket
{

    public function put($id, $count)
    {
        $product = $this->getProduct($id);
        $product['totalCount'] = $count;
        $product['totalPrice'] = $product['price'] * $count;

        Session::put("basket.$id", $product);
        Session::put('basketTotalCount', Session::get('basketTotalCount') + $product['totalCount']);
        Session::put('basketTotalPrice', Session::get('basketTotalPrice') + $product['totalPrice']);
        Session::save();
    }

    private function getProduct($id)
    {
        if (!Session::has("basket.$id")) {
            $product = Product::where('id', $id)
                ->with(['images' => function ($query) {
                    $query->where('avatar', 1)->first();
                }])
                ->select('id', 'name', 'price', 'code')
                ->first()->toArray();
        } else {
            $product = Session::get("basket.$id");
        }
        return $product;
    }
}

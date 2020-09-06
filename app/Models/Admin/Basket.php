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
        $total = $this->getTotal();
        Session::put('basketTotalCount', $total['count']);
        Session::put('basketTotalPrice', $total['price']);
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

    private function getTotal()
    {
        $basket = Session::get('basket');
        $data['count'] = 0;
        $data['price'] = 0;
        foreach ($basket as $value) {
            $data['count'] += $value['totalCount'];
            $data['price'] += $value['totalPrice'];
        }
        return $data;
    }
}

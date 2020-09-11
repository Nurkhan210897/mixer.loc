<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\Basket;
use Illuminate\Support\Facades\Session;

class BasketController extends Controller
{
    private $basketModel;

    public function __construct(Basket $basket)
    {
        $this->basketModel = $basket;
    }
    public function index(Request $request)
    {
        $data['products'] = Session::get('basket');
        $data['totalPrice'] = Session::get('basketTotalPrice');
        return view('basket', $data);
    }

    public function put(Request $request)
    {
        $this->basketModel->put($request->id, $request->count);
        $data['product'] = Session::get("basket.$request->id");
        $data['totalCount'] = Session::get('basketTotalCount');
        $data['totalPrice'] = Session::get('basketTotalPrice');
        $data['success'] = true;
        return response()->json($data);
    }

    public function delete(Request $request)
    {
        $this->basketModel->delete($request->id);
        $data['totalCount'] = Session::get('basketTotalCount');
        $data['totalPrice'] = Session::get('basketTotalPrice');
        $data['success'] = true;
        return response()->json($data);
    }
}

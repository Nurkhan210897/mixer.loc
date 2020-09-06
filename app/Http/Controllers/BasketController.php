<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\Basket;
use Illuminate\Support\Facades\Session;

class BasketController extends Controller
{
    private $basketModel;

    public function __construct()
    {
        $this->basketModel = new Basket();
    }
    public function index(Request $request)
    {
        $data['products'] = Session::get('basket');
        $data['totalPrice'] = Session::get('basketTotalPrice');
        // dd($products);
        return view('basket', $data);
    }

    public function put(Request $request)
    {
        $this->basketModel->put($request->id, $request->count);
        return response()->json(['success' => true, 'total' => Session::get('basketTotalCount')]);
    }
}

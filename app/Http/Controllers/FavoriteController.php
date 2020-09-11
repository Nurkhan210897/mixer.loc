<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FavoriteController extends Controller
{
    private $favorite;

    public function __construct(Favorite $favorite)
    {
        $this->favorite = $favorite;
    }

    public function index()
    {
        $products = $this->favorite->getAll();
        return view('favorite', ['products' => $products]);
    }

    public function put(Request $request)
    {
        $this->favorite->put($request->id);
        $count = count(Session::get('favorite'));
        return response()->json(['success' => true, 'count' => $count]);
    }

    public function clear()
    {
        Session::forget('favorite');
        return response()->json(['success' => true]);
    }
}

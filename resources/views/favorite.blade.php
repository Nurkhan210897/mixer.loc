@extends('layouts.main')
@section('main')
<style>
    .favoriteBlock p {
        color: white;
    }
</style>
<div class="catalog padding-page">
    <div class="container">
        <div class="title-page favorite-title">
            <h2>Мои закладки</h2>
           <div class="favorite-info-header"> 
            @if(session()->has('favorite'))
            <h5 >
                Товаров в закладках: {{count($products)}}
            </h5>
            @endif
            <button id="favoriteClearBtn" type="button" class="btn-cart">Очистить <i class="fas fa-times"></i></button>
           </div>
        </div>
    </div>
</div>
<div class="container">
    @if(session()->has('favorite') AND count(session('favorite'))>0)
    <div class="col-xl-12 favoriteBlock">
        <div class="row">
            @foreach($products as $product)
            <div class="col-xl-4">
                <div class="catalog-card">
                    <a href="/products/{{$product['id']}}">
                        <img src="{{asset('storage/'.$product['images'][0]['path'])}}" alt />
                    </a>
                    <div class="catalog-card-text">
                        <a href="/products/{{$product['id']}}">{{$product['name']}}</a>
                        <span class="silver-text">{{$product['code']}}</span>
                        <br />
                        <p>
                            <span class="blue-text">{{$product['price']}}</span>
                            <span class="silver-text">тг.</span>
                        </p>
                        <div class="button-card">
                            @if(session()->has('basket.'.$product['id']))
                            <button class="btn btn-cart inBasketBtn">
                                В корзине
                                <i class="fas fa-shopping-basket"></i>
                            </button>
                            @else
                            <button class="btn btn-cart addBasketBtn" data-productId='{{$product["id"]}}'>
                                Купить
                                <i class="fas fa-shopping-basket"></i>
                            </button>
                            <button class="btn btn-cart inBasketBtn" data-productId='{{$product["id"]}}' style="display: none;">
                                В корзине
                                <i class="fas fa-shopping-basket"></i>
                            </button>
                            @endif
                            <button class="btn">
                                <i class="fas fa-chart-bar"></i>
                            </button>
                            <button class="btn addFavoriteBtn" data-productId='{{$product["id"]}}'>
                                <i class="fas fa-bookmark"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @else
    <div class="favoriteBlock text-center mb-5">
        <p>У вас нет закладок !</p>
    </div>
    @endif
</div>
</div>
</div>
</div>
</div>
</div>
@endsection
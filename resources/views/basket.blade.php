@extends('layouts.main') @section('main')
<div class="basket padding-page">
    <div class="container">
        <div class="title-page">
            <div class="col-xl-8 col-5">
                <h1>Моя корзина</h1>
            </div>
            <a href="#">
                вернуться назад
                <i class="fas fa-chevron-right"></i>
            </a>
        </div>
        @if(!empty($products))
        <div class="basket-wrapper">
            @foreach($products as $product)
            <div class="basket-content" data-productId="{{$product['id']}}">
                <div class="basket-content-left">
                    <div class="basket-img">
                        <img src="{{asset('storage/'.$product['images'][0]['path'])}}" alt="">
                    </div>
                    <div class="basket-deskr">
                        <p class="small">АРТИКУЛ: <span>{{$product['code']}}</span></p>
                        <p>{{$product['name']}}</p>
                        <p><span>{{$product['price']}}</span> тг</p>
                    </div>
                </div>
                <div class="basket-right">
                    <div class="count">
                        <span><i class="fas fa-minus" data-productId="{{$product['id']}}"></i></span>

                        <span class="quantity">
                            <input type="text" value="{{$product['totalCount']}}" data-productId="{{$product['id']}}">
                        </span>
                        <span><i class="fas fa-plus" data-productId="{{$product['id']}}"></i></span>
                    </div>
                    <div class="total-sum">
                        <p data-productId="{{$product['id']}}">{{$product['totalPrice']}} тг</p>
                        <span class="delete"><i class="fas fa-times" data-productId="{{$product['id']}}"></i></span>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="total-last-sum">
                <button class="btn btn-cart">Оформить заказ <i class="fas fa-shopping-basket"></i></button>
                <div class="total-price">
                    <span>
                        ИТОГО:
                    </span>
                    <span class="blue-text" id='basketTotalPrice'>{{$totalPrice}} </span>
                    <span>ТГ.</span>
                </div>
            </div>
        </div>
        @else
        <p style="color:white;text-align:center">Корзина пуста!</p>
        @endif
        <p style="color:white;text-align:center;display:none" id='emptyBasket'>Корзина пуста!</p>
    </div>

</div>
@endsection
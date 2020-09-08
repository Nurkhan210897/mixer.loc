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
            <div class="basket-content">
                <div class="basket-content-left">
                    <div class="basket-img">
                        <img src="/storage/images/1.jpg" alt="">
                    </div>
                    <div class="basket-deskr">
                        <p class="small">АРТИКУЛ: <span>G1007-50</span></p>
                        <p>Смеситель для раковины G1007-50</p>
                        <p ><span>8795</span> тг</p>
                    </div>
                </div>
                <div class="basket-right">
                    <div class="count">
                        <span><i class="fas fa-minus"></i></span>

                        <span class="quantity">
                            <input type="text" value="1">
                        </span>
                        <span><i class="fas fa-plus"></i></span>
                    </div>
                    <div class="total-sum">
                        <p>8795 тг</p>
                        <span class="delete"><i class="fas fa-times"></i></span>
                    </div>
                </div>
            </div>
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
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
        <div class="basket-content">
            <div class="p-5 table-responsive table-responsive-md">
                <table class="table ">
                    <thead class="table-head">
                        <tr>
                            <th scope="col">
                                ФОТО </th>
                            <th scope="col">НАИМЕНОВАНИЕ</th>
                            <th scope="col"> АРТИКУЛ</th>
                            <th scope="col"> ЦЕНА, ТГ.</th>
                            <th scope="col" class="text-center">КОЛ-ВО</th>
                            <th scope="col">ЦЕНА, ТГ.</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                        <tr>
                            <th scope="row"><img src="{{asset('storage/'.$product['images'][0]['path'])}}" alt /></th>
                            <td class="td-1"><a href="#">{{$product['name']}}</a></td>
                            <td>{{$product['code']}}</td>
                            <td class="text-center price">{{$product['price']}}</td>
                            <td class="text-center">
                                <div class="count">
                                    <span><i class="fas fa-plus" data-productId="{{$product['id']}}"></i></span>
                                    <span class="quantity">
                                        <input type="text" value="{{$product['totalCount']}}" data-productId="{{$product['id']}}">
                                    </span>
                                    <span><i class="fas fa-minus" data-productId="{{$product['id']}}"></i></span>
                                </div>
                            </td>
                            <td class="text-center last-price" data-productId="{{$product['id']}}">{{$product['totalPrice']}}</td>
                            <td class="del"><i class="fas fa-times"></i></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="total-sum">
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
    </div>

</div>
@endsection
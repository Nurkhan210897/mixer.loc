@extends('layouts.main')
@section('main')
<div class="catalog padding-page">
    <div class="container">
        <div class="title-page">
            <h2>{{$category->name}}</h2>
            <a href="/">
                вернуться назад
                <i class="fas fa-chevron-right"></i>
            </a>
        </div>

        <div class="page-category">
            <div>
                <p>
                    НАЙДЕНО ТОВАРОВ:
                    @if(empty($_GET['directory']))
                    <span>{{$products->total() }}</span>
                    @else
                    <span>{{$pageInfo['productCount']}}</span>
                    @endif
                </p>
            </div>
            <div class="category">
                <p>СОРТИРОВАТЬ ПО:</p>
                <select name='sort'>
                    @if(!empty($_GET['sort']) AND $_GET['sort']=='DESC')
                    <option value='DESC'>Цене, сначала дорогие</option>
                    <option value='ASC'>Цене, сначала недорогие</option>
                    @else
                    <option value='ASC'>Цене, сначала недорогие</option>
                    <option value='DESC'>Цене, сначала дорогие</option>
                    @endif
                </select>
            </div>
        </div>
        <div class="catalog-content">
            <div class="row">
                <div class="col-xl-3">
                    <div class="category-left">
                        <p class="title-category" style="border-bottom: none;">ВЫ ВЫБРАЛИ :</p>
                        <div class="check-category">
                            <i class="fas fa-times"></i>
                            <a href="#">{{$category->name}}</a>
                        </div>
                        <p class="title-category">ВЫБЕРИТЕ </br>ПОДКАТЕГОРИЮ :</p>
                        <ul>
                            @foreach($subCategories as $subCategory)
                            <li>
                                <a href="/sub-categories/{{$subCategory->id}}">
                                    {{$subCategory->name}}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                        @if(!empty($_GET['sort']))
                        <input type="text" name='sort' value="{{$_GET['sort']}}" hidden />
                        @endif
                        <input type="number" name='page' value="1" hidden />
                    </div>
                </div>
                <div class="col-xl-9">
                    <div class="row">
                        @foreach($products as $product)
                        <div class="col-xl-4">
                            <div class="catalog-card">
                                <a href="/products/{{$product->id}}">
                                    <img src="{{asset('storage/'.$product->images[0]->path)}}" alt />
                                </a>
                                <div class="catalog-card-text">
                                    <a href="/products/{{$product->id}}">{{$product->name}}</a>
                                    <span class="silver-text">{{$product->code}}</span>
                                    <br />
                                    <p>
                                        <span class="blue-text">{{$product->price}}</span>
                                        <span class="silver-text">тг.</span>
                                    </p>
                                    <div class="button-card">
                                        @if(session()->has('basket.'.$product->id))
                                        <button class="btn btn-cart inBasketBtn">
                                            В корзине
                                            <i class="fas fa-shopping-basket"></i>
                                        </button>
                                        @else
                                        <button class="btn btn-cart addBasketBtn" data-productId='{{$product->id}}'>
                                            Купить
                                            <i class="fas fa-shopping-basket"></i>
                                        </button>
                                        <button class="btn btn-cart inBasketBtn" data-productId='{{$product->id}}' style="display: none;">
                                            В корзине
                                            <i class="fas fa-shopping-basket"></i>
                                        </button>
                                        @endif
                                        <button class="btn">
                                            <i class="fas fa-chart-bar"></i>
                                        </button>
                                        <button class="btn">
                                            <i class="fas fa-bookmark"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @if($products->hasPages())
                        <div class="col-xl-12">
                            <div class="paginate" style="margin-top:20px;">
                                {{$products->withQueryString()->links()}}
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
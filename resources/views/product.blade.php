@extends('layouts.main')
@section('main')
<div class="product-page padding-page">
    <div class="container">
        <div class="title-page">
            <div class="col-xl-8 col-xl-5">
                <h1>{{$product->name}}</h1>
            </div>
            <a href="#">
                вернуться назад
                <i class="fas fa-chevron-right"></i>
            </a>
        </div>
    </div>
    <div class="product-page-main">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-3">
                    <div class="product-page-left">
                        <ul>
                            <li class="left-content">
                                <a href="#">
                                    <i class="fas fa-truck"></i>
                                    <div>
                                        <p class="silver-text">Срок доставки:</p>
                                        <p> 1-2 рабочих дня</p>
                                    </div>
                                </a>
                            </li>
                        </ul>
                        <ul class="left-bottom">
                            <li class="green-tooltip">Бесплатная доставка *
                                <div class="tooltip-block">
                                    <p>Бесплатная доставка</p>
                                    <span>Доставим быстро и в срок!</span>
                                </div>
                            </li>
                            <li class="yellow-tooltip">Официальная гарантия
                                <div class="tooltip-block">
                                    <p>Официальная гарантия</p>
                                    <span>Тестовая запись</span>
                                </div>
                            </li>
                            <li class="red-tooltip">Официальная гарантия
                                <div class="tooltip-block">
                                    <p>Официальная гарантия</p>
                                    <span>Тестовая запись</span>
                                </div>
                            </li>
                            <li class="blue-tooltip">Официальная гарантия
                                <div class="tooltip-block">
                                    <p>Официальная гарантия</p>
                                    <span>Тестовая запись</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="product-page-center">
                        <div class="photo-gallery">
                            <img src="{{asset('storage/'.$product->images[0]->path)}}" alt="">
                        </div>
                        <div class="photo-gallery-bottom">
                            <ul>
                                @foreach($product->images as $key=>$image)
                                @if($key>0)
                                <li>
                                    <img src="{{asset('storage/'.$image->path)}}" alt="">
                                </li>
                                @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3">
                    <div class="product-page-right">
                        <span class="silver-text">Код товара: <span class="blue-text">00493</span></span>
                        <div class="price">
                            <p>
                                <span class="blue-text">{{$product->price}}</span>
                                <span class="silver-text">тг.</span>
                            </p>
                        </div>
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
                                К сравнению
                                <i class="fas fa-chart-bar"></i>
                            </button>
                            <button class="btn addFavoriteBtn" data-productId='{{$product->id}}'>
                                В закладки
                                <i class="fas fa-bookmark"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6">
                    <div class="specifications">
                        <div class="form-title mt-0">
                            <h3>ТЕХНИЧЕСКИЕ ХАРАКТЕРИСТИКИ</h3>
                        </div>
                        <div class="specifications-content">
                            <ul>
                                @foreach($product->directories as $directory)
                                <li>
                                    <div>
                                        <p class="silver-text">{{$directory->directoryTypes->name}}:</p>
                                    </div>
                                    <span>{{$directory->name}}</span>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="contact-form">
                        <div class="form-title mt-0">
                            <h3>Задать вопрос</h3>
                            <a href="#">
                                СВЕРНУТЬ
                                <i class="fas fa-chevron-down"></i>
                            </a>
                        </div>
                        <form id='questionForm'>
                            <div class="input-form">
                                <label for>
                                    ПОЛНОЕ ИМЯ:
                                    <span>*</span>
                                </label>
                                <input type="text" name='name' required />
                            </div>
                            <div class="input-form">
                                <label for>
                                    E-MAIL:
                                    <span>*</span>
                                </label>
                                <input type="text" name='email' required />
                            </div>
                            <div class="input-form">
                                <label for>ТЕКСТ ВОПРОСА:</label>
                                <textarea name='question' id cols="30" rows="5" required></textarea>
                            </div>
                            <div id='errors'>

                            </div>
                            <div class="button-card">
                                <button type="submit" class="btn btn-submit" id='questionBtn'>ОТПРАВИТЬ
                                    <i class="fas fa-chevron-right"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="title-block">
            <h3>ДРУГИЕ ТОВАРЫ ЭТОЙ КОЛЛЕКЦИИ:</h3>
            <a href="/sub-categories/{{$product->sub_category_id}}">
                ПЕРЕЙТИ В КОЛЛЕКЦИ
                <i class="fas fa-chevron-right"></i>
            </a>
        </div>
        <div class="row">
            @foreach($subCategoryProducts as $subProduct)
            @if($subProduct->id!=$product->id)
            <div class="col-xl-3 col-md-6 col-lg-4">
                <div class="catalog-card">
                    <a href="/products/{{$subProduct->id}}">
                        <img src="{{asset('storage/'.$subProduct->image)}}" alt />
                    </a>
                    <div class="catalog-card-text">
                        <a href="/products/{{$subProduct->id}}">{{$subProduct->name}}</a>
                        <br />
                        <p>
                            <span class="blue-text">{{$subProduct->price}}</span>
                            <span class="silver-text">тг.</span>
                        </p>
                        <div class="button-card">
                            @if(session()->has('basket.'.$subProduct->id))
                            <button class="btn btn-cart inBasketBtn">
                                В корзине
                                <i class="fas fa-shopping-basket"></i>
                            </button>
                            @else
                            <button class="btn btn-cart addBasketBtn" data-productId='{{$subProduct->id}}'>
                                Купить
                                <i class="fas fa-shopping-basket"></i>
                            </button>
                            <button class="btn btn-cart inBasketBtn" data-productId='{{$subProduct->id}}' style="display: none;">
                                В корзине
                                <i class="fas fa-shopping-basket"></i>
                            </button>
                            @endif
                            <button class="btn">
                                <i class="fas fa-chart-bar"></i>
                            </button>
                            <button class="btn addFavoriteBtn" data-productId='{{$subProduct->id}}'>
                                <i class="fas fa-bookmark"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
        </div>
    </div>

</div>
@endsection
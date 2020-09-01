@extends('layouts.main')
@section('main')
<div>
    <div class="main">

        <div class="container">
            <div class="main-bg">
                <div class="main-slider">
                    <div class="slider-item">
                        <div style="background-image: url(./assets/images/main-slider-1.jpg);">
                            <div class="col-xl-6 slider-content">
                                <p>
                                    <span class="blue-text">
                                        СМЕСИТЕЛИ
                                        <br />GAPPO:
                                    </span>
                                    <br />ПЕРЕДОВЫЕ
                                    <br />ТЕХНОЛОГИИ
                                    <br />ИЗ ГЕРМАНИИ
                                </p>
                                <br />
                                <a href="#">
                                    Узнать больше о GAPPO
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="slider-item">
                        <div class="col-xl-6 slider-content">
                            <p>
                                <span class="blue-text">
                                    САНТЕХНИКА
                                    <br />GAPPO:
                                </span>
                                <br />НАСТОЯЩЕЕ
                                <br />НЕМЕЦКОЕ
                                <br />КАЧЕСТВО
                            </p>
                            <br />
                            <a href="#">
                                Узнать больше о GAPPO
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row m-0">
                    <div class="col-xl-2 info-main">
                        <a href="#">
                            <i class="fas fa-microphone-slash"></i>
                            <p>
                                Бесшумные
                                <br />технологии
                            </p>
                        </a>
                    </div>
                    <div class="col-xl-2 info-main">
                        <a href="#">
                            <i class="fas fa-globe"></i>
                            <p>
                                Экологические
                                <br />стандарты
                            </p>
                        </a>
                    </div>
                    <div class="col-xl-2 info-main">
                        <a href="#">
                            <i class="fas fa-sun"></i>
                            <p>
                                Зеркальное
                                <br />покрытие
                            </p>
                        </a>
                    </div>
                    <div class="col-xl-2 info-main">
                        <a href="#">
                            <i class="fas fa-sync-alt"></i>
                            <p>
                                Постоянный
                                <br />ток
                            </p>
                        </a>
                    </div>
                    <div class="col-xl-2 info-main">
                        <a href="#">
                            <i class="fas fa-tint"></i>
                            <p>
                                Умный
                                <br />термостат
                            </p>
                        </a>
                    </div>
                    <div class="col-xl-2 info-main">
                        <a href="#">
                            <i class="fas fa-clipboard-check"></i>
                            <p>
                                Надежный
                                <br />картридж
                            </p>
                        </a>
                    </div>
                </div>
            </div>
            @foreach($categories as $category)
            <div class="product-block">
                <div class="title-block">
                    <p>
                        ТОВАРОВ:
                        <span class="blue">{{$category->products_count}}</span>
                    </p>
                    <h1>{{strtoupper($category->name)}}</h1>
                    <a href="#">
                        ВСЕ {{strtoupper($category->name)}}
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </div>
                <div class="product-content">
                    <div class="row m-0">
                        @foreach($category->subCategories as $subCategory)
                        <div class="col-xl-3 p-0">
                            <a href="#" class="product">
                                <img src="{{asset('storage/'.$subCategory->avatar)}}" alt />
                                <div class="product-text">
                                    <p>
                                        {{$subCategory->name}}
                                    </p>
                                    <i class="fas fa-chevron-down blue-text"></i>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                    <div class="product-bottom">
                        <div class="row m-0">
                            <div class="product-popular">
                                <p>ПОПУЛЯРНЫЕ КОЛЛЕКЦИИ</p>
                                <a href="#">
                                    БОЛЬШЕ
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            </div>
                            @foreach($category->products as $product)
                            <div class="product-bottom-content">
                                <img src="{{asset('storage/'.$product->images[0]->path)}}" alt />
                                <div class="product-bottom-text">
                                    <a href="#">
                                        <span class="white-text">{{$product->name}}</span>
                                        <span class="silver-text">Серия</span>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                            <div class="product-last">
                                <a href="#">
                                    <i class="fas fa-arrow-up"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</div>
@endsection
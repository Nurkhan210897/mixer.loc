@extends('layouts.main')
@section('main')
<div class="product-page padding-page">
    <div class="container">
        <div class="title-page">
            <div class="col-xl-8">
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
                            <li>Бесплатная доставка *
                                <div class="tooltip-block">
                                    <p>Бесплатная доставка</p>
                                    <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Id, facilis.</span>
                                </div>
                            </li>
                            <li>Бесплатная доставка *
                                <div class="tooltip-block">
                                    <p>Бесплатная доставка</p>
                                    <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Id, facilis elit. Id, facilis elit. Id, facilis.</span>
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
                            <button class="btn btn-cart main-btn">
                                Купить
                                <i class="fas fa-shopping-basket"></i>
                            </button>
                            <button class="btn">
                                К сравнению
                                <i class="fas fa-chart-bar"></i>
                            </button>
                            <button class="btn">
                                В закладках
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
                        <form action>
                            <div class="input-form">
                                <label for>
                                    ПОЛНОЕ ИМЯ:
                                    <span>*</span>
                                </label>
                                <input type="text" />
                            </div>
                            <div class="input-form">
                                <label for>
                                    E-MAIL:
                                    <span>*</span>
                                </label>
                                <input type="text" />
                            </div>
                            <div class="input-form">
                                <label for>ТЕКСТ ВОПРОСА:</label>
                                <textarea name id cols="30" rows="5"></textarea>
                            </div>
                            <div class="button-card">
                                <button type="submit" class="btn btn-submit">ОТПРАВИТЬ <i class="fas fa-chevron-right"></i></button>
                                <button type="button" class="btn">Очистить <i class="fas fa-times"></i></button>
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
            <a href="#">
                ВСЕ ДУШЕВЫЕ СИСТЕМЫ
                <i class="fas fa-chevron-right"></i>
            </a>
        </div>
        <div class="row">
            <div class="col-xl-3 col-md-6 col-lg-4">
                <div class="catalog-card">
                    <a href="#">
                        <img src="@/assets/images/catalog-bg.jpg" alt />
                    </a>
                    <div class="catalog-card-text">
                        <a href>Напольный смеситель для ванны Gappo G3007-8</a>
                        <span class="silver-text">G202.1.1010.2-1</span>
                        <br />
                        <br />
                        <p>
                            <span class="blue-text">17672</span>
                            <span class="silver-text">РУБ.</span>
                        </p>
                        <div class="button-card">
                            <button class="btn btn-cart">
                                Купить
                                <i class="fas fa-shopping-basket"></i>
                            </button>
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
            <div class="col-xl-3 col-md-6 col-lg-4">
                <div class="catalog-card">
                    <a href="#"><img src="@/assets/images/catalog-bg.jpg" alt /></a>
                    <div class="catalog-card-text">
                        <a href>Напольный смеситель для ванны Gappo G3007-8</a>
                        <span class="silver-text">G202.1.1010.2-1</span>
                        <br />
                        <br />
                        <p>
                            <span class="blue-text">17672</span>
                            <span class="silver-text">РУБ.</span>
                        </p>
                        <div class="button-card">
                            <button class="btn btn-cart">
                                Купить
                                <i class="fas fa-shopping-basket"></i>
                            </button>
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
            <div class="col-xl-3 col-md-6 col-lg-4">
                <div class="catalog-card">
                    <a href="#"><img src="@/assets/images/catalog-bg.jpg" alt /></a>
                    <div class="catalog-card-text">
                        <a href>Напольный смеситель для ванны Gappo G3007-8</a>
                        <span class="silver-text">G202.1.1010.2-1</span>
                        <br />
                        <br />
                        <p>
                            <span class="blue-text">17672</span>
                            <span class="silver-text">РУБ.</span>
                        </p>
                        <div class="button-card">
                            <button class="btn btn-cart">
                                Купить
                                <i class="fas fa-shopping-basket"></i>
                            </button>
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
        </div>
    </div>

</div>
@endsection
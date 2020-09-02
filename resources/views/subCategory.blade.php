@extends('layouts.main')
@section('main')
<div class="catalog padding-page">
    <div class="container">
        <div class="title-page">
            <h2>{{$subCategory->name}}</h2>
            <a href="#">
                вернуться назад
                <i class="fas fa-chevron-right"></i>
            </a>
        </div>

        <div class="page-category">
            <div>
                <p>
                    НАЙДЕНО ТОВАРОВ:
                    <span>{{count($products)}}</span>
                </p>
            </div>
            <div class="category">
                <p>СОРТИРОВАТЬ ПО:</p>
                <select name id>
                    <option value>Цене, сначала дорогие</option>
                    <option value>Цене, сначала недорогие</option>
                </select>
            </div>
            @if(count($products)>24)
            <div class="category">
                <p>ПОКАЗЫВАТЬ:</p>
                <select name id>
                    <option value>24</option>
                    @if(count($products)>48)
                    <option value>48</option>
                    @if(count($products)>96)
                    <option value>56</option>
                    @endif
                    @endif
                </select>
            </div>
            @endif
        </div>
        <div class="catalog-content">
            <div class="row">
                <div class="col-xl-3">
                    <div class="category-left">
                        <p class="title-category">ВЫ ВЫБРАЛИ:</p>
                        <div class="check-category">
                            <i class="fas fa-times"></i>
                            <a href="#">{{$subCategory->name}}</a>
                        </div>
                        @foreach($subCategory->directoryTypes as $directoryType)
                        <p class="title-category">ВЫБЕРИТЕ {{$directoryType->name}}:</p>
                        <ul>
                            @foreach($directoryType->directories as $directory)
                            <li>
                                <input type="checkbox" id="check1">
                                <label for="check1">{{$directory->name}}</label>
                            </li>
                            @endforeach
                        </ul>
                        @endforeach
                    </div>
                </div>
                <div class="col-xl-9">
                    <div class="row">
                        @foreach($products as $product)
                        <div class="col-xl-4">
                            <div class="catalog-card">
                                <a href="#">
                                    <img src="{{asset('storage/'.$product->images[0]->path)}}" alt />
                                </a>
                                <div class="catalog-card-text">
                                    <a href="/products/{{$product->id}}">{{$product->name}}</a>
                                    <br />
                                    <p>
                                        <span class="blue-text">{{$product->price}}</span>
                                        <span class="silver-text">тг.</span>
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
                        @endforeach
                        <div class="col-xl-12">
                            <!-- <a class="show-more" href="#">
                                Показать еще
                                <span class="blue-text">48</span> товаров из
                                <span class="blue-text">51</span>
                            </a> -->
                            <div class="paginate" style="margin-top:20px;">
                                {{$products->links()}}
                                <!-- <a href="#">
                                        ПОСЛЕДНЯЯ
                                        <i class="fas fa-chevron-right"></i>
                                    </a> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
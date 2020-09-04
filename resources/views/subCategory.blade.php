@extends('layouts.main')
@section('main')
<div class="catalog padding-page">
    <div class="container">
        <div class="title-page">
            <h2>{{$subCategory->name}}</h2>
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
                <select name id>
                    <option value>Цене, сначала дорогие</option>
                    <option value>Цене, сначала недорогие</option>
                </select>
            </div>
        </div>
        <form action="/sub-categories/{{$subCategory->id}}" name='subCategoriesFilterForm'>
            <div class="catalog-content">
                <div class="row">
                    <div class="col-xl-3">
                        <div class="category-left">
                            <!-- <p class="title-category">ВЫ ВЫБРАЛИ:</p> -->
                            <p class="title-category">
                                <button class="btn btn-cart">Применить</button>
                            </p>
                            <div class="check-category">
                                <i class="fas fa-times"></i>
                                <a href="#">{{$subCategory->name}}</a>
                            </div>
                            @foreach($pageInfo['directoryTypes'] as $directoryType)
                            <p class="title-category">ВЫБЕРИТЕ {{$directoryType['name']}}:</p>
                            <ul>
                                @foreach($directoryType['directories'] as $directory)
                                <li>
                                    @if(isset($_GET[$directory['name']]))
                                    <input type="checkbox" value="{{$directory['id']}}" checked name="{{$directory['name']}}">
                                    @else
                                    <input type="checkbox" value="{{$directory['id']}}" name="{{$directory['name']}}">
                                    @endif
                                    <label for="check1">{{$directory['name']}}</label>
                                </li>
                                @endforeach
                            </ul>
                            @endforeach
        </form>
    </div>
</div>
<div class="col-xl-9">
    <div class="row">
        @foreach($products as $product)
        <div class="col-xl-4">
            <div class="catalog-card">
                <a href="/products/{{$product->id}}">
                    <img src="{{asset('storage/'.$product->image)}}" alt />
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
            <div class="paginate" style="margin-top:20px;">
                {{$products->links()}}
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
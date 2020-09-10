<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script defer src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.js" integrity="sha512-WNZwVebQjhSxEzwbettGuQgWxbpYdoLf7mH+25A7sfQbbxKeS5SQ9QBf97zOY4nOlwtksgDA/czSTmfj4DUEiQ==" crossorigin="anonymous"></script>
    <script src="/js/main.js" defer></script>
    <link rel=stylesheet href=https://pro.fontawesome.com/releases/v5.10.0/css/all.css integrity=sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p crossorigin=anonymous>
    <link rel=icon href=/favicon.ico> <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" integrity="sha512-17EgCFERpgZKcm0j0fEq1YCJuyAWdz9KUtv1EjVuaOz8pDnh/0nZxmU6BBXwaaxqoi9PQXnRWqlcDB027hgv9A==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="/css/main.css" rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Aibek sait</title>
</head>

<body>
    @section('header')
    <div>
        <div class="header">
            <div class="nav-top">
                <div class="container">
                    <nav>
                        <ul>
                            <li>
                                <a href="/about" target="_blank">О КОМПАНИИ</a>
                            </li>
                            <li>
                                <a href="/delivery" target="_blank">ДОСТАВКА</a>
                            </li>
                            <li>
                                <a href="/payment" target="_blank">ОПЛАТА</a>
                            </li>
                            <li>
                                <a href="/delivery" target="_blank">СОТРУДНИЧЕСТВО</a>
                            </li>
                            <li>
                                <a href="/services" target="_blank">СЕРВИС</a>
                            </li>
                            <li>
                                <a href="/contacts" target="_blank">КОНТАКТЫ</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <div class="nav-bottom">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-2">
                        <div class="logo">
                            <a href="/">
                                <img src="{{asset('storage/images/logo.png')}}" alt style="width: 168px;height:36px" />
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-10 pl-5">
                        <div class="nav-content">
                            <div class="logo-title">
                                <p>Настоящее немецкое качество</p>
                            </div>
                            <div class="nav-right">
                                <div class="phone">
                                    <a href="tel: +7 771 599 99 98">
                                        <i class="fas fa-phone-alt"></i>
                                        <span>+7 771</span> 599 99 98
                                    </a>
                                </div>
                                <div class="icon">
                                    <span>
                                        <a href="#"> <i class="fas fa-chart-bar"></i>
                                            0</a>
                                    </span>
                                    <span>
                                        <a href="#">
                                            <i class="fas fa-bookmark"></i>
                                            0
                                        </a>
                                    </span>
                                    <span class="basket-mobile">
                                        <a href="/basket">
                                            <i class="fas fa-shopping-basket"></i>
                                            @if(session()->has('basketTotalCount'))
                                            <span id='basketTotal'>{{session('basketTotalCount')}}</span>
                                            @else
                                            <span id='basketTotal'>0</span>
                                            @endif
                                        </a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="home-category">
            <div class="container">
                <div class="row">
                    <div class="col-xl-7">
                        <div class="home-left">
                            <span class="blue-text">
                                <a href="/">
                                    <i class="fas fa-home"></i>
                                </a>
                            </span>
                            <ul class="home-left-content">
                                <li>
                                    <a href="#" class="colection-btn">Коллекции</a>
                                </li>
                                <li class="category">
                                    <a href="#" class="colection-btn">
                                        Каталог
                                        <i class="fas fa-chevron-down"></i>
                                    </a>
                                    <ul class="dropdown-main">
                                        @foreach($categories as $category)
                                        <li class="dropdown-link">
                                            <a href="/categories/{{$category->id}}">{{$category->name}}</a>
                                            <ul class="dropdown-children">
                                                @foreach($category->subCategories as $subCategory)
                                                <li>
                                                    <a href="/sub-categories/{{$subCategory->id}}?page=1">{{$subCategory->name}}</a>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                        @endforeach
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-5">
                        <div class="search">
                            <form action="">
                                <input type="text" placeholder="Поиск">
                                <button type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </form>
                            <div class="search-results">
                                <ul id='searchList'>
                                </ul>
                                <div class="button-card" style="display: none;">
                                    <a href="#" type="button" class="btn btn-cart">
                                        Все результаты
                                        <i class="fas fa-chevron-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="burger">
            <span class="burger-lines"></span>
           </div>
            <div class="mobile-header">
              
                   <div class="logo">
                    <a href="/">
                        <img src="{{asset('storage/images/logo.png')}}" alt style="width: 168px;height:36px" />
                    </a>
                </div>
            </div>
           <div class="mobile-menu">
            <ul>
                <li>
                    <a href="/about" target="_blank">О КОМПАНИИ</a>
                </li>
                <li>
                    <a href="/delivery" target="_blank">ДОСТАВКА</a>
                </li>
                <li>
                    <a href="/payment" target="_blank">ОПЛАТА</a>
                </li>
                <li>
                    <a href="/delivery" target="_blank">СОТРУДНИЧЕСТВО</a>
                </li>
                <li>
                    <a href="/services" target="_blank">СЕРВИС</a>
                </li>
                <li>
                    <a href="/contacts" target="_blank">КОНТАКТЫ</a>
                </li>
            </ul>
           </div>
    </div>
    <div class="dropdown-main-mobile">
        <div class="exit">
            <i class="fas fa-times"></i>
        </div>
        <ul class="dropdown-main">
            @foreach($categories as $category)
            <li class="dropdown-link">
                <a data-toggle="collapse" href="#" class="mobile-dropdown-btn">{{$category->name}}<i class="fas fa-chevron-down"></i></a>
                <ul class="dropdown-children" id="collapseExample">
                    @foreach($category->subCategories as $subCategory)
                    <li>
                        <a href="/sub-categories/{{$subCategory->id}}?page=1">{{$subCategory->name}}</a>
                    </li>
                    @endforeach
                </ul>
            </li>
            @endforeach
        </ul>

    </div>
    @show @yield('main') @section('footer')
    <div>
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-xl-3 col-md-6 col-lg-3">
                        <h5>ИДЕИ И ТЕХНОЛОГИИ</h5>
                        <ul>
                            <li>
                                <a href="#">ENJOY DESIGN</a>
                            </li>
                            <li>
                                <a href="#">ПЕРЕДОВОЕ ПРОИЗВОДСТВО</a>
                            </li>
                            <li>
                                <a href="#">СОВРЕМЕННЫЙ ДИЗАЙН</a>
                            </li>
                            <li>
                                <a href="#">ГАРАНТИЯ 5 ЛЕТ</a>
                            </li>
                            <li>
                                <a href="#">НЕМЕЦКОЕ КАЧЕСТВО</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-xl-3 col-md-6 col-lg-3">
                        <h5>КАТАЛОГ ПРОДУКЦИИ</h5>
                        <ul>
                            @foreach($categories as $category)
                            <li>
                                <a href="#">{{$category->name}}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-xl-3 col-md-6 col-lg-3">
                        <h5>ОБЩАЯ ИНФОРМАЦИЯ</h5>
                        <ul>
                            <li>
                                <a href="/about" target="_blank">О КОМПАНИИ</a>
                            </li>
                            <li>
                                <a href="/requisites" target="_blank">РЕКВИЗИТЫ</a>
                            </li>
                            <li>
                                <a href="/delivery" target="_blank">ДОСТАВКА</a>
                            </li>
                            <li>
                                <a href="/payment" target="_blank">ОПЛАТА</a>
                            </li>
                            <li>
                                <a href="/cooperation" target="_blank">СОТРУДНИЧЕСТВО</a>
                            </li>
                            <li>
                                <a href="/services" target="_blank">СЕРВИС</a>
                            </li>
                            <li>
                                <a href="/contacts" target="_blank">КОНТАКТЫ</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-xl-3 col-md-6 col-lg-3">
                        <div class="phone">
                            <a href="tel: +7 495 374 68 54">
                                <i class="fas fa-phone-alt"></i>
                                <span>+7 771</span> 599 99 98
                            </a>
                        </div>
                        <ul>
                            <li>
                                <a href="#">
                                    ЗАПРОСИТЬ ПРАЙС-ЛИСТ
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            </li>
                        </ul>
                        <p class="silver-text">QUALITAT В СОЦСЕТЯХ:</p>
                        <ul class="social">
                            <li>
                                <a href="#">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fab fa-odnoklassniki"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fab fa-vk"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
        <div class="bottom-footer">
            <div class="container">
                <div class="bottom-footer-text" style="justify-content: center;">
                    <div class="bottom-text" style="flex-direction: column;">
                        <div class="logo mb-3">
                            <img src="{{asset('storage/images/logo.png')}}" alt style="width: 168px;height:36px" />
                        </div>
                        <p>© 2020 QUALITAT. ТЕХНОЛОГИИ ЛИДЕРСТВА.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @show
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="/css/main.css" rel='stylesheet'>
    <title>Aibek sait</title>
</head>

<body>
    @section('header')
    <div>
        <div class="header">
            <div class="nav-top">
                <div class="container">
                    <ul>
                        <li>
                            <a href="#">О КОМПАНИИ</a>
                        </li>
                        <li>
                            <a href="#">ДОСТАВКА</a>
                        </li>
                        <li>
                            <a href="#">ОПЛАТА</a>
                        </li>
                        <li>
                            <a href="#">СОТРУДНИЧЕСТВО</a>
                        </li>
                        <li>
                            <a href="#">СЕРВИС</a>
                        </li>
                        <li>
                            <a href="#">КОНТАКТЫ</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="nav-bottom">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-2">
                        <div class="logo">
                            <img src="/storage/main/logo.png" alt />
                        </div>
                    </div>
                    <div class="col-xl-10 pl-5">
                        <div class="nav-content">
                            <div class="logo-title">
                                <p>Настоящее немецкое качество</p>
                            </div>
                            <div class="nav-right">
                                <div class="phone">
                                    <a href="tel: +7 495 374 68 54">
                                        <i class="fas fa-phone-alt"></i>
                                        <span>+7 495</span> 374 68 54
                                    </a>
                                </div>
                                <div class="icon">
                                    <span>
                                        <i class="fas fa-chart-bar"></i>
                                        1
                                    </span>
                                    <span>
                                        <i class="fas fa-bookmark"></i>
                                        0
                                    </span>
                                    <span>
                                        <i class="fas fa-shopping-basket"></i>1
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
                                <a href="#">
                                    <i class="fas fa-home"></i>
                                </a>
                            </span>
                            <ul>
                                <li>
                                    <a href="#" class="colection-btn">Коллекции</a>
                                </li>
                                <li class="category">
                                    <a href="#" class="colection-btn">
                                        Каталог
                                        <i class="fas fa-chevron-down"></i>
                                    </a>
                                    <ul>
                                        <li>
                                            <a href="#">link</a>
                                            <ul v-if="item.linkCategory" v-show="linkCategoryShow">
                                                <li>
                                                    <a href="#">item</a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-5">
                        <form action>
                            <input type="text" placeholder="Поиск" />
                            <button type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @show

    @yield('main')

    @section('footer')
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
                            <li>
                                <a href="#">СМЕСИТЕЛИ</a>
                            </li>
                            <li>
                                <a href="#">ВОДОСНАБЖЕНИЕ</a>
                            </li>
                            <li>
                                <a href="#">ДУШЕВЫЕ УГЛЫ И ОГРАЖДЕНИЯ</a>
                            </li>
                            <li>
                                <a href="#">ДВЕРИ В НИШУ</a>
                            </li>
                            <li>
                                <a href="#">ШТОРКИ ДЛЯ ВАННЫ</a>
                            </li>
                            <li>
                                <a href="#">ДУШЕВЫЕ ПОДДОНЫ</a>
                            </li>
                            <li>
                                <a href="#">КОМПЛЕКТУЮЩИЕ ДЛЯ ДУШЕВЫХ ПОДДОНОВ</a>
                            </li>
                            <li>
                                <a href="#">ДУШЕВЫЕ СИСТЕМЫ</a>
                            </li>
                            <li>
                                <a href="#">АКСЕССУАРЫ</a>
                            </li>
                            <li>
                                <a href="#">РАКОВИНЫ</a>
                            </li>
                            <li>
                                <a href="#">ЗЕРКАЛА</a>
                            </li>
                            <li>
                                <a href="#">ДРЕНАЖНЫЕ КАНАЛЫ</a>
                            </li>
                            <li>
                                <a href="#">КОМПЛЕКТУЮЩИЕ ДЛЯ СМЕСИТЕЛЕЙ</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-xl-3 col-md-6 col-lg-3">
                        <h5>ОБЩАЯ ИНФОРМАЦИЯ</h5>
                        <ul>
                            <li>
                                <a href="#">О КОМПАНИИ</a>
                            </li>
                            <li>
                                <a href="#">РЕКВИЗИТЫ</a>
                            </li>
                            <li>
                                <a href="#">ДОСТАВКА</a>
                            </li>
                            <li>
                                <a href="#">ОПЛАТА</a>
                            </li>
                            <li>
                                <a href="#">СОТРУДНИЧЕСТВО</a>
                            </li>
                            <li>
                                <a href="#">СЕРВИС</a>
                            </li>
                            <li>
                                <a href="#">КОНТАКТЫ</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-xl-3 col-md-6 col-lg-3">
                        <div class="phone">
                            <a href="tel: +7 495 374 68 54">
                                <i class="fas fa-phone-alt"></i>
                                <span>+7 495</span> 374 68 54
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
                        <p class="silver-text">GAPPO В СОЦСЕТЯХ:</p>
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
                <div class="bottom-footer-text">
                    <div class="bottom-text">
                        <div class="logo">
                            <img src="@/assets/images/logo.png" alt />
                        </div>
                        <p>© 2016 GAPPO. ТЕХНОЛОГИИ ЛИДЕРСТВА.</p>
                    </div>
                    <div class="bottom-text">
                        <p>ВСЕ ПРАВА ЗАЩИЩЕНЫ.СОЗДАНИЕ САЙТА: SMARTSOFT</p>
                        <div class="logo">
                            <img src="@/assets/images/logo.png" alt />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @show
</body>

</html>
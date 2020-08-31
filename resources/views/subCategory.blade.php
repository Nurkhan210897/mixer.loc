@extends('layouts.main')
@section('main')
<div class="catalog padding-page">
    <div class="container">
        <div class="title-page">
            <h2>Душевые углы и ограждения</h2>
            <a href="#">
                вернуться назад
                <i class="fas fa-chevron-right"></i>
            </a>
        </div>

        <div class="page-category">
            <div>
                <p>
                    НАЙДЕНО ТОВАРОВ:
                    <span>51</span>
                </p>
            </div>
            <div class="category">
                <p>СОРТИРОВАТЬ ПО:</p>
                <select name id>
                    <option value>Цене, сначала дорогие</option>
                    <option value>Цене, сначала недорогие</option>
                </select>
            </div>
            <div class="category">
                <p>ПОКАЗЫВАТЬ:</p>
                <select name id>
                    <option value>48</option>
                    <option value>42</option>
                    <option value>45</option>
                    <option value>46</option>
                    <option value>47</option>
                </select>
            </div>
        </div>
        <div class="catalog-content">
            <div class="row">
                <div class="col-xl-3">
                    <div class="category-left">
                        <p class="title-category">ВЫ ВЫБРАЛИ:</p>
                        <div class="check-category">
                            <i class="fas fa-times"></i>
                            <a href="#">Душевые углы и ограждения</a>
                        </div>
                        <p class="title-category">ВЫБЕРИТЕ ПОДКАТЕГОРИЮ:</p>
                        <ul>
                            <li>
                                <input type="checkbox" id="check1">
                                <label for="check1">Угловые</label>
                            </li>
                            <li>
                                <input type="checkbox" id="check2">
                                <label for="check2">Угловые</label>
                            </li>
                            <li>
                                <input type="checkbox" id="check3">
                                <label for="check3">Угловые</label>
                            </li>
                        </ul>
                        <br>
                        <p class="title-category">ВЫБЕРИТЕ КОЛЛЕКЦИЮ:</p>
                    </div>
                </div>
                <div class="col-xl-9">
                    <div class="row">
                        <div class="col-xl-4">
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
                        <div class="col-xl-4">
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
                        <div class="col-xl-4">
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
                        <div class="col-xl-12">
                            <a class="show-more" href="#">
                                Показать еще
                                <span class="blue-text">48</span> товаров из
                                <span class="blue-text">51</span>
                            </a>
                            <div class="paginate">
                                <a href="#" class="paginate-link active-link">1</a>
                                <a href="#" class="paginate-link">2</a>
                                <div class="next-page">
                                    <a href="#">
                                        ВПЕРЕД
                                        <i class="fas fa-chevron-right"></i>
                                    </a>
                                    <a href="#">
                                        ПОСЛЕДНЯЯ
                                        <i class="fas fa-chevron-right"></i>
                                    </a>
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
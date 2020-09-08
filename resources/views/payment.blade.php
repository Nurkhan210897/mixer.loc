@extends('layouts.main') @section('main')
<div class="container">
  <div class="about padding-page">
    <div class="title-main mt-0">
      <h1>Оплата</h1>
      <a href="#">
        ВСЕ ДУШЕВЫЕ СИСТЕМЫ
        <i class="fas fa-chevron-right"></i>
      </a>
    </div>
    <div class="about-content">
      <div class="about-bg">
        <img src="{{asset('storage/images/test.jpeg')}}" alt />
      </div>
      <div class="about-text">
        <div class="page-title">
          <h2>
            <span class="white-text">СПОСОБЫ ОПЛАТЫ</span>
            <br />
            <span class="blue-text">НАЛИЧНЫЙ И БЕЗНАЛИЧНЫЙ РАСЧЕТ</span>
          </h2>
        </div>
        <ul>
          <li>
            <p>Стоимость заказа до 3000 рублей - 350 рублей.</p>
          </li>
          <li>
            <p>Стоимость заказа до 3000 рублей - 350 рублей.</p>
          </li>
          <li>
            <p>Стоимость заказа до 3000 рублей - 350 рублей.</p>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>
@endsection
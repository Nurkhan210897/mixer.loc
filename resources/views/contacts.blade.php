@extends('layouts.main') @section('main')
<div class="container">
    <div class="contacts padding-page">
      <div class="title-main mt-0">
        <h1>Контакты</h1>
        <a href="#">
          ВЕРНУТЬСЯ НАЗАД
          <i class="fas fa-chevron-right"></i>
        </a>
      </div>
      <div class="last-product">
        <div class="row">
          <div class="col-xl-8">
            <div class="first-text center-text">
              <h3>
                <span class="white-text">МЫ ВСЕГДА РАДЫ</span>
                <br />
                <span class="blue-text">СОТРУДНИЧЕСТВУ</span>
                <br />
                <span class="dark-blue">С НОВЫМИ ПАРТНЕРАМИ</span>
              </h3>
              <br />

              <ul>
                <li>
                  <p class="silver-text">
                    <b>Консультация и заказ:</b>
                  </p>
                </li>
                <li>
                  <p>Ежедневно - 9:00-21:00</p>
                </li>
                <li>
                  <p>Ежедневно - 9:00-21:00</p>
                </li>
              </ul>
              <ul>
                <li>
                  <p class="silver-text">
                    <b>Офис, склад и выставочный зал:</b>
                  </p>
                </li>
                <li>
                  <p>117649, г. Москва, Северное Чертаново мкр., д.5</p>
                </li>
                <li>
                  <p>Пн.-Пт. - 10:00-19:00, Сб. - 11:00-17:00, Вс. и праздничные дни - выходной.</p>
                </li>
              </ul>
              <ul>
                <li>
                  <p class="silver-text">
                    <b>Отдел по работе с юридическими лицами:</b>
                  </p>
                </li>
                <li>
                  <p>info@gappo-russia.ru</p>
                </li>
                <li>
                  <p>Пн.-Пт. - 10:00-19:00, Сб., Вс. и праздничные дни - выходной.</p>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-xl-4 p-0">
            <div class="last-product-img">
              <img src="@/assets/images/catalog-bg.jpg" alt />
            </div>
          </div>
        </div>
      </div>
      <div class="row">
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




@endsection
@extends('layouts.main') @section('main')
<div class="basket padding-page">
    <div class="container">
        <div class="title-page">
            <div class="col-xl-8 col-5">
                <h1>Моя корзина</h1>
            </div>
            <a href="#">
    вернуться назад
    <i class="fas fa-chevron-right"></i>
   </a>
        </div>
        <div class="basket-content">
            <div class="p-5">
                <table class="table table-responsive table-responsive-md">
                    <thead class="table-head">
                        <tr>
                            <th scope="col">
                                ФОТО </th>
                            <th scope="col">НАИМЕНОВАНИЕ</th>
                            <th scope="col"> АРТИКУЛ</th>
                            <th scope="col"> ЦЕНА, РУБ.</th>
                            <th scope="col" class="text-center">КОЛ-ВО</th>
                            <th scope="col">ЦЕНА, РУБ.</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row"><img src="/storage/images/1.jpg" alt /></th>
                            <td class="td-1"><a href="#">Смеситель для раковины G1007-50</a></td>
                            <td> G1007-50</td>
                            <td class="text-center price">8795</td>
                            <td class="text-center">
                                <div class="count">
                                    <span><i class="fas fa-plus"></i></span>
                                    <span class="quantity"><input type="text"></span>
                                    <span><i class="fas fa-minus"></i></span>
                                </div>
                            </td>
                            <td class="text-center last-price">8795 </td>
                            <td class="del"><i class="fas fa-times"></i></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="total-sum">
                <button class="btn btn-cart">Оформить заказ <i class="fas fa-shopping-basket"></i></button>
                <div class="total-price">
                    <span>
      ИТОГО:
     </span>
                    <span class="blue-text">25604 </span>
                    <span>РУБ.</span>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
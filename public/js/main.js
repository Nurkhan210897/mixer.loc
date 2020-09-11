$(document).ready(function () {
  $(".burger").click(function () {
    console.log("burger");
    $(".burger-lines").toggleClass("burger-active");
    $(".mobile-menu").toggleClass("mobile-menu-active");
  });

  $(".main-slider").slick({
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    dots: true,
  });
  $(".photo-gallery-bottom img").click(function () {
    $(".photo-gallery-bottom img").removeClass("active-img");
    $(this).addClass("active-img");
    let attr = $(this).attr("src");
    $(".photo-gallery img").attr("src", attr);
  });
  $(".mobile-dropdown-btn").click(function (e) {
    e.preventDefault();
    $(".dropdown-children").slideToggle();
  });

  if ($(window).width() <= 576) {
    $(".catalog-show").click(function () {
      $(".dropdown-main-mobile").addClass("dropdown-main-mobile-active");
    });
  }
  $(".exit").click(function () {
    $(".dropdown-main-mobile").removeClass("dropdown-main-mobile-active");
  });
  //csrf
  $.ajaxSetup({
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
  });

  //Переключатель дорогие/дешевые
  $('.catalog select[name="sort"]').on("change", function () {
    var url = window.location.href;
    if (url.indexOf("?") === -1) {
      url = url + "?sort=" + $(this).val();
    } else {
      if (url.indexOf("sort") === -1) {
        url = url + "&sort=" + $(this).val();
      } else {
        url = url.replace(/sort=ASC/g, "sort=" + $(this).val());
        url = url.replace(/sort=DESC/g, "sort=" + $(this).val());
      }
    }
    window.location.href = url;
  });

  //форма поиска
  var timer = 0;
  $(".search input").on("keyup", function () {
    var searched = $(this).val();
    $("#searchList").html("");
    $(".search-results .button-card").hide();
    if (searched !== "") {
      clearTimeout(timer);
      search(searched);
    }
    timer = setTimeout(function () {}, 200);
  });

  function search(searched) {
    $.ajax({
      url: "/products/search",
      type: "GET",
      data: {
        searched: searched,
      },
      success(res) {
        if (res.length !== 0) {
          for (var key in res) {
            var product = res[key];
            var name = product.name.replace(
              searched,
              "<span class='blue-text'>" + searched + "</span>"
            );
            $("#searchList").append(
              "<li><a href='/products/" +
                product.id +
                "'>" +
                name +
                "-" +
                product.price +
                "(" +
                product.code +
                ")</a></li>"
            );
          }
          $(".search-results .button-card").show();
        }
      },
    });
  }

  //Добавление в корзину (подкатегории)
  $(".addBasketBtn").on("click", function (event) {
    event.preventDefault();
    var data = {
      id: $(this).attr("data-productId"),
      count: 1,
    };
    addBasket(data);
    $(this).hide();
    $('.inBasketBtn[data-productId="' + data.id + '"]').show();
  });

  function addBasket(data, basketForm = false) {
    $.ajax({
      url: "/basket/put",
      type: "POST",
      async: false,
      data: data,
      success(res) {
        if (res.success) {
          $("#basketTotal").html(res.totalCount);
          if (basketForm) {
            updateBasketForm(res.product);
            $("#basketTotalPrice").html(res.totalPrice);
          }
        }
      },
    });
  }

  $(".inBasketBtn").on("click", function (event) {
    event.preventDefault();
  });

  //Кнопки плюс минус
  $(".count .fa-plus").on("click", function (event) {
    event.preventDefault();
    var productId = $(this).attr("data-productId");
    var count =
      Number($('.count input[data-productId="' + productId + '"]').val()) + 1;
    var data = {
      id: productId,
      count: count,
    };
    addBasket(data, true);
  });

  $(".count .fa-minus").on("click", function (event) {
    event.preventDefault();
    var productId = $(this).attr("data-productId");
    var count =
      Number($('.count input[data-productId="' + productId + '"]').val()) - 1;
    if (count === 0) {
      $('.count input[data-productId="' + productId + '"]').val(1);
    } else {
      var data = {
        id: productId,
        count: count,
      };
      addBasket(data, true);
    }
  });

  function updateBasketForm(product) {
    $('.count input[data-productId="' + product.id + '"]').val(
      product.totalCount
    );
    $('p[data-productId="' + product.id + '"]').html(
      product.totalPrice + " тг"
    );
  }

  //Удаления товара с корзины
  $(".fa-times").on("click", function () {
    var id = $(this).attr("data-productId");
    $.ajax({
      url: "/basket/delete",
      type: "POST",
      data: {
        id: id,
      },
      success(res) {
        if (res.success) {
          if (Number(res.totalCount) == 0) {
            $(".basket-wrapper").hide();
            $("#emptyBasket").show();
          }
          $("#basketTotal").html(res.totalCount);
          $("#basketTotalPrice").html(res.totalPrice);
          $('.basket-content[data-productId="' + id + '"]').remove();
        }
      },
    });
  });

  $("#questionBtn").on("click", function (event) {
    event.preventDefault();
    var data = $("#questionForm").serializeArray();
    $.ajax({
      url: "/question",
      type: "POST",
      data: data,
      success(res) {
        if (res.success) {
          Swal.fire({
            position: "top-end",
            title: "Ваш вопрос успешно отправлен в обработку!",
            showConfirmButton: false,
            timer: 1500,
            height: 50,
            customClass: "swal-height",
          });
        }
      },
      error(res) {
        $("#questionForm #errors").html("");
        var errors = res.responseJSON.errors;
        for (var key in errors) {
          console.log(errors[key]);
          $("#questionForm #errors").append("<p>" + errors[key][0] + "</p>");
        }
      },
    });
  });

  //Кнопка сохранить
  $(".addFavoriteBtn").on("click", function (event) {
    event.preventDefault();
    var id = $(this).attr("data-productId");
    $.ajax({
      url: "/favorite/put",
      type: "POST",
      data: {
        id: id,
      },
      success(res) {
        if (res.success) {
          $("#favoriteTotal").html(res.count);
        }
      },
    });
  });

  $("#favoriteClearBtn").on("click", function (event) {
    event.preventDefault();
    $.ajax({
      url: "/favorite/clear",
      type: "POST",
      success(res) {
        if (res.success) {
          $(".favoriteBlock").html("<p>У вас нет закладок</p>");
          $("#favoriteTotal").html(0);
        }
      },
    });
  });
});

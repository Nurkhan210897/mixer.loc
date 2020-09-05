$(document).ready(function () {
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
});

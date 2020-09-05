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
});

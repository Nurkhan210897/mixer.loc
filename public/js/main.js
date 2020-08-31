$(document).ready(function() {
    $('.main-slider').slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        dots: true
    });
    $('.photo-gallery-bottom img').click(function() {
        $('.photo-gallery-bottom img').removeClass('active-img')
        $(this).addClass('active-img');
        let attr = $(this).attr('src');
        $('.photo-gallery img').attr('src', attr);
    });
})
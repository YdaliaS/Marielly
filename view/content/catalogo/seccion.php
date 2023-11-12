<div class="content_slider-seccion">
    <div class="slider-seccion">
        <div class="slider mySwiper">
            <div class="slider-wrapper">
                <div class="slider-slide">
                    <a href="">
                        <img class="slider_catalogo-img" src="<?php $configC->rutaImage("1.png") ?>" alt="">
                    </a>
                </div>
                <div class="slider-slide">
                    <a href="">
                        <img class="slider_catalogo-img" src="<?php $configC->rutaImage("2.png") ?>" alt="">
                    </a>
                </div>
                <div class="slider-slide">
                    <a href="">
                        <img class="slider_catalogo-img" src="<?php $configC->rutaImage("3.png") ?>" alt="">
                    </a>
                </div>
                <div class="slider-slide">
                    <a href="">
                        <img class="slider_catalogo-img" src="<?php $configC->rutaImage("4.png") ?>" alt="">
                    </a>
                </div>
                <div class="slider-slide">
                    <a href="">
                        <img class="slider_catalogo-img" src="<?php $configC->rutaImage("5.png") ?>" alt="">
                    </a>
                </div>
                <div class="slider-slide">
                    <a href="">
                        <img class="slider_catalogo-img" src="<?php $configC->rutaImage(".png") ?>" alt="">
                    </a>
                </div>
            </div>
            <div class="slider-button-next"></div>
            <div class="slider-button-prev"></div>
            <div class="slider-pagination"></div>
        </div>
    </div>
</div>

<script>
    var swiper = new Slider(".mySwiper", {
        slidesPerView: 3,
        spaceBetween: 30,
        centeredSlides: true,
        loop: true,
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".slider-pagination",
            clickable: true
        },
        navigation: {
            nextEl: ".slider-button-next",
            prevEl: ".slider-button-prev"
        }
    });
</script>
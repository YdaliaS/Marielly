<div class="catalogo_content">
    <div class="slider_book_content">
        <div class="slider mycatalogo">
            <div class="slider-wrapper">

                <?php
                $categorias = ['carteras', 'morrales', 'mochilas', 'bolsos', 'Monederos', 'Bandoleros', 'Billeteras'];

                // $categorias = $gestion->ListarCategorias();

                // var_dump($categorias);
                foreach ($categorias as $categoria) {
                    $jsonDataCategoria = $gestion->DatosCategoria($categoria);
                    $grupoCategoria = json_decode($jsonDataCategoria);
                    foreach ($grupoCategoria as $grupo) { ?>
                        <div class="slider-slide">
                            <div class="seccion01_content">
                                <?php foreach ($grupo as $producto) { ?>
                                    <div class="seccion01_catalogo" data-producto-id="<?php echo $producto->idproducto; ?>">
                                        <div class="seccion01_info">
                                            <div class="seccion01_info-img">
                                                <img class="img-muestra" src="<?php echo $producto->imagen; ?>" alt="<?php echo $producto->idproducto . '-' . $producto->producto; ?>" border="0" title="<?php echo $producto->descripcion; ?>">
                                            </div>
                                            <div class="seccion_info-text">
                                                <div class="title"><?php echo $producto->producto; ?></div>
                                                <div class="button-container-1">
                                                    <span class="mas">CÓDIGO: <?php echo $producto->idproducto; ?></span>
                                                    <button id="work" type="button" name="Hover">CÓDIGO: <?php echo $producto->idproducto; ?></button>
                                                </div>
                                                <hr>
                                            </div>
                                            <div class="tag-content">
                                                <div class="tag">
                                                    <img src="<?php $configC->rutaImage("svg/tag.svg") ?>" alt="">
                                                    <span>S/<p><?php echo $producto->precio; ?></p></span>
                                                </div>
                                            </div>
                                            <div class="opciones-content">
                                                <div class="opcion puntos" id="description">
                                                    <img src="https://i.ibb.co/2P5sLGD/imagen-2023-11-03-095442600.png" alt="opciones" border="0">
                                                </div>
                                                <div class="opcion add-cart" data-id="<?php echo $producto->idproducto; ?>">
                                                    <img src="https://i.ibb.co/m4tWtVn/imagen-2023-11-03-095659146.png" alt="bolsa" border="0">
                                                </div>
                                                <div class="opcion">
                                                    <img src="https://i.ibb.co/MV3BFn8/imagen-2023-11-03-095734637.png" alt="camara" class="opcion-camara" data-producto-id="<?php echo $producto->idproducto; ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
            <div class="slider-button-next"></div>
            <div class="slider-button-prev"></div>
            <div class="slider-pagination"></div>
        </div>

    </div>
</div>

<div class="container-img">
    <img src="" class="img-show">
    <img src="<?php $configC->rutaImage("svg/close.svg") ?>" alt="" class="img-close">
    <p class="copy"></p>
</div>
<div class="content_modal" id="modal_descripcion" style="display: none;">
    <div class="modal_body">
        <i class="fa-solid fa-circle-xmark" id="close_modal"></i>
        <div class="title">
            <p>Lina</p>
        </div>
        <div class="descripcion">
            <p>Tipo de artículo: Bandolera</p>
        </div>
    </div>
</div>
<script>
    var swiper = new Slider(".mycatalogo", {
        slidesPerView: 1,
        spaceBetween: 30,
        loop: true,
        pagination: {
            el: ".slider-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".slider-button-next",
            prevEl: ".slider-button-prev",
        },
        on: {
            slideChange: function() {
                var activeSlideImages = this.slides[this.activeIndex].querySelectorAll('.img-muestra');

                activeSlideImages.forEach(function(img) {
                    img.classList.add('img-muestra-effect');

                    setTimeout(function() {
                        img.classList.remove('img-muestra-effect');
                    }, 1000);
                });
            }
        }
    });

    // Add a click event listener to the options icon
    $(".opciones-content .puntos").on("click", function() {
        // Get product information
        var productId = $(this).closest(".seccion01_catalogo").data("producto-id");
        var productName = $(this).closest(".seccion01_catalogo").find(".title").text();
        var productDescription = $(this).closest(".seccion01_catalogo").find(".img-muestra").attr("title");

        // Update modal content
        $("#modal_descripcion .title p").text(productName);
        $("#modal_descripcion .descripcion p").text(productDescription);

        // Show the modal
        $("#modal_descripcion").show();
    });

    // Add a click event listener to close the modal
    $("#close_modal").on("click", function() {
        // Hide the modal
        $("#modal_descripcion").hide();
    });
</script>
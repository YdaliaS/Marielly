<?php
$pagina = explode("/", $_GET["views"]);
?>
<header class="header">
    <div class="logo_empresa">
        <div class="titulo">
            <h1>CATÁLOGOS</h1>
        </div>
        <img class="logo" src="<?php $configC->rutaImage("logo3.png") ?>" alt="">
        <div class="nav-bolsa">
            <div class="cantidad-bolsa">
                <p>0</p>
            </div>
            <img class="nav-bolsa-img" src="https://marielly.friendsdevaj.com/view/assets/img/svg/bolsa.svg" alt="bolsa de compras">
            <div class="nav-bolsa-items">
                <div class="nav-triangulo"></div>
                <div class="navb-items" id="cart">
                    <div class="navb-articulos">
                        <p>carrito vacío</p>
                    </div>
                    <div class="navb-productos">

                    </div>
                    <div class="navb-pagar">
                        <div class="navb-pagar-acciones">
                            <div class="navb-pagar-bolsa">
                                <p id="clear-cart">Vaciar bolsa</p>
                            </div>
                            <div class="navb-pagar-bolsa">
                                <p id="comprar">Ir a pagar</p>
                            </div>
                        </div>
                        <div class="navb-pagar-bolsa">
                            <p id="cart-total">S/. 00.00</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</header>
<?php
/**
 * Banners de promociones para Plutonia
 */

function plutonia_renderizar_banner_promo() {
    ?>
    <style type="text/css">
        .info-promo-banner {
            background-color: #f8e4f0 !important; 
            color: #252525 !important;
            padding: 1rem !important;
            border-radius: 12px !important;
            margin-bottom:40px !important;
            text-align: center !important;
            border: 2px solid #262626 !important;
            font-family: 'Unbounded', sans-serif !important;
            font-weight: 700 !important;
            font-size: 0.9rem !important;
            box-shadow: 4px 4px 0px #262626 !important;
        }
    </style>

    <div class="info-promo-banner">
        💳 3 CUOTAS SIN INTERÉS CON MP | 💸 20% OFF CON TRANSFERENCIA DIRECTA
    </div>
    <?php
}

// Banner en la Tienda (arriba de los productos)
add_action( 'woocommerce_before_shop_loop', 'plutonia_renderizar_banner_promo', 10 );

// Banner en el Checkout (arriba del formulario)
add_action( 'woocommerce_before_checkout_form', 'plutonia_renderizar_banner_promo', 5 );
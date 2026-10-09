<?php
/**
 * Hooks personalizados para la tienda de WooCommerce de Plutonia
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/* ==========================================================================
   1. RENDER DEL BANNER DE TIENDA
   ========================================================================== */

function plutonia_render_banner_tienda() {
    if ( is_shop() && ! is_product_category() ) {
        ?>

        <div class="banner-bienvenida-tienda hero-full-width">
                <!-- Imagen de fondo que ocupa todo el ancho -->

                <picture>
                   <source 
                        media="(max-width: 768px)" 
                        srcset="https://backputonia.local/wp-content/uploads/2026/10/pelopinchoMovil.webp">
                    
                    <img 
                        src="https://backputonia.local/wp-content/uploads/2026/10/plutoniaBanner.webp" alt="Ilustración Pelopincho Plutonia" />
                </picture>
               

                <!-- Tarjeta Glassmorphism flotante sobre la imagen -->
                <div class="hero-glass-overlay">
                    <h1 class="banner-titulo">Historia en miniaturas</h1>
                    <p class="banner-texto">
                    Escenas y objetos cotidianos que viajan en el tiempo para rescatar la magia de lo que fuimos y seguimos siendo.
                    </p>
                </div>
            </div>
    
        <?php
    }
}
add_action( 'woocommerce_before_shop_loop', 'plutonia_render_banner_tienda', 5 );


/* ==========================================================================
   2. RENDER DEL CARRITO FLOTANTE
   ========================================================================== */

function plutonia_render_carrito_flotante() {
    // Si no existe WooCommerce o el carrito está vacío en checkout/cart, opcional filtrar
    if ( null === WC()->cart ) {
        return;
    }

    $contador = WC()->cart->get_cart_contents_count();
    ?>
    <div class="plutonia-carrito-flotante ast-site-header-cart" id="plutonia-cart-trigger" title="Ver mi carrito">
        <svg viewBox="0 0 24 24">
            <path d="M19 6h-2c0-2.76-2.24-5-5-5S7 3.24 7 6H5c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2zm-7-3c1.66 0 3 1.34 3 3H9c0-1.66 1.34-3 3-3zm7 17H5V8h14v12z"/>
        </svg>
        <?php if ( $contador > 0 ) : ?>
            <span class="plutonia-contador-flotante"><?php echo esc_html( $contador ); ?></span>
        <?php endif; ?>
    </div>
    <?php
}
add_action( 'wp_footer', 'plutonia_render_carrito_flotante' );
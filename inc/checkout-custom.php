<?php
/**
 * Ajustes personalizados para el Checkout de Plutonia
 */

// 1. Hacer el campo de teléfono obligatorio
add_filter( 'woocommerce_checkout_fields' , 'plutonia_telefono_obligatorio' );
function plutonia_telefono_obligatorio( $fields ) {
    $fields['billing']['billing_phone']['required'] = true;
    return $fields;
}

// 2. Desactivar la opción de envío a dirección diferente
add_filter( 'woocommerce_cart_needs_shipping_address', '__return_false' );
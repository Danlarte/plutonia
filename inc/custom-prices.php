<?php
/**
 * Cálculos personalizados de precios: 3 cuotas sin interés y 20% OFF por Transferencia.
 */

// Evitar el acceso directo al archivo por seguridad
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_filter( 'woocommerce_get_price_html', 'plutonia_mostrar_cuotas_y_descuento_galeria', 100, 2 );

function plutonia_mostrar_cuotas_y_descuento_galeria( $price_html, $product ) {
    // No ejecutar en el panel de administración de WordPress
    if ( is_admin() ) {
        return $price_html;
    }
    
    // Si el producto es variable, dejamos el rango de precios por defecto de WooCommerce
    if ( $product->is_type( 'variable' ) ) {
        return $price_html; 
    }

    // Obtenemos el precio activo (normal o en oferta)
    $precio = $product->get_price();
    
    if ( $precio > 0 ) {
        // 1. Cálculo de Cuotas (Mercado Pago: 3 cuotas sin interés)
        $cuota = $precio / 3;
        $cuota_formateada = wc_price( $cuota );
        
        // 2. Cálculo de Transferencia (20% de descuento)
        $precio_transferencia = $precio * 0.80;
        $transferencia_formateada = wc_price( $precio_transferencia );
        
        // Estructura HTML con estilos en línea
        $detalles_precios = '<div class="precios-personalizados-galeria" style="margin-top: 10px; line-height: 1.4;">';
        $detalles_precios .= '<p class="cuotas-info" style="color: #e67eb2; font-size: 0.88em; margin: 0;"><b>3 cuotas sin interés</b> de ' . $cuota_formateada . '</p>';
        $detalles_precios .= '<p class="transferencia-info" style="color: #444; font-size: 0.88em; margin: 2px 0 0 0;"><b>' . $transferencia_formateada . '</b> pagando con Transferencia <span style="color: #579ac4; font-weight: bold;">(20% OFF)</span></p>';
        $detalles_precios .= '</div>';
        
        // Acoplamos nuestro bloque abajo del precio estándar
        $price_html .= $detalles_precios;
    }

    // Retorno obligatorio del filtro de WooCommerce
    return $price_html;
}
    

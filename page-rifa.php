<?php
/**
 * Template Name: Plantilla Rifa Reactiva
 * Description: Página optimizada a medida para la selección y venta de rifas.
 */

get_header(); ?>

<div id="primary" class="content-area rfa-wrapper-medida">
    <main id="main" class="site-main" role="main">

        <?php
        // ID del producto Rifa (Ponele acá el ID fijo de tu producto de WooCommerce)
        $product_id = 2511; 

        // Forzar carga de estilos específicos de la rifa si los tenés separados
        // Si no, podes meter el CSS directamente en el style.css de tu tema
        $desde = get_post_meta( $product_id, '_rfa_desde', true );
        $hasta = get_post_meta( $product_id, '_rfa_hasta', true );

        if ( $desde !== '' && $hasta !== '' ) :
            // Obtenemos los números ocupados usando la función transaccional de tu plugin
            $numeros_bloqueados = function_exists('rfa_obtener_numeros_ocupados_en_tiempo_real') ? rfa_obtener_numeros_ocupados_en_tiempo_real( $product_id ) : array();
        ?>
            
            <div class="rfa-seccion-rifa">
                <h1 class="rfa-titulo-rifa"><?php the_title(); ?></h1>
                
                <div class="rfa-instrucciones">
                    <p>Seleccioná uno o varios números disponibles de la grilla inferior y hacé click en el botón para proceder al pago.</p>
                </div>

                <!-- Grilla Numérica -->
                <div class="rfa-grilla">
                    <?php 
                    for ( $i = intval($desde); $i <= intval($hasta); $i++ ) {
                        $num_formateado = str_pad( $i, strlen($hasta), '0', STR_PAD_LEFT );
                        $esta_vendido = in_array( $num_formateado, $numeros_bloqueados );
                        
                        if ( $esta_vendido ) {
                            echo "<button type='button' class='rfa-numero rfa-btn-ocupado' disabled>{$num_formateado}</button>";
                        } else {
                            echo "<button type='button' class='rfa-numero rfa-btn-disponible' data-numero='{$num_formateado}'>{$num_formateado}</button>";
                        }
                    }
                    ?>
                </div>

                <!-- Formulario Nativo WooCommerce -->
                <form class="rfa-form-carrito" method="post" action="">
                    <input type="hidden" name="rfa_numeros_seleccionados" id="rfa_numeros_seleccionados" value="">
                    <input type="hidden" name="add-to-cart" value="<?php echo $product_id; ?>">
                    <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                    <input type="hidden" name="quantity" value="1">
                    
                    <?php wp_nonce_field( 'woocommerce-add-to-cart' ); ?>
                    
                    <button type="submit" id="rfa-submit-btn" class="button alt single_add_to_cart_button" disabled>
                        SELECCIONA UNO O MÁS NÚMEROS
                    </button>
                </form>
            </div>

        <?php else : ?>
            <p style="text-align:center; padding: 50px;">El producto de la rifa no está configurado correctamente en el backend.</p>
        <?php endif; ?>

    </main>
</div>

<?php 
// Inyectamos el JS jQuery tolerante directamente acá al final para asegurar 
// que se ejecute después de que todo el DOM esté renderizado al 100%
?>
<script type="text/javascript">
jQuery(document).ready(function($) {
    var seleccionados = [];

    // Delegación directa sobre el documento para anular cualquier bloqueo de plugins estorbosos
    $(document).on('click', '.rfa-btn-disponible', function(e) {
        e.preventDefault();
        e.stopPropagation();

        var $btn = $(this);
        var num = $btn.attr('data-numero');

        if (seleccionados.includes(num)) {
            seleccionados = $.grep(seleccionados, function(n) { return n !== num; });
            $btn.removeClass('rfa-seleccionado');
        } else {
            seleccionados.push(num);
            $btn.addClass('rfa-seleccionado');
        }

        $('#rfa_numeros_seleccionados').val(seleccionados.join(','));

        var $submitBtn = $('#rfa-submit-btn');
        if (seleccionados.length > 0) {
            $submitBtn.prop('disabled', false).removeAttr('disabled');
            var ordenados = [...seleccionados].sort(function(a, b){ return a - b; });
            $submitBtn.text('AGREGAR AL CARRITO: ' + ordenados.join(', '));
        } else {
            $submitBtn.prop('disabled', true).attr('disabled', 'disabled');
            $submitBtn.text('SELECCIONA UNO O MÁS NÚMEROS');
        }
    });
});
</script>

<?php get_header(); ?>

<style type="text/css">
/* Contenedor Principal */
.rfa-wrapper-medida {
    max-width: 1000px;
    margin: 40px auto;
    padding: 10 20px;
}
.rfa-seccion-rifa {
    background: #f9faf2;
    
    border-radius: 12px;
    padding: 40px;
}
/* La Grilla Forzada 10x10 */
div.rfa-grilla {
    display: grid !important;
    grid-template-columns: repeat(10, 1fr) !important; 
    gap: 15px !important; 
    margin: 30px auto !important;
    background-color: #fffefc;
    padding: 25px;
    border-radius: 12px;
    border: 1px solid #262626;
}
/* Cada Casillero Numérico */
div.rfa-grilla button.rfa-numero {
    display: flex !important;
    float: none !important;
    clear: none !important;
    width: 100% !important;
    aspect-ratio: 1 / 1 !important;
    align-items: center !important;
    justify-content: center !important;
    padding: 0 !important;
    margin: 0 !important;
    font-size: 16px;
    font-weight: 600;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.25s ease-in-out;
}
/* Estados de color */
.rfa-numero.rfa-btn-disponible {
    background-color: #fffefc !important;
    color: #111111 !important;
    border: 2px solid #262626 !important;
}
.rfa-numero.rfa-btn-disponible:hover {
    background-color: #111111 !important;
    color: #ffffff !important;
}
.rfa-numero.rfa-btn-disponible.rfa-seleccionado {
    background-color: #000000 !important;
    color: #ffffff !important;
    border-color: #262626 !important;
    transform: scale(1.05);
}
.rfa-numero.rfa-btn-ocupado {
    background-color: #f8e4f0 !important;
    color: #ea5aa5 !important;
    border: 2px solid #262626 !important;
    text-decoration: line-through;
    cursor: not-allowed;
}
/* Botón de Carrito */
.rfa-form-carrito button.single_add_to_cart_button {
    background-color: #262626 !important;
    color: #f9faf2 !important;
    font-size: 16px !important;
    font-weight: 700 !important;
    padding: 16px 40px !important;
    border-radius: 8px !important;
    border: none !important;
}
.rfa-form-carrito button.single_add_to_cart_button:disabled {
    background-color: #f8e4f0 !important;
    color: #262626 !important;
    cursor: not-allowed;
}
@media (max-width: 768px) {
    div.rfa-grilla { grid-template-columns: repeat(10, 1fr) !important; gap: 6px !important; padding: 10px !important; }
    div.rfa-grilla button.rfa-numero { font-size: 11px !important; }
}
</style>

<?php get_footer(); ?>
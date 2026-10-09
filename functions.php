<?php
/**
 * Plutonia Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Plutonia
 * @since 1.0.0
 */

/**
 * Define Constants
 */
define( 'CHILD_THEME_PLUTONIA_VERSION', time() );

/**
 * Deshabilitar fuentes nativas de Astra y Gutenberg
 */
add_filter( 'astra_google_fonts_selected', '__return_empty_array' );

add_action( 'wp_enqueue_scripts', function() {
    wp_dequeue_style( 'astra-google-fonts' );
    wp_dequeue_style( 'wp-block-library' ); 
    wp_dequeue_style( 'global-styles' );
}, 100 );


/* ==========================================================================
   1. RENDER DEL BANNER DE TIENDA
   ========================================================================== */

// Encolar CSS de WooCommerce Plutonia
if ( class_exists( 'WooCommerce' ) ) {
    wp_enqueue_style(
        'plutonia-woocommerce-css',
        get_stylesheet_directory_uri() . '/assets/css/woocommerce/shop.css',
        array('plutonia-theme-css'),
        CHILD_THEME_PLUTONIA_VERSION
    );

    // JS para el activador del carrito flotante
    if ( file_exists( get_stylesheet_directory() . '/assets/js/cart-trigger.js' ) ) {
        wp_enqueue_script(
            'plutonia-cart-trigger',
            get_stylesheet_directory_uri() . '/assets/js/cart-trigger.js',
            array(),
            CHILD_THEME_PLUTONIA_VERSION,
            true
        );
    }
}






require_once get_stylesheet_directory() . '/inc/banners.php';
require_once get_stylesheet_directory() . '/inc/checkout-custom.php';
require_once get_stylesheet_directory() . '/inc/custom-prices.php';
require_once get_stylesheet_directory() . '/inc/woocommerce-hooks.php';










/**
 * Enqueue styles & scripts (Modular Architecture + GSAP)
 */
function child_enqueue_styles() {

    // =====================================================
    // GSAP CORE
    // =====================================================

    wp_enqueue_script(
        'plutonia-gsap',
        'https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js',
        array(),
        '3.12.5',
        false
    );


    // =====================================================
    // GSAP SCROLLTRIGGER
    // =====================================================

    wp_enqueue_script(
        'plutonia-scrolltrigger',
        'https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js',
        array('plutonia-gsap'),
        '3.12.5',
        false
    );


    // =====================================================
    // CSS
    // =====================================================

    wp_enqueue_style(
        'plutonia-theme-css',
        get_stylesheet_directory_uri() . '/style.css',
        array('astra-theme-css'),
        CHILD_THEME_PLUTONIA_VERSION,
        'all'
    );

   

    // =====================================================
    // PINNED PANELS
    // =====================================================

    if ( file_exists( get_stylesheet_directory() . '/assets/js/pinned-panels.js' ) ) {

        wp_enqueue_script(
            'plutonia-pinned-panels',
            get_stylesheet_directory_uri() . '/assets/js/pinned-panels.js',
            array(
                'plutonia-gsap',
                'plutonia-scrolltrigger'
            ),
            CHILD_THEME_PLUTONIA_VERSION,
            true
        );
    }


    // =====================================================
    // SCROLL ZOOM
    // =====================================================

    if ( file_exists( get_stylesheet_directory() . '/assets/js/scroll-zoom.js' ) ) {

        wp_enqueue_script(
            'plutonia-gsap-animations',
            get_stylesheet_directory_uri() . '/assets/js/scroll-zoom.js',
            array(
                'plutonia-gsap',
                'plutonia-scrolltrigger'
            ),
            CHILD_THEME_PLUTONIA_VERSION,
            true
        );
    }


    // =====================================================
    // SPLIT LINES
    // =====================================================

    if ( file_exists( get_stylesheet_directory() . '/assets/js/split-lines.js' ) ) {

        wp_enqueue_script(
            'plutonia-split-text-base',
            get_stylesheet_directory_uri() . '/assets/js/split-lines.js',
            array(),
            CHILD_THEME_PLUTONIA_VERSION,
            true
        );
    }


    // =====================================================
    // HERO
    // =====================================================

    if ( file_exists( get_stylesheet_directory() . '/assets/js/hero.js' ) ) {

        wp_enqueue_script(
            'plutonia-hero-script',
            get_stylesheet_directory_uri() . '/assets/js/hero.js',
            array(
                'plutonia-gsap',
                'plutonia-scrolltrigger'
            ),
            CHILD_THEME_PLUTONIA_VERSION,
            true
        );
    }


    // =====================================================
    // BENTO
    // =====================================================

    if ( file_exists( get_stylesheet_directory() . '/assets/js/bento.js' ) ) {

        wp_enqueue_script(
            'plutonia-bento-gallery',
            get_stylesheet_directory_uri() . '/assets/js/bento.js',
            array(
                'plutonia-gsap',
                'plutonia-scrolltrigger'
            ),
            CHILD_THEME_PLUTONIA_VERSION,
            true
        );
    }


    // =====================================================
    // SCROLL SPLIT TEXT
    // =====================================================

    if ( file_exists( get_stylesheet_directory() . '/assets/js/scroll-splittext.js' ) ) {

        wp_enqueue_script(
            'plutonia-scroll-splittext',
            get_stylesheet_directory_uri() . '/assets/js/scroll-splittext.js',
            array(
                'plutonia-gsap',
                'plutonia-scrolltrigger'
            ),
            CHILD_THEME_PLUTONIA_VERSION,
            true
        );
    }


    // =====================================================
    // HORIZONTAL GALLERY
    // =====================================================

    if ( file_exists( get_stylesheet_directory() . '/assets/js/horizontal-gallery.js' ) ) {

        wp_enqueue_script(
            'horizontal-gallery-script',
            get_stylesheet_directory_uri() . '/assets/js/horizontal-gallery.js',
            array(
                'plutonia-gsap',
                'plutonia-scrolltrigger'
            ),
            CHILD_THEME_PLUTONIA_VERSION,
            true
        );
    }    

}

add_action( 'wp_enqueue_scripts', 'child_enqueue_styles', 15 );






// 1. DESACTIVAR HEADER NATIVO DE ASTRA
add_action('init', function() {
    remove_action('astra_header', 'astra_header_markup');
    remove_action('astra_header', 'astra_header_default_markup');
}, 20);

// 2. INYECTAR CONTENEDOR PARA REACT
add_action('astra_header', function() {
    echo '<div id="plutonia-react-header-root"></div>';
}, 10);

// 3. CONFIGURACIÓN VITE / PRODUCCIÓN
if (!defined('IS_VITE_DEVELOPMENT')) {
    define('IS_VITE_DEVELOPMENT', true);
}

// 4. ENCOLAR SCRIPTS FRONTEND
add_action('wp_enqueue_scripts', function() {
    if (IS_VITE_DEVELOPMENT) {
        wp_enqueue_script('vite-client', 'http://localhost:5173/@vite/client', [], null, false);
        wp_enqueue_script('plutonia-react-header', 'http://localhost:5173/src/main.jsx', ['vite-client'], null, false);
    } else {
        $manifest_path = get_stylesheet_directory() . '/dist/.vite/manifest.json';
        if (file_exists($manifest_path)) {
            $manifest = json_decode(file_get_contents($manifest_path), true);
            if (isset($manifest['src/main.jsx']['file'])) {
                wp_enqueue_script('plutonia-react-header', get_stylesheet_directory_uri() . '/dist/' . $manifest['src/main.jsx']['file'], [], '1.0.0', true);
            }
            if (isset($manifest['src/main.jsx']['css'][0])) {
                wp_enqueue_style('plutonia-react-header-css', get_stylesheet_directory_uri() . '/dist/' . $manifest['src/main.jsx']['css'][0], [], '1.0.0');
            }
        }
    }
});

// 5. SOPORTE TYPE="MODULE" Y REACT PREAMBLE
add_filter('script_loader_tag', function($tag, $handle, $src) {
    if (!IS_VITE_DEVELOPMENT) return $tag;

    if ($handle === 'vite-client') {
        $react_preamble = '
        <script type="module">
          import RefreshRuntime from "http://localhost:5173/@react-refresh"
          RefreshRuntime.injectIntoGlobalHook(window)
          window.$RefreshReg$ = () => {}
          window.$RefreshSig$ = () => (type) => type
          window.__vite_plugin_react_preamble_installed__ = true
        </script>';
        return $react_preamble . "\n" . '<script type="module" src="' . esc_url($src) . '"></script>' . "\n";
    }

    if ($handle === 'plutonia-react-header') {
        return '<script type="module" src="' . esc_url($src) . '"></script>' . "\n";
    }

    return $tag;
}, 10, 3);

// ==========================================
// 6. ENDPOINT REST API PARA DATOS DEL HEADER
// ==========================================
add_action('rest_api_init', function () {
    register_rest_route('plutonia/v1', '/header-data', [
        'methods'  => 'GET',
        'callback' => 'plutonia_get_header_data',
        'permission_callback' => '__return_true',
    ]);
});

function plutonia_get_header_data() {
    $menu_items = [];
    
    // Intentar buscar el menú "Primary"
    $menu_object = wp_get_nav_menu_object('Primary');

    if (!$menu_object) {
        $locations = get_nav_menu_locations();
        if (!empty($locations)) {
            foreach ($locations as $location_slug => $menu_id) {
                if ($menu_id > 0) {
                    $menu_object = wp_get_nav_menu_object($menu_id);
                    if ($menu_object) break;
                }
            }
        }
    }

    if (!$menu_object) {
        $all_menus = wp_get_nav_menus();
        if (!empty($all_menus)) {
            $menu_object = $all_menus[0];
        }
    }

    if ($menu_object) {
        $raw_items = wp_get_nav_menu_items($menu_object->term_id);
        if (is_array($raw_items)) {
            foreach ($raw_items as $item) {
                $menu_items[] = [
                    'id'    => (int) $item->ID,
                    'title' => (string) $item->title,
                    'url'   => (string) $item->url,
                ];
            }
        }
    }

    $cart_count = 0;
    if (class_exists('WooCommerce') && isset(WC()->cart) && WC()->cart) {
        $cart_count = WC()->cart->get_cart_contents_count();
    }

    return rest_ensure_response([
        'menuItems' => $menu_items,
        'logoUrl'   => 'https://backputonia.local/wp-content/uploads/2026/06/LogoPlutonia.webp',
        'cartUrl'   => class_exists('WooCommerce') ? wc_get_cart_url() : '#',
        'cartCount' => $cart_count,
        'homeUrl'   => home_url('/'),
        'siteName'  => get_bloginfo('name'),
    ]);
}

// ==========================================
//  POPUP PAGINA TIENDA ENVIOS
// ==========================================

function plutonia_enqueue_shipping_component() {
    if ( is_shop() && ! is_product_category() ) {
        wp_enqueue_script(
            'plutonia-shipping-card-js',
            get_stylesheet_directory_uri() . '/assets/js/shipping-card-component.js',
            array(),
            '1.0',
            true
        );
    }
}
add_action( 'wp_enqueue_scripts', 'plutonia_enqueue_shipping_component' );

function plutonia_render_shipping_web_component() {
    if ( is_shop() && ! is_product_category() ) {
        echo '<plutonia-shipping-card></plutonia-shipping-card>';
    }
}
add_action( 'wp_footer', 'plutonia_render_shipping_web_component' );
<?php
/**
 * Template Name: Home Plutonia - Astra Full Screen
 */

// 1. Forzar a Astra a limpiar layouts por código
add_filter( 'astra_page_layout', '__return_false' );
add_filter( 'astra_get_content_layout', function() { return 'page-builder'; } );

// 2. BYPASS DE INYECCIÓN DE ESTILOS CRÍTICOS (Garantiza romper el bloque superior)
add_action( 'wp_head', function() {
   
}, 999 ); // Prioridad ultra alta para renderizarse al final de la cabecera

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">

        <section class="plutonia-hero-fullscreen">
    
    <div class="hero-bg-full" style="background-image: url('https://backputonia.local/wp-content/uploads/2026/06/heroPlutonia.webp');"></div>

        <div class="hero-ui-overlay">
            <nav class="vertical-menu-left">
                <a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>" class="v-nav-link">Colección</a>
                <a href="#rayito-banner" class="v-nav-link">Rayito de Tormenta</a>
                <a href="#closing-newsletter" class="v-nav-link">Workshops</a>
            </nav>
        </div>

    <div class="main-title-container">
        <h1 class="hero-title">Plutonia</h1>
        <!-- BOTÓN DE SCROLL ANIMADO CORREGIDO -->
            <a href="#bento-trigger" class="scroll-down-wrapper" aria-label="Desplazarse hacia abajo">
            <span class="scroll-label">desplazarse</span>
            <svg class="scroll-icon" viewBox="0 0 30 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="1.5" y="1.5" width="27" height="45" rx="13.5" stroke="#ffffff" stroke-width="2.5" fill="none" />
                <line class="mouse-wheel" x1="15" y1="10" x2="15" y2="18" stroke="#ffffff" stroke-width="2.5" stroke-linecap="round" />
            </svg>
        </a>
    </div>

        

   </section>

   <section class="spacing">
        <!-- TEXTO LATERAL DERECHO STICKY -->
        <div class="vertical-text-right">
            <span class="vertical-label">Desplázate hacia abajo</span>
            <svg class="vertical-arrow" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 4V20M12 20L18 14M12 20L6 14" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
    <div spacing>

    </div>

   </section>

   <section class="bento-section-trigger">
    <div class="bento-sticky-wrapper">
        <div class="bento-grid-container">
            <div class="bento-grid">
                <div class="bento-item item-1"><img src="https://backputonia.local/wp-content/uploads/2026/07/01-tocador.webp" alt="Nostalgia 1"></div>
                <div class="bento-item item-2"><img src="https://backputonia.local/wp-content/uploads/2026/07/02-pileta.webp" alt="Nostalgia 2"></div>
                <div class="bento-item item-3"><img src="https://backputonia.local/wp-content/uploads/2026/07/04-ollitas.webp" alt="Nostalgia 3"></div>
                <div class="bento-item item-4"><img src="https://backputonia.local/wp-content/uploads/2026/07/04-cocinita.webp" alt="Nostalgia 4"></div>
                <div class="bento-item item-5"><img src="https://backputonia.local/wp-content/uploads/2026/07/05-sonrisas.webp" alt="Nostalgia 5"></div>
                <div class="bento-item item-6"><img src="https://backputonia.local/wp-content/uploads/2026/07/06-dirigible.webp" alt="Nostalgia 6"></div>
                <div class="bento-item item-7"><img src="https://backputonia.local/wp-content/uploads/2026/07/09-vasitos.webp" alt="Nostalgia 7"></div>
                <div class="bento-item item-8"><img src="https://backputonia.local/wp-content/uploads/2026/07/05-galletitas.webp" alt="Nostalgia 8"></div>
                <div class="bento-item item-9"><img src="https://backputonia.local/wp-content/uploads/2026/07/07-globitos.webp" alt="Nostalgia 9"></div>
            </div>
        </div>
     </div>
</section>

<section class="seccion-fullscreen">
        <div class="box-text-container">
         <h2 class="box-text-container-title">Hay cosas que no desaparecen.</h2>
          <p>Un sabor, un objeto, una imagen.</p>
        </div>
</section>



<!-- SECCIÓN GALERÍA DIRECCIONAL FULLSCREEN -->
<div class="gsap-gallery">
    <section class="gsap-panels-wrapper">
        <div class="panel-container">
            <!-- Panel 1: Inicial -->
            <div class="panel panel-1">
                <picture>
                    <source 
                        media="(max-width: 768px)" 
                        srcset="https://backputonia.local/wp-content/uploads/2026/10/argenmilaPlutoniamovil.webp">
                    
                    
                    <img 
                        src="https://backputonia.local/wp-content/uploads/2026/10/plutoniaArgenmila.webp" 
                        alt="Argenmmilas"
                        loading="eager">
                </picture>

            </div>

            <div class="panel panel-2">
                <picture>
                   <source 
                        media="(max-width: 768px)" 
                        srcset="https://backputonia.local/wp-content/uploads/2026/10/salchichasConPurePlutonia.webp">
                    
                    <img 
                        src="https://backputonia.local/wp-content/uploads/2026/10/plutoniaSalchichasConPure.webp" 
                        alt="Salchicas con pure"
                        loading="eager">
                </picture>
            </div>


            <div class="panel panel-3">
                <picture>
                   <source 
                        media="(max-width: 768px)" 
                        srcset="https://backputonia.local/wp-content/uploads/2026/10/guisitosPlutonia.webp">
                    <img 
                        src="https://backputonia.local/wp-content/uploads/2026/10/plutoniaGuisitos.webp" 
                        alt="Plutonia Guisitos"
                        loading="eager">
                </picture>
            </div>


            
            <!-- Panel 4: Entra desde la Derecha -->
            <div class="panel panel-4">
                <picture>
                   <source 
                        media="(max-width: 768px)" 
                        srcset="https://backputonia.local/wp-content/uploads/2026/10/asaditoPlutoniaMovil.webp">
                    <img 
                        src="https://backputonia.local/wp-content/uploads/2026/09/asaditoPlutonia.webp" 
                        alt="tablitas de asado plutonia"
                        loading="eager">
                </picture>
            </div>
           
            
        </div>
    </section>
</div>
            <section class="seccion-fullscreen">
                    <div class="box-text-container">
                    <h2 class="box-text-container-title">Hay recuerdos<br> que tienen sabor.</h2>
                    <p>El olor de una comida, una mesa compartida, aquello que comíamos de chicos.</p>               
            </div>
            </section>

            <section class="parrallax">
                <img src="https://backputonia.local/wp-content/uploads/2026/09/plutoniaPastas.webp" alt="recuerdos">
            </section>

            <section class="seccion-fullscreen">
                    <div class="box-text-container">
                    <h2 class="box-text-container-title">Porque también somos <br>lo que recordamos.</h2>
                    <p class=""> Esas escenas cotidianas que, sin darnos cuenta, terminan formando parte de nuestra identidad.</p>
            </div>
            </section>

            <!-- CONTENEDOR PRINCIPAL DE LA GALERÍA HORIZONTAL -->
                <section class="horizontal-gallery-section">
                    <div class="horizontal-gallery-wrapper">
                        <div class="gallery-strip">
                            
                            <div class="gallery-card">
                                <div class="card-inner">
                                    <img src="https://backputonia.local/wp-content/uploads/2026/09/mafaldas.webp" alt="mafaldas">
                                    <span class="card-caption">Mafaldas</span>
                                </div>
                            </div>

                            <div class="gallery-card">
                                <div class="card-inner">
                                    <img src="https://backputonia.local/wp-content/uploads/2026/09/mantequita.webp" alt="Pan con manteca">
                                    <span class="card-caption">Pan con manteca</span>
                                </div>
                            </div>

                             <div class="gallery-card">
                                <div class="card-inner">
                                    <img src="https://backputonia.local/wp-content/uploads/2026/09/pizzasPlutonia.webp" alt="Pizzas Plutonia">
                                    <span class="card-caption">Pizza Argentina</span>
                                </div>
                            </div>

                            <div class="gallery-card">
                                <div class="card-inner">
                                    <img src="https://backputonia.local/wp-content/uploads/2026/09/pastelitos.webp" alt="Pastelitos patrios">
                                    <span class="card-caption">Pastelitos</span>
                                </div>
                            </div>


                             <div class="gallery-card">
                                <div class="card-inner">
                                    <img src="https://backputonia.local/wp-content/uploads/2026/09/empanadas.webp" alt="Empanadas Plutonia">
                                    <span class="card-caption">Empanadas</span>
                                </div>
                            </div>

                            <div class="gallery-card">
                                <div class="card-inner">
                                    <img src="https://backputonia.local/wp-content/uploads/2026/09/verduritas.webp" alt="Verduritas">
                                    <span class="card-caption">Verduritas</span>
                                </div>
                            </div>
                             <div class="gallery-card">
                                <div class="card-inner">
                                    <img src="https://backputonia.local/wp-content/uploads/2026/09/bolsitasDePan.webp" alt="Bolsitas con pan">
                                    <span class="card-caption">Bolsitas con pan</span>
                                </div>
                            </div>
                             <div class="gallery-card">
                                <div class="card-inner">
                                    <img src="https://backputonia.local/wp-content/uploads/2026/09/serenito.webp" alt="Postres serenitos">
                                    <span class="card-caption">Postres Serenito</span>
                                </div>
                            </div>

                        </div>
                    </div>
                </section>

                <!-- Sección posterior (ejemplo) -->
            
                <section class="seccion-fullscreen-2">
                    <h2 class="box-text-container-title">Plutonia nace de ahí.</h2>
                    <p class="box-text-container">De convertir recuerdos en imágenes,<br> objetos y nuevas historias.</p>
                </section>

                <section class="fruit-roll-section" id="fruit-roll-section">
                    <div class="fruit-roll-track">
                        <img class="roll-item" src="https://backputonia.local/wp-content/uploads/2026/10/caramelitosPlutonia.webp" alt="Caramelitos Plutonia" />
                        <img class="roll-item" src="https://backputonia.local/wp-content/uploads/2026/10/galletitasPlutonia.webp" alt="Galletitas Plutonia" />
                        <img class="roll-item" src="https://backputonia.local/wp-content/uploads/2026/10/damajuanaPlutonia.webp" alt="Damajuana Plutonia" />
                        <img class="roll-item" src="https://backputonia.local/wp-content/uploads/2026/10/GallinitaPlutonia.webp" alt="Gallinita Plutonia" />
                        <img class="roll-item" src="https://backputonia.local/wp-content/uploads/2026/10/pandulcePlutonia.webp" alt="Pan Dulce Plutonia" />
                    </div>
                </section>

             <section class="parrallax">
                <img src="https://backputonia.local/wp-content/uploads/2026/09/cta.webp" alt="recuerdos">
            </section>    
            
            <section class="plutonia-final-section">
                <!-- FRASE MANIFIESTO / NARRATIVA -->

                 <section class="seccion-fullscreen-2">
                    <h2 class="box-text-container-title">Universo en expansión</h2>
                    <p class="box-text-container">La próxima historia<br>puede ser la tuya.</p>
                    
                    
                </section>

                <!-- BENTO GRID DE CONEXIONES -->
                <div class="closing-grid">
                    
                    <!-- CARD 1: COLECCIÓN ACTUAL -->
                    <a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ); ?>" class="closing-card card-coleccion">
                        <div class="card-bg" style="background-image: url('https://backputonia.local/wp-content/uploads/2026/09/logoPlutoniaTiendaArte.svg');"></div>
                        <div class="card-overlay"></div>
                        <div class="card-content">
                            <span class="card-tag">Colección Actual</span>
                            <span class="card-link-text">Explorar piezas →</span>
                        </div>
                    </a>

                    <!-- CARD 2: RAYITO DE TORMENTA -->
                    <a id="rayito-banner" href="https://www.instagram.com/rayitodetormenta/" target="_blank" rel="noopener noreferrer" class="closing-card card-rayito">
                        <div class="card-bg" style="background-image: url('https://backputonia.local/wp-content/uploads/2026/09/rayitoLogoWeb.svg');"></div>
                        <div class="card-overlay"></div>
                        <div class="card-content">
                            <span class="card-tag">Ediciones de Autor</span>
                            <span class="card-link-text">Ver en Instagram →</span>
                        </div>
                    </a>
                   

                </div>
                <!-- CARD 3: NEWSLETTER & TALLERES -->
                    <div id="closing-newsletter" class="closing-card card-talleres">
                        <div class="card-content">
                            <span class="card-tag">Crear también es recordar</span>
                            <h3>Próximo Workshop</h3>
                                <p class="card-ws">Sumate a los encuentros presenciales y online.</p>
                                <p class="card-ws">Deja tu email para recibir un aviso de una nueva edición.</p>
                            <form class="newsletter-form-inline" action="#" method="POST">
                                <input type="email" placeholder="tu-email@ejemplo.com" required>
                                <button type="submit" aria-label="Suscribirse">→</button>
                            </form>
                        </div>
                    </div>
            </div>
            </section>

        

    </main>
</div>



<?php 
get_footer(); ?>


document.addEventListener("DOMContentLoaded", () => {
    
    const titleElement = document.querySelector('.hero-title');
    const menuLinks = document.querySelectorAll('.vertical-menu-left .v-nav-link');

    // Creamos la línea de tiempo única de GSAP para controlar toda la intro
    const tl = gsap.timeline();

    // === PARTE 1: ANIMACIÓN DEL H1 ===
    if (titleElement) {
        const textContent = titleElement.textContent.trim();
        titleElement.innerHTML = textContent
            .split('')
            .map(char => char === ' ' ? '&nbsp;' : `<span class="char">${char}</span>`)
            .join('');

        const letters = titleElement.querySelectorAll('.char');

        // Volvemos visible el contenedor del H1 justo cuando arranca
        tl.set(titleElement, { opacity: 1 }); 
        
        // Animamos las letras del título
        tl.from(letters, {
            opacity: 0,
            y: 80,
            rotateX: -70,
            scale: 0.6,
            duration: 1.6,
            stagger: 0.06,
            ease: "power4.out",
            transformOrigin: "50% 50% -50"
        });
    }

    // === PARTE 2: ANIMACIÓN DEL MENÚ LATERAL ===
    // === PARTE 2: ANIMACIÓN DEL MENÚ LATERAL (REPARADA) ===
    if (menuLinks.length > 0) {
        // Usamos fromTo para declarar explícitamente el estado Inicial y el Final
        tl.fromTo(menuLinks, 
            { 
                opacity: 0, 
                x: -30 
            }, // ---> ESTADO INICIAL
            { 
                opacity: 1, 
                x: 0, 
                duration: 1.2,
                stagger: 0.12,
                ease: "power3.out"
            }, // ---> ESTADO FINAL (Fuerza el opacity 1)
            "-=1.0" // El overlap con el H1 se mantiene intacto
        ); 
    }
});
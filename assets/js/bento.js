if (typeof gsap !== "undefined" && typeof ScrollTrigger !== "undefined") {
    gsap.registerPlugin(ScrollTrigger);
}

document.addEventListener("DOMContentLoaded", () => {
    const bentoTrigger = document.querySelector('.bento-section-trigger');
    const cocinita = document.querySelector('.item-4');

    if (bentoTrigger && cocinita) {
        
        const bentoTl = gsap.timeline({
            scrollTrigger: {
                trigger: bentoTrigger,
                start: "top top",
                end: "+=100%",           // Finaliza exactamente a 1 pantalla de distancia
                scrub: 0.5,             // Sincronización más rápida sin retardo visual
                pin: true,
                pinSpacing: false,      // CLAVE: Evita que GSAP inyecte el bloque blanco inferior
                anticipatePin: 0,       // Previene saltos de render previo
                invalidateOnRefresh: true
            }
        });

        // 1. Dispersar elementos periféricos
        bentoTl.to(".item-1", { xPercent: -150, yPercent: -150, opacity: 0 }, 0)
               .to(".item-2", { yPercent: -180, opacity: 0 }, 0)
               .to(".item-3", { xPercent: 150, yPercent: -150, opacity: 0 }, 0)
               .to(".item-5", { xPercent: 180, opacity: 0 }, 0)
               .to(".item-6", { xPercent: -150, yPercent: 150, opacity: 0 }, 0)
               .to(".item-7", { yPercent: 180, opacity: 0 }, 0)
               .to(".item-8", { yPercent: 180, opacity: 0 }, 0)
               .to(".item-9", { xPercent: 150, yPercent: 150, opacity: 0 }, 0);

        // 2. Zoom fluido y exacto de la cocinita
        bentoTl.to(cocinita, {
            scale: 2.8,
            zIndex: 99,
            ease: "none",               // "none" asegura que la imagen no baile ni se reacomode al frenar
            transformOrigin: "center center"
        }, 0);
    }

    window.addEventListener("load", () => {
        if (typeof ScrollTrigger !== "undefined") {
            ScrollTrigger.refresh();
        }
    });
});
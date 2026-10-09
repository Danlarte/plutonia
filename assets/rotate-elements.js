document.addEventListener("DOMContentLoaded", function () {

    gsap.registerPlugin(ScrollTrigger);

    const section = document.querySelector("#fruit-roll-section");

    if (!section) {
        console.warn("FRUIT ROLL: sección no encontrada.");
        return;
    }

    const items = gsap.utils.toArray(
        section.querySelectorAll(".roll-item")
    );

    if (!items.length) {
        console.warn("FRUIT ROLL: no hay elementos .roll-item.");
        return;
    }

    console.log(
        "FRUIT ROLL: inicializando",
        items.length,
        "elementos"
    );


    // =========================================================
    // CONFIGURACIÓN
    // =========================================================

    const movement = 280;


    // =========================================================
    // PREPARAR ELEMENTOS
    // =========================================================

    gsap.set(items, {
        x: 0,
        rotation: 0,
        transformOrigin: "50% 50%",
        force3D: true,
        willChange: "transform"
    });


    // =========================================================
    // ANIMACIÓN
    // =========================================================

    items.forEach(function (item, index) {

        gsap.fromTo(
            item,

            {
                x: -movement,
                rotation: 0
            },

            {
                x: movement,
                rotation: 360,

                ease: "none",

                scrollTrigger: {

                    trigger: section,

                    start: "top bottom",

                    end: "bottom top",

                    scrub: 1,

                    invalidateOnRefresh: true

                }
            }
        );

    });


    // =========================================================
    // REFRESH
    // =========================================================

    window.addEventListener("load", function () {

        ScrollTrigger.refresh();

    });

});

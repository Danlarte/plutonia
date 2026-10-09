document.addEventListener("DOMContentLoaded", () => {
    if (typeof gsap === "undefined" || typeof ScrollTrigger === "undefined") {
        console.error("GSAP o ScrollTrigger no están cargados.");
        return;
    }

    gsap.registerPlugin(ScrollTrigger);

    const sections = document.querySelectorAll(".seccion-fullscreen");

    sections.forEach((section) => {
        const textElements = section.querySelectorAll(".box-text-container-title, .box-text-container p");

        textElements.forEach((element) => {
            if (!element.classList.contains("words-split")) {
                const words = element.innerText.trim().split(/\s+/);
                element.innerHTML = words.map(w => `<span class="split-word">${w}</span>`).join(" ");
                element.classList.add("words-split");
            }
            gsap.set(element, { perspective: 800 });
        });

        const allWords = section.querySelectorAll(".split-word");
        const boxContainer = section.querySelector(".box-text-container");

        const tl = gsap.timeline({
            scrollTrigger: {
                trigger: section,
                start: "top top",
                end: "+=100%",
                pin: true,
                pinSpacing: true,
                scrub: 1,
                invalidateOnRefresh: true
            }
        });

        // 1. Revelar texto
        tl.fromTo(
            allWords,
            {
                opacity: 0,
                rotateX: -75,
                y: 50,
                z: -80,
                transformOrigin: "50% 0%"
            },
            {
                opacity: 1,
                rotateX: 0,
                y: 0,
                z: 0,
                stagger: 0.04,
                ease: "power2.out"
            }
        );

        // 2. Pausa estática para lectura
        tl.to({}, { duration: 2.8 });

        // 3. Desvanecimiento suave del texto antes de continuar hacia el espacio rosado
        tl.to(boxContainer, {
            opacity: 0,
            y: -40,
            duration: 0.9,
            ease: "power1.in"
        });
    });

    window.addEventListener("load", () => {
        if (typeof ScrollTrigger !== "undefined") {
            ScrollTrigger.refresh();
        }
    });
});
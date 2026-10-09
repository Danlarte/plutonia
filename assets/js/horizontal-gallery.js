document.addEventListener('DOMContentLoaded', function () {
    if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') return;

    gsap.registerPlugin(ScrollTrigger);

    const gallerySection = document.querySelector('.horizontal-gallery-section');
    const galleryWrapper = document.querySelector('.horizontal-gallery-wrapper');
    const galleryStrip = document.querySelector('.gallery-strip');
    const images = gsap.utils.toArray('.card-inner img');

    if (!gallerySection || !galleryStrip) return;

    // Cálculo del recorrido total en horizontal
    const getScrollAmount = () => {
        return -(galleryStrip.scrollWidth - window.innerWidth);
    };

    // Timeline principal sincronizado al scroll
    const tl = gsap.timeline({
        scrollTrigger: {
            trigger: gallerySection,
            start: 'top top',
            end: () => `+=${Math.abs(getScrollAmount())}`, // La duración depende de la longitud real de las fotos
            pin: true,
            pinSpacing: true,
            scrub: 1, // Suavizado de inercia
            invalidateOnRefresh: true
        }
    });

    // 1. Desplazamiento horizontal de la tira de imágenes
    tl.to(galleryStrip, {
        x: getScrollAmount,
        ease: 'none'
    });

    // 2. Parallax en las imágenes internas mientras avanzan
    images.forEach((img) => {
        gsap.fromTo(
            img,
            { xPercent: -10 },
            {
                xPercent: 10,
                ease: 'none',
                scrollTrigger: {
                    trigger: gallerySection,
                    start: 'top top',
                    end: () => `+=${Math.abs(getScrollAmount())}`,
                    scrub: true
                }
            }
        );
    });

    // Recálculo tras carga completa de recursos
    window.addEventListener('load', () => ScrollTrigger.refresh());
});


document.addEventListener('DOMContentLoaded', function () {
    if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') return;

    gsap.registerPlugin(ScrollTrigger);

    const galleryTrack = document.querySelector('.gsap-gallery');
    const panels = gsap.utils.toArray('.panel');

    if (!galleryTrack || panels.length <= 1) return;

    // 1. Pre-posicionamiento exacto de capas
    gsap.set(panels[1], { xPercent: -100 }); 
    gsap.set(panels[2], { xPercent: 100 });  
    gsap.set(panels[3], { xPercent: 0, yPercent: 0, opacity: 0 }); 

    // 2. Timeline de secuencias
    const tl = gsap.timeline({
        scrollTrigger: {
            trigger: galleryTrack,
            start: 'top top',
            end: 'bottom bottom',
            scrub: 0.5,
            invalidateOnRefresh: true
        }
    });

    // 3. Encadenamiento de animaciones
    tl.to({}, { duration:  4 }) // Pausa en panel 1
      .to(panels[1], { xPercent: 0, ease: 'none', duration: 1 }) // Entra panel 2
      .to({}, { duration: 1.6 }) // Pausa en panel 2
      .to(panels[2], { xPercent: 0, ease: 'none', duration: 1 }) // Entra panel 3
      .to({}, { duration: 1.6 }) // Pausa en panel 3
      .to(panels[3], { opacity: 1, ease: 'power1.inOut', duration: 1 }); // Fade panel 4
});
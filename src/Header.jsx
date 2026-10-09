import React, { useEffect, useRef, useState } from 'react';
import gsap from 'gsap';

export const Header = () => {
  const [headerData, setHeaderData] = useState({ menuItems: [] });
  const [isOpen, setIsOpen] = useState(false);

  const headerRef = useRef(null);
  const menuCardRef = useRef(null);
  const overlayRef = useRef(null);
  const menuItemsRef = useRef([]);
  const tlRef = useRef(null);

  const lineTopRef = useRef(null);
  const lineMiddleRef = useRef(null);
  const lineBottomRef = useRef(null);

  // 1. Fetch de datos desde la REST API
  useEffect(() => {
    fetch('/wp-json/plutonia/v1/header-data')
      .then((res) => res.json())
      .then((data) => {
        console.log('Cargados desde REST API:', data);
        setHeaderData(data);
      })
      .catch((err) => console.error('Error al obtener header data:', err));
  }, []);

  // 2. Timeline GSAP (se reconstruye cuando headerData cambia)
  useEffect(() => {
    if (!menuCardRef.current || !overlayRef.current) return;

    const ctx = gsap.context(() => {
      const tl = gsap.timeline({ paused: true, defaults: { ease: 'power3.inOut', duration: 0.5 } });

      tl.to(overlayRef.current, {
        opacity: 1,
        pointerEvents: 'auto',
        duration: 0.3
      })
      .to(menuCardRef.current, {
        x: '0%',
        duration: 0.5,
        ease: 'power4.out'
      }, '-=0.2')
      .to(lineTopRef.current, { rotate: 45, y: 7 }, 0)
      .to(lineMiddleRef.current, { opacity: 0, scaleX: 0 }, 0)
      .to(lineBottomRef.current, { rotate: -45, y: -7 }, 0);

      const itemsAnimate = menuItemsRef.current.filter(Boolean);
      if (itemsAnimate.length > 0) {
        tl.fromTo(
          itemsAnimate,
          { y: 30, opacity: 0 },
          { y: 0, opacity: 1, stagger: 0.08, duration: 0.4, ease: 'back.out(1.4)' },
          '-=0.3'
        );
      }

      tlRef.current = tl;
    });

    return () => ctx.revert();
  }, [headerData]);

  const toggleMenu = () => {
    if (!isOpen) {
      tlRef.current?.play();
    } else {
      tlRef.current?.reverse();
    }
    setIsOpen(!isOpen);
  };

  const closeMenu = () => {
    if (isOpen) {
      tlRef.current?.reverse();
      setIsOpen(false);
    }
  };

  const items = headerData.menuItems || [];

  return (
    <>
      <header
        ref={headerRef}
        className="plutonia-header"
        style={{
          position: 'relative',
          width: '100%',
          backgroundColor: 'transparent',
          boxSizing: 'border-box',
          display: 'flex',
          justifyContent: 'space-between',
          alignItems: 'center',
          zIndex: 10000
        }}
      >
        <div className="plutonia-logo-container" style={{ display: 'flex', alignItems: 'center' }}>
          <a href={headerData.homeUrl || '/'} style={{ display: 'inline-block', lineHeight: 0 }}>
            <img
              src={headerData.logoUrl || "https://backputonia.local/wp-content/uploads/2026/06/LogoPlutonia.webp"}
              alt={headerData.siteName || 'Plutonia'}
              style={{
                height: '125px',
                width: 'auto',
                objectFit: 'contain',
                display: 'block',
                marginTop:'20px'
              }}
            />
          </a>
        </div>

        <button
          onClick={toggleMenu}
          aria-label="Abrir menú"
          style={{
            background: 'rgba(0, 0, 0, 0.8)',
            backdropFilter: 'blur(8px)',
            border: '1px solid rgba(255, 255, 255, 0.2)',
            borderRadius: '50%',
            width: '50px',
            height: '50px',
            display: 'flex',
            flexDirection: 'column',
            justifyContent: 'center',
            alignItems: 'center',
            gap: '5px',
            cursor: 'pointer',
            zIndex: 10001,
            outline: 'none',
            marginRight:'30px'
          }}
        >
          <span ref={lineTopRef} style={{ width: '22px', height: '2px', backgroundColor: '#ffffff', display: 'block' }} />
          <span ref={lineMiddleRef} style={{ width: '22px', height: '2px', backgroundColor: '#ffffff', display: 'block' }} />
          <span ref={lineBottomRef} style={{ width: '22px', height: '2px', backgroundColor: '#ffffff', display: 'block' }} />
        </button>
      </header>

      <div
        ref={overlayRef}
        onClick={closeMenu}
        style={{
          position: 'fixed',
          top: 0,
          left: 0,
          width: '100vw',
          height: '100vh',
          backgroundColor: 'rgba(0, 0, 0, 0.5)',
          backdropFilter: 'blur(4px)',
          opacity: 0,
          pointerEvents: 'none',
          zIndex: 9998
        }}
      />

      <aside
        ref={menuCardRef}
        style={{
          position: 'fixed',
          top: 0,
          right: 0,
          width: '100%',
          maxWidth: '420px',
          height: '100vh',
          backgroundColor: '#F8E4F0',
          borderLeft: '1px solid rgba(255, 255, 255, 01)',
          boxShadow: '-10px 0 30px rgba(0, 0, 0, 0.5)',
          padding: '6rem 3rem 3rem 3rem',
          boxSizing: 'border-box',
          display: 'flex',
          flexDirection: 'column',
          justifyContent: 'space-between',
          transform: 'translateX(100%)',
          zIndex: 9999,
        
          
        }}
      >
        <nav style={{ display: 'flex', flexDirection: 'column', gap: '1.8rem', marginTop:'8rem', }}>
          <span style={{ fontSize: '0.75rem', textTransform: 'uppercase', letterSpacing: '2px', color: '#262626', marginBottom: '0.5rem' }}>
            Navegación
          </span>

          {items.length > 0 ? (
            items.map((item, index) => (
              <a
                key={item.id || index}
                ref={(el) => (menuItemsRef.current[index] = el)}
                href={item.url}
                onClick={closeMenu}
                style={{
                  color: '#262626',
                  textDecoration: 'none',
                  fontSize: '1rem',
                  fontWeight: 500,
                  letterSpacing: '0.5px',
                  display: 'inline-block',
                  transition: 'transform 0.2s ease, color 0.2s ease'
                }}
                onMouseEnter={(e) => {
                  e.target.style.color = '#ff4081';
                  e.target.style.transform = 'translateX(10px)';
                }}
                onMouseLeave={(e) => {
                  e.target.style.color = '#262626';
                  e.target.style.transform = 'translateX(0px)';
                }}
              >
                {item.title}
              </a>
            ))
          ) : (
            <div style={{ color: 'rgba(255,255,255,0.6)', fontSize: '0.95rem' }}>
              Cargando menú...
            </div>
          )}
        </nav>

        <div style={{ borderTop: '1px solid rgba(255,255,255,0.1)', paddingTop: '8rem' , marginBottom:'4rem', }}>
          <p style={{ color: '#262626', fontSize: '0.85rem', margin: 0 }}>
            Plutonia &copy; {new Date().getFullYear()}
          </p>
        </div>
      </aside>
    </>
  );
};

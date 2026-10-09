import React, { useEffect, useRef } from 'react';
import gsap from 'gsap'; // <-- Importación directa de NPM

export const GSAPTimelineDemo = () => {
  const containerRef = useRef(null);
  const timelineRef = useRef(null);

  useEffect(() => {
    // Usamos gsap.context para que React limpie el DOM correctamente
    const ctx = gsap.context(() => {
      timelineRef.current = gsap.timeline()
        .to('.demo-box-1', { x: 100, rotation: 360, duration: 1 })
        .to('.demo-box-2', { y: -30, backgroundColor: '#ff0055', duration: 0.8 })
        .to('.demo-box-3', { scale: 1.2, duration: 0.5 });
    }, containerRef);

    return () => ctx.revert(); // Cleanup al desmontar o con Hot Reload
  }, []);

  const handleRebuild = () => {
    if (timelineRef.current) {
      timelineRef.current.clear(); // Clear & Rebuild
      timelineRef.current
        .to('.demo-box-1', { x: 100, rotation: 360, duration: 1 })
        .to('.demo-box-2', { y: -30, backgroundColor: '#ff0055', duration: 0.8 })
        .to('.demo-box-3', { scale: 1.2, duration: 0.5 })
        .restart();
    }
  };

  return (
    <div ref={containerRef} style={{ padding: '20px', background: '#111', color: '#fff', margin: '20px 0' }}>
      <button onClick={handleRebuild} style={{ marginBottom: '15px', padding: '8px 16px', cursor: 'pointer' }}>
        Reconstruir Timeline
      </button>
      <div style={{ display: 'flex', gap: '20px' }}>
        <div className="demo-box-1" style={{ width: 40, height: 40, background: '#00e5ff' }} />
        <div className="demo-box-2" style={{ width: 40, height: 40, background: '#ffcc00' }} />
        <div className="demo-box-3" style={{ width: 40, height: 40, background: '#00ff66' }} />
      </div>
    </div>
  );
};
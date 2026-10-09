import React from 'react';
import ReactDOM from 'react-dom/client';
import { Header } from './Header';

const mountHeader = () => {
  const rootEl = document.getElementById('plutonia-react-header-root');

  if (rootEl) {
    if (!rootEl._reactRoot) {
      rootEl._reactRoot = ReactDOM.createRoot(rootEl);
    }

    // Eohasa data inyectada WordPress gui
    const headerData = window.PlutoniaHeaderData || {};

    rootEl._reactRoot.render(
      <React.StrictMode>
        <Header data={headerData} />
      </React.StrictMode>
    );
  }
};

if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', mountHeader);
} else {
  mountHeader();
}
class PlutoniaShippingCard extends HTMLElement {
    connectedCallback() {
        this.innerHTML = `
            <div id="plutonia-shipping-card" class="shipping-card-popup">
                <button type="button" class="shipping-card-close" aria-label="Cerrar">&times;</button>
                <div class="shipping-card-header">
                    <span class="shipping-card-badge">Info Envíos</span>
                </div>
                <div class="shipping-card-body">
                    <div class="shipping-line">
                        <span class="shipping-icon">🇦🇷</span>
                        <p><strong>Envíos en Argentina</strong><br>Correo Andreani</p>
                    </div>
                    <div class="shipping-divider-line"></div>
                    <div class="shipping-line">
                        <span class="shipping-icon">✈️</span>
                        <p><strong>Envíos internacionales</strong><br>DHL Express</p>
                    </div>
                </div>
            </div>
        `;

        this.querySelector('.shipping-card-close').addEventListener('click', () => {
            const card = this.querySelector('#plutonia-shipping-card');
            card.style.opacity = '0';
            card.style.transform = 'translateX(-20px)';
            setTimeout(() => this.remove(), 300);
        });
    }
}

customElements.define('plutonia-shipping-card', PlutoniaShippingCard);
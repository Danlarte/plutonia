document.addEventListener('DOMContentLoaded', function() {
    var trigger = document.getElementById('plutonia-cart-trigger');
    if (trigger) {
        trigger.addEventListener('click', function(e) {
            e.preventDefault();
            var astraCartMenu = document.querySelector('.ast-menu-cart-link, .ast-site-header-cart-li a');
            if (astraCartMenu) {
                astraCartMenu.click();
            }
        });
    }
});
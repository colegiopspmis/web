'use strict';
document.addEventListener('DOMContentLoaded', () => {
    const header = document.getElementById('cspm-header');
    const nav = document.getElementById('cspm-nav-primary');
    const toggle = document.getElementById('cspm-menu-toggle');
    const desktop = window.matchMedia('(min-width: 1024px)');
    const updateHeader = () => header?.classList.toggle('is-scrolled', window.scrollY > 20);
    updateHeader();
    window.addEventListener('scroll', updateHeader, { passive: true });
    if (!nav || !toggle) return;
    document.documentElement.classList.add('cspm-js');
    let open = false;
    const setMenu = (value, restoreFocus = false) => {
        open = value;
        nav.classList.toggle('is-open', open);
        toggle.setAttribute('aria-expanded', String(open));
        toggle.setAttribute('aria-label', open ? 'Cerrar menú' : 'Abrir menú');
        nav.inert = !desktop.matches && !open;
        if (restoreFocus && !desktop.matches) toggle.focus();
    };
    toggle.addEventListener('click', () => setMenu(!open));
    desktop.addEventListener('change', () => setMenu(false));
    setMenu(false);
    document.addEventListener('click', event => {
        if (open && !nav.contains(event.target) && !toggle.contains(event.target)) setMenu(false);
    });
    nav.querySelectorAll('li').forEach((item, index) => {
        const submenu = item.querySelector(':scope > .sub-menu');
        const link = item.querySelector(':scope > a');
        if (!submenu || !link) return;
        submenu.id = `cspm-submenu-${index}`;
        const button = document.createElement('button');
        button.type = 'button';
        button.className = 'cspm-submenu-toggle';
        button.textContent = '▾';
        button.setAttribute('aria-label', `Submenú de ${link.textContent.trim()}`);
        button.setAttribute('aria-controls', submenu.id);
        button.setAttribute('aria-expanded', 'false');
        link.after(button);
        const expand = value => {
            button.setAttribute('aria-expanded', String(value));
            submenu.hidden = !value;
            item.classList.toggle('is-expanded', value);
        };
        expand(false);
        button.addEventListener('click', () => expand(button.getAttribute('aria-expanded') !== 'true'));
        item.addEventListener('keydown', event => {
            if (event.key === 'Escape' && button.getAttribute('aria-expanded') === 'true') {
                event.stopPropagation();
                expand(false);
                button.focus();
            }
        });
        item.addEventListener('focusout', event => {
            if (!item.contains(event.relatedTarget)) expand(false);
        });
    });
    document.addEventListener('keydown', event => {
        if (event.key === 'Escape' && open) setMenu(false, true);
    });
});

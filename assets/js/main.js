/**
 * main.js — JavaScript vanilla del tema CSPM Institucional
 *
 * Módulos incluidos:
 *  1. Header scroll behavior (sticky + shadow)
 *  2. Hamburger menu (móvil) — accesible con ARIA
 *  3. Submenús accesibles con teclado
 *  4. Scroll suave para anclas internas
 *  5. Intersection Observer para animaciones de entrada
 *  6. Protección de enlaces externos (rel="noopener noreferrer")
 *
 * Sin dependencias externas. Vanilla JS puro.
 * Cargado con defer desde functions.php.
 *
 * @package cspm-institucional
 * @since   1.0.0
 */

'use strict';

// ─────────────────────────────────────────────────────────────────────────────
// Utilidad: Ejecutar cuando el DOM esté listo
// ─────────────────────────────────────────────────────────────────────────────
function domReady(fn) {
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', fn);
    } else {
        fn();
    }
}

// ─────────────────────────────────────────────────────────────────────────────
// 1. HEADER — Scroll shadow & comportamiento sticky
// ─────────────────────────────────────────────────────────────────────────────
function initHeaderScroll() {
    const header = document.getElementById('cspm-header');
    if (!header) return;

    const SCROLL_THRESHOLD = 20;

    function updateHeader() {
        const scrolled = window.scrollY > SCROLL_THRESHOLD;
        header.classList.toggle('is-scrolled', scrolled);
    }

    // Uso de IntersectionObserver para mejor rendimiento vs scroll listener puro
    const sentinel = document.createElement('div');
    sentinel.style.cssText = `
        position: absolute;
        top: ${SCROLL_THRESHOLD}px;
        left: 0;
        height: 1px;
        width: 1px;
        pointer-events: none;
        visibility: hidden;
    `;
    document.body.prepend(sentinel);

    const observer = new IntersectionObserver(
        ([entry]) => {
            header.classList.toggle('is-scrolled', !entry.isIntersecting);
        },
        { threshold: 0 }
    );
    observer.observe(sentinel);

    // Fallback por si IntersectionObserver no está disponible
    if (!('IntersectionObserver' in window)) {
        window.addEventListener('scroll', updateHeader, { passive: true });
        updateHeader();
    }
}


// ─────────────────────────────────────────────────────────────────────────────
// 2. HAMBURGER MENU — Accesible con ARIA y gestión de foco
// ─────────────────────────────────────────────────────────────────────────────
function initMobileMenu() {
    const toggle  = document.getElementById('cspm-menu-toggle');
    const nav     = document.getElementById('cspm-nav-primary');
    const body    = document.body;

    if (!toggle || !nav) return;

    let isOpen = false;

    function openMenu() {
        isOpen = true;
        nav.classList.add('is-open');
        toggle.setAttribute('aria-expanded', 'true');
        toggle.setAttribute('aria-label', 'Cerrar menú');
        body.style.overflow = 'hidden'; // Bloquea scroll de fondo

        // Foco al primer enlace del menú
        const firstLink = nav.querySelector('a');
        if (firstLink) {
            requestAnimationFrame(() => firstLink.focus());
        }
    }

    function closeMenu() {
        isOpen = false;
        nav.classList.remove('is-open');
        toggle.setAttribute('aria-expanded', 'false');
        toggle.setAttribute('aria-label', 'Abrir menú');
        body.style.overflow = '';
        toggle.focus(); // Devuelve foco al botón
    }

    toggle.addEventListener('click', () => {
        isOpen ? closeMenu() : openMenu();
    });

    // Cerrar con ESC
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && isOpen) {
            closeMenu();
        }
    });

    // Cerrar al hacer clic fuera del menú
    document.addEventListener('click', (e) => {
        if (isOpen && !nav.contains(e.target) && !toggle.contains(e.target)) {
            closeMenu();
        }
    });

    // Cerrar si la pantalla vuelve a ser grande (resize)
    const mql = window.matchMedia('(min-width: 1024px)');
    mql.addEventListener('change', (e) => {
        if (e.matches && isOpen) closeMenu();
    });
}


// ─────────────────────────────────────────────────────────────────────────────
// 3. SUBMENÚS ACCESIBLES — Teclado (Enter / Space / Flechas)
// ─────────────────────────────────────────────────────────────────────────────
function initAccessibleSubmenus() {
    const menuItems = document.querySelectorAll('.cspm-nav__list > li');

    menuItems.forEach(item => {
        const submenu = item.querySelector('.sub-menu');
        if (!submenu) return;

        const parentLink = item.querySelector(':scope > a');
        if (!parentLink) return;

        // Hacer el ítem padre interactivo para teclado
        parentLink.setAttribute('aria-haspopup', 'true');
        parentLink.setAttribute('aria-expanded', 'false');

        function openSub() {
            submenu.style.display = 'block';
            parentLink.setAttribute('aria-expanded', 'true');
        }
        function closeSub() {
            submenu.style.display = '';
            parentLink.setAttribute('aria-expanded', 'false');
        }

        // Hover (desktop)
        item.addEventListener('mouseenter', openSub);
        item.addEventListener('mouseleave', closeSub);

        // Enter/Space en el enlace padre
        parentLink.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                const isExpanded = parentLink.getAttribute('aria-expanded') === 'true';
                isExpanded ? closeSub() : openSub();
            }
            if (e.key === 'ArrowDown') {
                e.preventDefault();
                openSub();
                const firstSubLink = submenu.querySelector('a');
                if (firstSubLink) firstSubLink.focus();
            }
            if (e.key === 'Escape') closeSub();
        });

        // ESC dentro del submenú cierra y devuelve foco
        submenu.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                closeSub();
                parentLink.focus();
            }
        });

        // Foco fuera del ítem cierra el submenú
        item.addEventListener('focusout', (e) => {
            if (!item.contains(e.relatedTarget)) {
                closeSub();
            }
        });
    });
}


// ─────────────────────────────────────────────────────────────────────────────
// 4. SCROLL SUAVE PARA ANCLAS INTERNAS
//    (complemento a scroll-behavior: smooth del CSS para máxima compatibilidad)
// ─────────────────────────────────────────────────────────────────────────────
function initSmoothScroll() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', (e) => {
            const id = anchor.getAttribute('href');
            if (id === '#') return;

            const target = document.querySelector(id);
            if (!target) return;

            e.preventDefault();
            const headerHeight = parseInt(
                getComputedStyle(document.documentElement).getPropertyValue('--header-height'),
                10
            ) || 72;

            const top = target.getBoundingClientRect().top + window.scrollY - headerHeight - 16;

            window.scrollTo({ top, behavior: 'smooth' });

            // Foco accesible al target
            target.setAttribute('tabindex', '-1');
            target.focus({ preventScroll: true });
            target.addEventListener('blur', () => target.removeAttribute('tabindex'), { once: true });
        });
    });
}


// ─────────────────────────────────────────────────────────────────────────────
// 5. ANIMACIONES DE ENTRADA — Intersection Observer
//    Anima elementos con data-animate="fade-up" al entrar en viewport
// ─────────────────────────────────────────────────────────────────────────────
function initScrollAnimations() {
    // Respetar preferencias de movimiento reducido
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

    const targets = document.querySelectorAll(
        '.cspm-card, .cspm-quick-link-card, .cspm-section-header, [data-animate]'
    );

    if (!targets.length) return;

    // Estilos iniciales (invisible y desplazado)
    const style = document.createElement('style');
    style.textContent = `
        .cspm-card,
        .cspm-quick-link-card,
        .cspm-section-header,
        [data-animate] {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.5s ease, transform 0.5s ease;
        }
        .cspm-animate-in {
            opacity: 1 !important;
            transform: translateY(0) !important;
        }
    `;
    document.head.appendChild(style);

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry, i) => {
                if (entry.isIntersecting) {
                    // Escalonar animaciones: delay según posición
                    const delay = (i % 4) * 80;
                    setTimeout(() => {
                        entry.target.classList.add('cspm-animate-in');
                    }, delay);
                    observer.unobserve(entry.target);
                }
            });
        },
        {
            threshold: 0.08,
            rootMargin: '0px 0px -40px 0px',
        }
    );

    targets.forEach(el => observer.observe(el));
}


// ─────────────────────────────────────────────────────────────────────────────
// 6. PROTECCIÓN ENLACES EXTERNOS
//    Asegura rel="noopener noreferrer" en todos los target="_blank"
// ─────────────────────────────────────────────────────────────────────────────
function securExternalLinks() {
    document.querySelectorAll('a[target="_blank"]').forEach(link => {
        const rel = link.getAttribute('rel') || '';
        if (!rel.includes('noopener')) {
            link.setAttribute('rel', (rel + ' noopener noreferrer').trim());
        }
        // Indicador visual de enlace externo (accesibilidad)
        if (!link.querySelector('.cspm-external-label')) {
            const label = document.createElement('span');
            label.className = 'cspm-external-label screen-reader-text';
            label.textContent = ' (abre en nueva pestaña)';
            link.appendChild(label);
        }
    });
}


// ─────────────────────────────────────────────────────────────────────────────
// INIT — Ejecuta todos los módulos
// ─────────────────────────────────────────────────────────────────────────────
domReady(() => {
    initHeaderScroll();
    initMobileMenu();
    initAccessibleSubmenus();
    initSmoothScroll();
    initScrollAnimations();
    securExternalLinks();
});

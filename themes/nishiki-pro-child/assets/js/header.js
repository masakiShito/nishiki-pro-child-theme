/**
 * Header - Navigation & Mobile Menu
 */

(function() {
    'use strict';

    const header = document.getElementById('masthead');
    const mobileMenu = document.getElementById('mobile-menu');
    const menuToggle = document.querySelector('.menu-toggle');
    const menuClose = document.querySelector('.mobile-menu-close');
    const menuOverlay = document.querySelector('.mobile-menu-overlay');
    const progressBar = document.querySelector('.header-progress');

    if (!header) return;

    // ===========================================
    // Scroll Effects
    // ===========================================

    let ticking = false;

    function onScroll() {
        const scrollY = window.pageYOffset;

        // Scrolled state
        if (scrollY > 20) {
            document.body.classList.add('scrolled');
        } else {
            document.body.classList.remove('scrolled');
        }

        // Progress bar
        if (progressBar) {
            const docHeight = document.documentElement.scrollHeight - window.innerHeight;
            const progress = docHeight > 0 ? (scrollY / docHeight) * 100 : 0;
            progressBar.style.width = `${Math.min(progress, 100)}%`;
        }

        ticking = false;
    }

    function requestTick() {
        if (!ticking) {
            requestAnimationFrame(onScroll);
            ticking = true;
        }
    }

    window.addEventListener('scroll', requestTick, { passive: true });

    // ===========================================
    // Mobile Menu
    // ===========================================

    function openMobileMenu() {
        if (!mobileMenu || !menuToggle) return;

        mobileMenu.classList.add('is-open');
        mobileMenu.setAttribute('aria-hidden', 'false');
        menuToggle.setAttribute('aria-expanded', 'true');
        document.body.style.overflow = 'hidden';

        // Focus first element
        setTimeout(() => {
            const firstFocusable = mobileMenu.querySelector('button, a');
            if (firstFocusable) firstFocusable.focus();
        }, 100);
    }

    function closeMobileMenu() {
        if (!mobileMenu || !menuToggle) return;

        mobileMenu.classList.remove('is-open');
        mobileMenu.setAttribute('aria-hidden', 'true');
        menuToggle.setAttribute('aria-expanded', 'false');
        document.body.style.overflow = '';

        // Close all accordions
        document.querySelectorAll('.mobile-nav-item.is-open').forEach(item => {
            item.classList.remove('is-open');
            const toggle = item.querySelector('.mobile-nav-toggle');
            if (toggle) toggle.setAttribute('aria-expanded', 'false');
        });

        menuToggle.focus();
    }

    // Toggle button
    if (menuToggle) {
        menuToggle.addEventListener('click', () => {
            const isOpen = menuToggle.getAttribute('aria-expanded') === 'true';
            if (isOpen) {
                closeMobileMenu();
            } else {
                openMobileMenu();
            }
        });
    }

    // Close button
    if (menuClose) {
        menuClose.addEventListener('click', closeMobileMenu);
    }

    // Overlay click
    if (menuOverlay) {
        menuOverlay.addEventListener('click', closeMobileMenu);
    }

    // Escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && mobileMenu?.classList.contains('is-open')) {
            closeMobileMenu();
        }
    });

    // ===========================================
    // Mobile Nav Accordion (Child Categories)
    // ===========================================

    const navToggles = document.querySelectorAll('.mobile-nav-toggle');

    navToggles.forEach(toggle => {
        toggle.addEventListener('click', function() {
            const item = this.closest('.mobile-nav-item');
            const isExpanded = this.getAttribute('aria-expanded') === 'true';

            // Close other open items
            document.querySelectorAll('.mobile-nav-item.is-open').forEach(openItem => {
                if (openItem !== item) {
                    openItem.classList.remove('is-open');
                    const otherToggle = openItem.querySelector('.mobile-nav-toggle');
                    if (otherToggle) otherToggle.setAttribute('aria-expanded', 'false');
                }
            });

            // Toggle current item
            if (isExpanded) {
                item.classList.remove('is-open');
                this.setAttribute('aria-expanded', 'false');
            } else {
                item.classList.add('is-open');
                this.setAttribute('aria-expanded', 'true');
            }
        });
    });

    // ===========================================
    // Desktop Dropdown (keyboard accessibility)
    // ===========================================

    const navItems = document.querySelectorAll('.nav-item.has-dropdown');

    navItems.forEach(item => {
        const link = item.querySelector('.nav-link');
        const dropdown = item.querySelector('.dropdown');

        if (!link || !dropdown) return;

        // Focus management
        link.addEventListener('focus', () => {
            item.classList.add('is-focused');
        });

        link.addEventListener('blur', (e) => {
            // Check if focus moved to dropdown
            setTimeout(() => {
                if (!item.contains(document.activeElement)) {
                    item.classList.remove('is-focused');
                }
            }, 10);
        });

        // Keyboard navigation
        link.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' || e.key === ' ') {
                // Let the link navigate normally
            } else if (e.key === 'ArrowDown') {
                e.preventDefault();
                const firstDropdownLink = dropdown.querySelector('.dropdown-link');
                if (firstDropdownLink) firstDropdownLink.focus();
            }
        });

        // Arrow key navigation in dropdown
        const dropdownLinks = dropdown.querySelectorAll('.dropdown-link, .dropdown-view-all');
        dropdownLinks.forEach((dropdownLink, index) => {
            dropdownLink.addEventListener('keydown', (e) => {
                if (e.key === 'ArrowDown') {
                    e.preventDefault();
                    const next = dropdownLinks[index + 1];
                    if (next) next.focus();
                } else if (e.key === 'ArrowUp') {
                    e.preventDefault();
                    if (index === 0) {
                        link.focus();
                    } else {
                        dropdownLinks[index - 1].focus();
                    }
                } else if (e.key === 'Escape') {
                    link.focus();
                    item.classList.remove('is-focused');
                }
            });

            dropdownLink.addEventListener('blur', () => {
                setTimeout(() => {
                    if (!item.contains(document.activeElement)) {
                        item.classList.remove('is-focused');
                    }
                }, 10);
            });
        });
    });

    // ===========================================
    // Close mobile menu on resize
    // ===========================================

    let resizeTimeout;
    window.addEventListener('resize', () => {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(() => {
            if (window.innerWidth > 1024 && mobileMenu?.classList.contains('is-open')) {
                closeMobileMenu();
            }
        }, 150);
    });

    // Initial scroll check
    onScroll();

})();

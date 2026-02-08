/**
 * Archive Page Enhancements
 * Animations, filtering, and interactions
 */

(function() {
    'use strict';

    // Wait for DOM ready
    document.addEventListener('DOMContentLoaded', init);

    function init() {
        initScrollAnimations();
        initCategoryFilter();
        initViewToggle();
        initScrollProgress();
        initParallaxHero();
        initCardHoverEffects();
        initSmoothScroll();
    }

    /**
     * Scroll-triggered animations using Intersection Observer
     */
    function initScrollAnimations() {
        const observerOptions = {
            root: null,
            rootMargin: '0px 0px -80px 0px',
            threshold: 0.1
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        // Observe article cards
        const cards = document.querySelectorAll('.article-card, .featured-article, .fade-in-up');
        cards.forEach(card => observer.observe(card));
    }

    /**
     * Category Filter Tabs
     */
    function initCategoryFilter() {
        const filterTabs = document.querySelectorAll('.archive-filter__tab');
        const articleCards = document.querySelectorAll('.article-card');

        if (!filterTabs.length) return;

        filterTabs.forEach(tab => {
            tab.addEventListener('click', () => {
                // Update active state
                filterTabs.forEach(t => t.classList.remove('is-active'));
                tab.classList.add('is-active');

                const category = tab.dataset.category;

                // Filter cards
                articleCards.forEach((card, index) => {
                    const cardCategory = card.dataset.category;

                    if (category === 'all' || cardCategory === category) {
                        card.style.display = '';
                        // Reset and re-trigger animation
                        card.classList.remove('is-visible');
                        setTimeout(() => {
                            card.classList.add('is-visible');
                        }, index * 50);
                    } else {
                        card.style.display = 'none';
                    }
                });

                // Update URL without reload (optional)
                if (category !== 'all') {
                    history.replaceState(null, '', `?category=${category}`);
                } else {
                    history.replaceState(null, '', window.location.pathname);
                }
            });
        });
    }

    /**
     * Grid/List View Toggle
     */
    function initViewToggle() {
        const viewBtns = document.querySelectorAll('.archive-filter__view-btn');
        const articleGrid = document.querySelector('.article-grid');

        if (!viewBtns.length || !articleGrid) return;

        // Load saved preference
        const savedView = localStorage.getItem('archive-view') || 'grid';
        setView(savedView);

        viewBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                const view = btn.dataset.view;
                setView(view);
                localStorage.setItem('archive-view', view);
            });
        });

        function setView(view) {
            viewBtns.forEach(b => b.classList.toggle('is-active', b.dataset.view === view));
            articleGrid.classList.toggle('article-grid--list', view === 'list');
        }
    }

    /**
     * Scroll Progress Indicator
     */
    function initScrollProgress() {
        const indicator = document.querySelector('.scroll-indicator__bar');
        if (!indicator) return;

        let ticking = false;

        window.addEventListener('scroll', () => {
            if (!ticking) {
                requestAnimationFrame(() => {
                    const scrollTop = window.scrollY;
                    const docHeight = document.documentElement.scrollHeight - window.innerHeight;
                    const scrollPercent = (scrollTop / docHeight) * 100;
                    indicator.style.width = `${Math.min(scrollPercent, 100)}%`;
                    ticking = false;
                });
                ticking = true;
            }
        });
    }

    /**
     * Parallax effect for hero section
     */
    function initParallaxHero() {
        const hero = document.querySelector('.archive-hero');
        const shapes = document.querySelectorAll('.archive-hero__shape');

        if (!hero || !shapes.length) return;

        let ticking = false;

        window.addEventListener('scroll', () => {
            if (!ticking) {
                requestAnimationFrame(() => {
                    const scrolled = window.scrollY;
                    const heroHeight = hero.offsetHeight;

                    if (scrolled < heroHeight) {
                        shapes.forEach((shape, i) => {
                            const speed = 0.1 + (i * 0.05);
                            const yPos = scrolled * speed;
                            shape.style.transform = `translateY(${yPos}px)`;
                        });
                    }
                    ticking = false;
                });
                ticking = true;
            }
        });
    }

    /**
     * Enhanced card hover effects
     */
    function initCardHoverEffects() {
        const cards = document.querySelectorAll('.article-card, .featured-article');

        cards.forEach(card => {
            card.addEventListener('mouseenter', (e) => {
                // Add subtle tilt effect based on mouse position
                const rect = card.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;

                const xPercent = (x / rect.width - 0.5) * 2;
                const yPercent = (y / rect.height - 0.5) * 2;

                card.style.transform = `
                    translateY(-12px)
                    perspective(1000px)
                    rotateY(${xPercent * 2}deg)
                    rotateX(${-yPercent * 2}deg)
                `;
            });

            card.addEventListener('mousemove', (e) => {
                const rect = card.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;

                const xPercent = (x / rect.width - 0.5) * 2;
                const yPercent = (y / rect.height - 0.5) * 2;

                card.style.transform = `
                    translateY(-12px)
                    perspective(1000px)
                    rotateY(${xPercent * 2}deg)
                    rotateX(${-yPercent * 2}deg)
                `;
            });

            card.addEventListener('mouseleave', () => {
                card.style.transform = '';
            });
        });
    }

    /**
     * Smooth scroll for anchor links
     */
    function initSmoothScroll() {
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const targetId = this.getAttribute('href');
                if (targetId === '#') return;

                const target = document.querySelector(targetId);
                if (target) {
                    e.preventDefault();
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    }

    /**
     * Reading time calculator
     */
    function calculateReadingTime(text) {
        const wordsPerMinute = 400; // Japanese reading speed
        const charCount = text.length;
        const minutes = Math.ceil(charCount / wordsPerMinute);
        return minutes;
    }

    /**
     * Add reading time to cards (optional enhancement)
     */
    function addReadingTimes() {
        const excerpts = document.querySelectorAll('.article-card__excerpt');

        excerpts.forEach(excerpt => {
            const card = excerpt.closest('.article-card');
            const footer = card.querySelector('.article-card__footer');

            if (footer) {
                const text = excerpt.textContent;
                const minutes = calculateReadingTime(text);

                const timeEl = document.createElement('span');
                timeEl.className = 'article-card__reading-time';
                timeEl.innerHTML = `
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"/>
                        <polyline points="12 6 12 12 16 14"/>
                    </svg>
                    ${minutes}分
                `;
                footer.appendChild(timeEl);
            }
        });
    }

    /**
     * Lazy loading images with blur-up effect
     */
    function initLazyImages() {
        if ('loading' in HTMLImageElement.prototype) {
            // Native lazy loading supported
            const images = document.querySelectorAll('img[loading="lazy"]');
            images.forEach(img => {
                img.classList.add('lazy-loaded');
            });
        } else {
            // Fallback for older browsers
            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src;
                        img.classList.add('lazy-loaded');
                        observer.unobserve(img);
                    }
                });
            });

            const lazyImages = document.querySelectorAll('img[data-src]');
            lazyImages.forEach(img => imageObserver.observe(img));
        }
    }

    /**
     * Count animation for stats
     */
    function animateCounters() {
        const counters = document.querySelectorAll('.archive-hero__stat-value');

        const observerOptions = {
            threshold: 0.5
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const counter = entry.target;
                    const target = parseInt(counter.dataset.count || counter.textContent);
                    animateValue(counter, 0, target, 1500);
                    observer.unobserve(counter);
                }
            });
        }, observerOptions);

        counters.forEach(counter => observer.observe(counter));
    }

    function animateValue(el, start, end, duration) {
        const range = end - start;
        const startTime = performance.now();

        function update(currentTime) {
            const elapsed = currentTime - startTime;
            const progress = Math.min(elapsed / duration, 1);

            // Easing function
            const easeOutQuart = 1 - Math.pow(1 - progress, 4);
            const current = Math.floor(start + range * easeOutQuart);

            el.textContent = current;

            if (progress < 1) {
                requestAnimationFrame(update);
            } else {
                el.textContent = end;
            }
        }

        requestAnimationFrame(update);
    }

    // Initialize counters
    animateCounters();

})();

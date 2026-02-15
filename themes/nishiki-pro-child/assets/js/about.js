/**
 * About Page - Interactive Animations
 */

document.addEventListener('DOMContentLoaded', function() {
    // Check if we're on the about page
    if (!document.querySelector('.about-page')) return;

    // ===========================================
    // Scroll Animations with Intersection Observer
    // ===========================================

    const sections = document.querySelectorAll(
        '.about-profile, .about-career, .about-phases, .about-skills, .about-strengths, .about-management'
    );

    const sectionObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');

                // Trigger phase bar animations when phases section is visible
                if (entry.target.classList.contains('about-phases')) {
                    animatePhaseBars();
                }
            }
        });
    }, {
        threshold: 0.15,
        rootMargin: '0px 0px -50px 0px'
    });

    sections.forEach(section => {
        sectionObserver.observe(section);
    });

    // ===========================================
    // Phase Bar Animation
    // ===========================================

    function animatePhaseBars() {
        const bars = document.querySelectorAll('.phase-bar__fill');
        bars.forEach((bar, index) => {
            setTimeout(() => {
                bar.style.setProperty('--animated', '1');
            }, index * 100);
        });
    }

    // ===========================================
    // Bento Card Hover Effects
    // ===========================================

    const bentoCards = document.querySelectorAll('.bento-card');

    bentoCards.forEach(card => {
        card.addEventListener('mousemove', (e) => {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;

            const centerX = rect.width / 2;
            const centerY = rect.height / 2;

            const rotateX = (y - centerY) / 20;
            const rotateY = (centerX - x) / 20;

            card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateY(-8px)`;
        });

        card.addEventListener('mouseleave', () => {
            card.style.transform = '';
        });
    });

    // ===========================================
    // Skill Tags Stagger Animation
    // ===========================================

    const skillGroups = document.querySelectorAll('.skill-group');

    const skillObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const tags = entry.target.querySelectorAll('.skill-tag');
                tags.forEach((tag, index) => {
                    tag.style.opacity = '0';
                    tag.style.transform = 'translateY(20px)';

                    setTimeout(() => {
                        tag.style.transition = 'all 0.4s ease';
                        tag.style.opacity = '1';
                        tag.style.transform = 'translateY(0)';
                    }, index * 50);
                });
            }
        });
    }, {
        threshold: 0.3
    });

    skillGroups.forEach(group => {
        skillObserver.observe(group);
    });

    // ===========================================
    // Strength Cards Number Animation
    // ===========================================

    const strengthCards = document.querySelectorAll('.strength-card');

    const strengthObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const number = entry.target.querySelector('.strength-card__number');
                if (number) {
                    number.style.opacity = '0';
                    number.style.transform = 'scale(0.5)';

                    setTimeout(() => {
                        number.style.transition = 'all 0.5s cubic-bezier(0.34, 1.56, 0.64, 1)';
                        number.style.opacity = '1';
                        number.style.transform = 'scale(1)';
                    }, 200);
                }
            }
        });
    }, {
        threshold: 0.3
    });

    strengthCards.forEach(card => {
        strengthObserver.observe(card);
    });

    // ===========================================
    // Hero Parallax Effect
    // ===========================================

    const heroSection = document.querySelector('.about-hero');
    const shapes = document.querySelectorAll('.shape');

    if (heroSection && shapes.length > 0) {
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const heroHeight = heroSection.offsetHeight;

            if (scrolled < heroHeight) {
                shapes.forEach((shape, index) => {
                    const speed = 0.2 + (index * 0.1);
                    const yPos = scrolled * speed;
                    shape.style.transform = `translateY(${yPos}px)`;
                });
            }
        });
    }

    // ===========================================
    // Mouse Movement Effect on Hero Card
    // ===========================================

    const heroCard = document.querySelector('.about-hero__card');

    if (heroCard) {
        document.addEventListener('mousemove', (e) => {
            const rect = heroCard.getBoundingClientRect();
            const cardCenterX = rect.left + rect.width / 2;
            const cardCenterY = rect.top + rect.height / 2;

            const angleX = (e.clientY - cardCenterY) / 30;
            const angleY = (cardCenterX - e.clientX) / 30;

            heroCard.style.transform = `perspective(1000px) rotateX(${angleX}deg) rotateY(${angleY}deg)`;
        });
    }

    // ===========================================
    // Highlight Items Stagger
    // ===========================================

    const highlightStack = document.querySelector('.highlight-stack');

    if (highlightStack) {
        const highlightObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const items = entry.target.querySelectorAll('.highlight-item');
                    items.forEach((item, index) => {
                        item.style.opacity = '0';
                        item.style.transform = 'translateX(-20px)';

                        setTimeout(() => {
                            item.style.transition = 'all 0.5s ease';
                            item.style.opacity = '1';
                            item.style.transform = 'translateX(0)';
                        }, index * 150);
                    });
                }
            });
        }, {
            threshold: 0.3
        });

        highlightObserver.observe(highlightStack);
    }

    // ===========================================
    // Smooth Scroll for Hero Scroll Indicator
    // ===========================================

    const scrollIndicator = document.querySelector('.about-hero__scroll');

    if (scrollIndicator) {
        scrollIndicator.addEventListener('click', () => {
            const profileSection = document.querySelector('.about-profile');
            if (profileSection) {
                profileSection.scrollIntoView({ behavior: 'smooth' });
            }
        });
        scrollIndicator.style.cursor = 'pointer';
    }

    // ===========================================
    // Tag Hover Sound Effect (Visual Feedback)
    // ===========================================

    const tags = document.querySelectorAll('.tag, .skill-tag');

    tags.forEach(tag => {
        tag.addEventListener('mouseenter', () => {
            tag.style.transition = 'all 0.15s ease';
        });
    });

    // ===========================================
    // Timeline Items Animation
    // ===========================================

    const timelineItems = document.querySelectorAll('.mini-timeline__item');

    const timelineObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const items = entry.target.closest('.bento-card')?.querySelectorAll('.mini-timeline__item');
                if (items) {
                    items.forEach((item, index) => {
                        item.style.opacity = '0';
                        item.style.transform = 'translateY(20px)';

                        setTimeout(() => {
                            item.style.transition = 'all 0.4s ease';
                            item.style.opacity = '1';
                            item.style.transform = 'translateY(0)';
                        }, index * 150);
                    });
                }
            }
        });
    }, {
        threshold: 0.5
    });

    if (timelineItems.length > 0) {
        const timelineCard = timelineItems[0].closest('.bento-card');
        if (timelineCard) {
            timelineObserver.observe(timelineCard);
        }
    }
});

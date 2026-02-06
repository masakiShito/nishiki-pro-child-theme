/**
 * Latest Posts Slider
 * 最新記事スライダーのアニメーションと機能
 */

class LatestPostsSlider {
    constructor() {
        this.slider = document.querySelector('.latest-posts__slider');
        this.slides = document.querySelectorAll('.post-slide');
        this.prevBtn = document.querySelector('.slider-nav--prev');
        this.nextBtn = document.querySelector('.slider-nav--next');
        this.indicatorsContainer = document.querySelector('.latest-posts__indicators');
        
        if (!this.slider || this.slides.length === 0) return;
        
        this.currentIndex = 0;
        this.autoPlayInterval = null;
        this.autoPlayDelay = 5000;
        this.isTransitioning = false;
        
        this.init();
    }
    
    init() {
        this.updateSlidesPerView();
        this.createIndicators();
        this.setupEventListeners();
        this.startAutoPlay();
        
        // 初期表示アニメーション
        this.animateOnScroll();
    }
    
    updateSlidesPerView() {
        const width = window.innerWidth;
        if (width <= 768) {
            this.slidesPerView = 1;
        } else if (width <= 1024) {
            this.slidesPerView = 2;
        } else {
            this.slidesPerView = 3;
        }
        
        this.maxIndex = Math.max(0, this.slides.length - this.slidesPerView);
        this.updateSlider();
    }
    
    createIndicators() {
        if (!this.indicatorsContainer) return;
        
        this.indicatorsContainer.innerHTML = '';
        const dotsNeeded = this.maxIndex + 1;
        
        for (let i = 0; i < dotsNeeded; i++) {
            const dot = document.createElement('button');
            dot.classList.add('indicator-dot');
            dot.setAttribute('aria-label', `スライド${i + 1}へ移動`);
            if (i === 0) dot.classList.add('active');
            
            dot.addEventListener('click', () => {
                this.goToSlide(i);
                this.resetAutoPlay();
            });
            
            this.indicatorsContainer.appendChild(dot);
        }
    }
    
    setupEventListeners() {
        // ナビゲーションボタン
        this.prevBtn?.addEventListener('click', () => {
            this.prev();
            this.resetAutoPlay();
        });
        
        this.nextBtn?.addEventListener('click', () => {
            this.next();
            this.resetAutoPlay();
        });
        
        // ホバーでオートプレイ一時停止
        this.slider.addEventListener('mouseenter', () => {
            this.stopAutoPlay();
        });
        
        this.slider.addEventListener('mouseleave', () => {
            this.startAutoPlay();
        });
        
        // リサイズ対応
        window.addEventListener('resize', () => {
            this.updateSlidesPerView();
            this.createIndicators();
        });
        
        // スワイプ対応
        this.setupTouchEvents();
    }
    
    setupTouchEvents() {
        let touchStartX = 0;
        let touchEndX = 0;
        
        this.slider.addEventListener('touchstart', (e) => {
            touchStartX = e.changedTouches[0].screenX;
        }, { passive: true });
        
        this.slider.addEventListener('touchend', (e) => {
            touchEndX = e.changedTouches[0].screenX;
            this.handleSwipe(touchStartX, touchEndX);
        }, { passive: true });
    }
    
    handleSwipe(startX, endX) {
        const diff = startX - endX;
        const threshold = 50;
        
        if (Math.abs(diff) > threshold) {
            if (diff > 0) {
                this.next();
            } else {
                this.prev();
            }
            this.resetAutoPlay();
        }
    }
    
    prev() {
        if (this.isTransitioning || this.currentIndex === 0) return;
        this.currentIndex--;
        this.updateSlider();
    }
    
    next() {
        if (this.isTransitioning || this.currentIndex >= this.maxIndex) return;
        this.currentIndex++;
        this.updateSlider();
    }
    
    goToSlide(index) {
        if (this.isTransitioning || index === this.currentIndex) return;
        this.currentIndex = Math.max(0, Math.min(index, this.maxIndex));
        this.updateSlider();
    }
    
    updateSlider() {
        if (!this.slider) return;
        
        this.isTransitioning = true;
        
        // スライド移動
        const slideWidth = this.slides[0].offsetWidth;
        const gap = 24; // CSS の gap と一致させる
        const offset = -(this.currentIndex * (slideWidth + gap));
        
        this.slider.style.transform = `translateX(${offset}px)`;
        
        // ボタンの有効/無効
        if (this.prevBtn) {
            this.prevBtn.disabled = this.currentIndex === 0;
        }
        if (this.nextBtn) {
            this.nextBtn.disabled = this.currentIndex >= this.maxIndex;
        }
        
        // インジケーター更新
        this.updateIndicators();
        
        // トランジション終了後
        setTimeout(() => {
            this.isTransitioning = false;
        }, 500);
    }
    
    updateIndicators() {
        const dots = this.indicatorsContainer?.querySelectorAll('.indicator-dot');
        if (!dots) return;
        
        dots.forEach((dot, i) => {
            dot.classList.toggle('active', i === this.currentIndex);
        });
    }
    
    startAutoPlay() {
        this.stopAutoPlay();
        this.autoPlayInterval = setInterval(() => {
            if (this.currentIndex >= this.maxIndex) {
                this.goToSlide(0);
            } else {
                this.next();
            }
        }, this.autoPlayDelay);
    }
    
    stopAutoPlay() {
        if (this.autoPlayInterval) {
            clearInterval(this.autoPlayInterval);
            this.autoPlayInterval = null;
        }
    }
    
    resetAutoPlay() {
        this.stopAutoPlay();
        this.startAutoPlay();
    }
    
    animateOnScroll() {
        const observer = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        // スライドを順番にフェードイン
                        this.slides.forEach((slide, i) => {
                            setTimeout(() => {
                                slide.style.opacity = '0';
                                slide.style.transform = 'translateY(30px)';
                                slide.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                                
                                requestAnimationFrame(() => {
                                    slide.style.opacity = '1';
                                    slide.style.transform = 'translateY(0)';
                                });
                            }, i * 100);
                        });
                        
                        observer.unobserve(entry.target);
                    }
                });
            },
            { threshold: 0.2 }
        );
        
        if (this.slider) {
            observer.observe(this.slider);
        }
    }
}

// 初期化
document.addEventListener('DOMContentLoaded', () => {
    new LatestPostsSlider();
});

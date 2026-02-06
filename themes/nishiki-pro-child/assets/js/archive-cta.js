/**
 * Archive CTA
 * 記事一覧への導線アニメーション
 */

class ArchiveCTA {
    constructor() {
        this.section = document.querySelector('.archive-cta');
        this.cards = document.querySelectorAll('.archive-cta__card');
        this.icons = document.querySelectorAll('.archive-cta__icon');
        
        if (!this.section) return;
        
        this.init();
    }
    
    init() {
        this.animateOnScroll();
        this.setupCardHover();
        this.setupIconPulse();
    }
    
    animateOnScroll() {
        const observer = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        // カードを順番にフェードイン
                        this.cards.forEach((card, i) => {
                            setTimeout(() => {
                                card.style.opacity = '0';
                                card.style.transform = 'translateY(40px)';
                                card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                                
                                requestAnimationFrame(() => {
                                    card.style.opacity = '1';
                                    card.style.transform = 'translateY(0)';
                                });
                            }, i * 200);
                        });
                        
                        observer.unobserve(entry.target);
                    }
                });
            },
            { threshold: 0.2 }
        );
        
        observer.observe(this.section);
    }
    
    setupCardHover() {
        this.cards.forEach((card) => {
            const icon = card.querySelector('.archive-cta__icon');
            
            card.addEventListener('mouseenter', () => {
                if (icon) {
                    icon.style.transition = 'transform 0.3s ease';
                }
            });
        });
    }
    
    setupIconPulse() {
        // ランダムな間隔でアイコンにパルスアニメーション
        this.icons.forEach((icon, index) => {
            const pulse = () => {
                icon.style.transition = 'transform 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55)';
                icon.style.transform = 'scale(1.15) rotate(5deg)';
                
                setTimeout(() => {
                    icon.style.transform = 'scale(1) rotate(0deg)';
                }, 400);
                
                // 4〜8秒のランダムな間隔で再実行
                const delay = 4000 + Math.random() * 4000;
                setTimeout(pulse, delay);
            };
            
            // 各アイコンで異なるタイミングで開始
            const initialDelay = 3000 + (index * 1500);
            setTimeout(pulse, initialDelay);
        });
    }
}

// 初期化
document.addEventListener('DOMContentLoaded', () => {
    new ArchiveCTA();
});

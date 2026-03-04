/**
 * Features Section - おしゃれなアニメーション
 */

document.addEventListener('DOMContentLoaded', function() {
    const featureCards = document.querySelectorAll('.feature-card');

    if (featureCards.length === 0) return;

    // タッチデバイス（モバイル）かどうかを判定
    const isTouchDevice = window.matchMedia('(hover: none)').matches;

    // 1. スクロールで順番にフェードイン
    const observerOptions = {
        threshold: 0.2,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const card = entry.target;
                const index = card.getAttribute('data-index') || 0;

                setTimeout(() => {
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0) scale(1)';
                }, index * 150);

                observer.unobserve(card);
            }
        });
    }, observerOptions);

    // 初期状態を設定
    featureCards.forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(50px) scale(0.95)';
        card.style.transition = 'opacity 0.8s ease, transform 0.8s ease';
        observer.observe(card);
    });

    // 2. アイコンの回転アニメーション（ホバー時）- PC のみ
    if (!isTouchDevice) {
        featureCards.forEach(card => {
            const icon = card.querySelector('.feature-card__icon');

            card.addEventListener('mouseenter', () => {
                icon.style.animation = 'iconBounce 0.6s ease';
            });

            card.addEventListener('mouseleave', () => {
                icon.style.animation = 'none';
            });
        });
    }

    // 3. リストアイテムの順次表示
    featureCards.forEach(card => {
        const listItems = card.querySelectorAll('.feature-card__list li');

        if (isTouchDevice) {
            // モバイル: ホバーなしでリストアイテムをそのまま表示
            listItems.forEach(item => {
                item.style.opacity = '1';
                item.style.transform = 'translateX(0)';
            });
            return;
        }

        listItems.forEach((item, index) => {
            item.style.opacity = '0';
            item.style.transform = 'translateX(-10px)';
            item.style.transition = 'opacity 0.4s ease, transform 0.4s ease';
        });

        card.addEventListener('mouseenter', () => {
            listItems.forEach((item, index) => {
                setTimeout(() => {
                    item.style.opacity = '1';
                    item.style.transform = 'translateX(0)';
                }, index * 80);
            });
        }, { once: true });
    });

    // 4. カードのパルスエフェクト（ランダム）
    function addPulse() {
        const randomCard = featureCards[Math.floor(Math.random() * featureCards.length)];
        const icon = randomCard.querySelector('.feature-card__icon');
        
        if (icon) {
            icon.style.animation = 'iconPulse 1s ease-out';
            setTimeout(() => {
                icon.style.animation = 'none';
            }, 1000);
        }
    }

    // 5秒ごとにランダムなカードのアイコンがパルス
    setInterval(addPulse, 5000);

    // CSSアニメーションを追加
    if (!document.getElementById('feature-animations')) {
        const style = document.createElement('style');
        style.id = 'feature-animations';
        style.textContent = `
            @keyframes iconBounce {
                0%, 100% {
                    transform: scale(1) rotate(0deg);
                }
                25% {
                    transform: scale(1.1) rotate(-5deg);
                }
                50% {
                    transform: scale(1.15) rotate(5deg);
                }
                75% {
                    transform: scale(1.1) rotate(-3deg);
                }
            }
            
            @keyframes iconPulse {
                0% {
                    transform: scale(1);
                    box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
                }
                50% {
                    transform: scale(1.05);
                }
                100% {
                    transform: scale(1);
                    box-shadow: 0 0 0 20px rgba(16, 185, 129, 0);
                }
            }
        `;
        document.head.appendChild(style);
    }

    console.log('🎨 Features animations loaded!');
});

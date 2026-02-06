/**
 * Footer CTA Section - インタラクティブなアニメーション
 */

document.addEventListener('DOMContentLoaded', function() {
    const ctaCard = document.querySelector('.onesta-footer-cta');
    const ctaIcon = document.querySelector('.onesta-footer-cta__icon');
    const ctaButton = document.querySelector('.onesta-footer-cta__button');
    const ctaBadge = document.querySelector('.onesta-footer-cta__badge');

    if (!ctaCard) return;

    // 1. スクロールで要素がビューポートに入ったらアニメーション
    const observerOptions = {
        threshold: 0.2,
        rootMargin: '0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                ctaCard.classList.add('is-visible');
                
                // アイコンを順番にアニメーション
                setTimeout(() => {
                    if (ctaIcon) ctaIcon.classList.add('is-animated');
                }, 200);
                
                setTimeout(() => {
                    if (ctaBadge) ctaBadge.classList.add('is-animated');
                }, 400);
                
                setTimeout(() => {
                    if (ctaButton) ctaButton.classList.add('is-animated');
                }, 600);
            }
        });
    }, observerOptions);

    observer.observe(ctaCard);

    // 2. マウスの動きに応じてカード内の要素が微妙に動く（3D効果）
    ctaCard.addEventListener('mousemove', (e) => {
        const rect = ctaCard.getBoundingClientRect();
        const x = (e.clientX - rect.left) / rect.width - 0.5;
        const y = (e.clientY - rect.top) / rect.height - 0.5;
        
        // アイコンを動かす
        if (ctaIcon) {
            ctaIcon.style.transform = `
                scale(1.1) 
                rotate(5deg) 
                translate(${x * 20}px, ${y * 20}px)
            `;
        }
        
        // バッジを動かす
        if (ctaBadge) {
            ctaBadge.style.transform = `translate(${x * -15}px, ${y * -15}px)`;
        }
    });

    // マウスが離れたら元の位置に戻す
    ctaCard.addEventListener('mouseleave', () => {
        if (ctaIcon) {
            ctaIcon.style.transform = '';
        }
        if (ctaBadge) {
            ctaBadge.style.transform = '';
        }
    });

    // 3. アイコンをクリックするとパルス効果
    if (ctaIcon) {
        ctaIcon.addEventListener('click', () => {
            ctaIcon.classList.add('pulse');
            setTimeout(() => {
                ctaIcon.classList.remove('pulse');
            }, 600);
        });
    }

    // 4. ボタンにキラキラエフェクト（ランダムな位置に星）
    if (ctaButton) {
        ctaButton.addEventListener('mouseenter', () => {
            createSparks(ctaButton);
        });
    }

    function createSparks(element) {
        for (let i = 0; i < 6; i++) {
            setTimeout(() => {
                const spark = document.createElement('span');
                spark.className = 'spark';
                spark.style.left = `${Math.random() * 100}%`;
                spark.style.top = `${Math.random() * 100}%`;
                spark.innerHTML = '✨';
                element.appendChild(spark);

                setTimeout(() => {
                    spark.remove();
                }, 1000);
            }, i * 100);
        }
    }

    // 5. カード全体にマグネティックエフェクト
    let boundingRect = ctaCard.getBoundingClientRect();
    
    window.addEventListener('resize', () => {
        boundingRect = ctaCard.getBoundingClientRect();
    });

    document.addEventListener('mousemove', (e) => {
        const distanceX = e.clientX - (boundingRect.left + boundingRect.width / 2);
        const distanceY = e.clientY - (boundingRect.top + boundingRect.height / 2);
        const distance = Math.sqrt(distanceX * distanceX + distanceY * distanceY);
        
        // カードの近くにマウスがあるとき
        if (distance < 300) {
            const strength = (300 - distance) / 300;
            const moveX = (distanceX / distance) * strength * 15;
            const moveY = (distanceY / distance) * strength * 15;
            
            ctaCard.style.transform = `translateY(-8px) translate(${moveX}px, ${moveY}px)`;
        } else {
            ctaCard.style.transform = '';
        }
    });

    // 6. バッジをクリックすると回転
    if (ctaBadge) {
        ctaBadge.addEventListener('click', (e) => {
            e.preventDefault();
            ctaBadge.style.animation = 'spin 0.6s ease';
            setTimeout(() => {
                ctaBadge.style.animation = '';
            }, 600);
        });
    }
});

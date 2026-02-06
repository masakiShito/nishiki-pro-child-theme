/**
 * Categories Section - おしゃれなアニメーション
 */

document.addEventListener('DOMContentLoaded', function() {
    const categoryCards = document.querySelectorAll('.category-card');
    
    if (categoryCards.length === 0) return;

    // 1. スクロールで順番にフェードイン
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -100px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const card = entry.target;
                const index = card.getAttribute('data-index') || 0;
                
                setTimeout(() => {
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 100);
                
                observer.unobserve(card);
            }
        });
    }, observerOptions);

    // 初期状態を設定してオブザーバーに登録
    categoryCards.forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(card);
    });

    // 2. マウスの位置に応じてカードが傾く（3D効果）
    categoryCards.forEach(card => {
        const inner = card.querySelector('.category-card__inner');
        
        card.addEventListener('mousemove', (e) => {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            const centerX = rect.width / 2;
            const centerY = rect.height / 2;
            
            const rotateX = (y - centerY) / 20;
            const rotateY = (centerX - x) / 20;
            
            inner.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale3d(1.02, 1.02, 1.02)`;
        });
        
        card.addEventListener('mouseleave', () => {
            inner.style.transform = 'perspective(1000px) rotateX(0) rotateY(0) scale3d(1, 1, 1)';
        });
    });

    // 3. カードタイトルの文字を1つずつ表示
    categoryCards.forEach((card, cardIndex) => {
        const title = card.querySelector('.category-card__title');
        if (!title) return;
        
        const text = title.textContent;
        title.innerHTML = '';
        
        text.split('').forEach((char, index) => {
            const span = document.createElement('span');
            span.textContent = char;
            span.style.display = 'inline-block';
            span.style.opacity = '0';
            span.style.transform = 'translateY(10px)';
            span.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
            title.appendChild(span);
        });
        
        // カードが表示されたら文字を順番に表示
        card.addEventListener('mouseenter', () => {
            const spans = title.querySelectorAll('span');
            spans.forEach((span, index) => {
                setTimeout(() => {
                    span.style.opacity = '1';
                    span.style.transform = 'translateY(0)';
                }, index * 30);
            });
        }, { once: true });
    });

    // 4. ランダムな順序でカードが光る（キラキラエフェクト）
    function addSparkle() {
        const randomCard = categoryCards[Math.floor(Math.random() * categoryCards.length)];
        const sparkle = document.createElement('div');
        sparkle.style.position = 'absolute';
        sparkle.style.width = '4px';
        sparkle.style.height = '4px';
        sparkle.style.borderRadius = '50%';
        sparkle.style.background = '#10b981';
        sparkle.style.left = Math.random() * 100 + '%';
        sparkle.style.top = Math.random() * 100 + '%';
        sparkle.style.opacity = '0';
        sparkle.style.animation = 'sparkle 1.5s ease-out forwards';
        sparkle.style.pointerEvents = 'none';
        
        randomCard.appendChild(sparkle);
        
        setTimeout(() => sparkle.remove(), 1500);
    }

    // CSSアニメーションを追加
    if (!document.getElementById('category-sparkle-animation')) {
        const style = document.createElement('style');
        style.id = 'category-sparkle-animation';
        style.textContent = `
            @keyframes sparkle {
                0% {
                    opacity: 0;
                    transform: scale(0);
                }
                50% {
                    opacity: 1;
                    transform: scale(1);
                }
                100% {
                    opacity: 0;
                    transform: scale(0) translateY(-20px);
                }
            }
        `;
        document.head.appendChild(style);
    }

    // 3秒ごとにキラキラ
    setInterval(addSparkle, 3000);

    console.log('✨ Category animations loaded!');
});

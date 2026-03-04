/**
 * Hero Section - かっこいいアニメーション
 */

document.addEventListener('DOMContentLoaded', function() {
    const heroTitle = document.querySelector('.hero__title');
    const heroSubtitle = document.querySelector('.hero__subtitle');
    const heroLabel = document.querySelector('.hero__label');
    const heroSide = document.querySelector('.hero__side');
    const heroMain = document.querySelector('.hero__main');

    // 1. 文字を1文字ずつspanで囲む（タイトル）
    if (heroTitle) {
        const text = heroTitle.textContent;
        heroTitle.innerHTML = '';
        
        text.split('').forEach((char, index) => {
            const span = document.createElement('span');
            span.textContent = char;
            span.style.display = 'inline-block';
            span.style.opacity = '0';
            span.style.transform = 'translateY(30px)';
            span.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            heroTitle.appendChild(span);
            
            // 順番に表示
            setTimeout(() => {
                span.style.opacity = '1';
                span.style.transform = 'translateY(0)';
            }, 50 * index);
        });
    }

    // 2. マウスに追従する微妙な動き（パララックス効果）
    if (heroMain) {
        heroMain.addEventListener('mousemove', (e) => {
            const rect = heroMain.getBoundingClientRect();
            const x = (e.clientX - rect.left) / rect.width - 0.5;
            const y = (e.clientY - rect.top) / rect.height - 0.5;
            
            if (heroTitle) {
                heroTitle.style.transform = `translate(${x * 20}px, ${y * 20}px)`;
            }
            if (heroSubtitle) {
                heroSubtitle.style.transform = `translate(${x * 10}px, ${y * 10}px)`;
            }
            if (heroLabel) {
                heroLabel.style.transform = `translate(${x * 5}px, ${y * 5}px)`;
            }
        });

        heroMain.addEventListener('mouseleave', () => {
            if (heroTitle) heroTitle.style.transform = 'translate(0, 0)';
            if (heroSubtitle) heroSubtitle.style.transform = 'translate(0, 0)';
            if (heroLabel) heroLabel.style.transform = 'translate(0, 0)';
        });
    }

    // 3. スクロールで左側がスライドアウト（パララックス）
    // モバイルでは単列レイアウトのため無効化
    window.addEventListener('scroll', () => {
        if (window.innerWidth <= 768) {
            // モバイル: インラインスタイルをリセット
            if (heroSide) {
                heroSide.style.transform = '';
                heroSide.style.opacity = '';
            }
            if (heroMain) heroMain.style.transform = '';
            return;
        }

        const scrolled = window.pageYOffset;
        const maxScroll = window.innerHeight;

        if (heroSide && scrolled < maxScroll) {
            const translateX = -(scrolled / maxScroll) * 30;
            const opacity = 1 - (scrolled / maxScroll);
            heroSide.style.transform = `translateX(${translateX}%)`;
            heroSide.style.opacity = Math.max(opacity, 0);
        }

        if (heroMain && scrolled < maxScroll) {
            const translateX = (scrolled / maxScroll) * 20;
            heroMain.style.transform = `translateX(${translateX}%)`;
        }
    });

    // 4. 左側の文字を順番にフェードイン
    const sideTexts = document.querySelectorAll('.hero__side-text');
    sideTexts.forEach((text, index) => {
        text.style.opacity = '0';
        text.style.transform = 'translateX(-30px)';
        text.style.transition = 'opacity 0.8s ease, transform 0.8s ease';
        
        setTimeout(() => {
            text.style.opacity = '1';
            text.style.transform = 'translateX(0)';
        }, 800 + (index * 200));
    });

    // 5. タイトルにカーソルを合わせると文字が少し浮く
    if (heroTitle) {
        heroTitle.addEventListener('mouseenter', () => {
            const spans = heroTitle.querySelectorAll('span');
            spans.forEach((span, index) => {
                setTimeout(() => {
                    span.style.transform = 'translateY(-5px)';
                    setTimeout(() => {
                        span.style.transform = 'translateY(0)';
                    }, 200);
                }, index * 30);
            });
        });
    }

    console.log('🎨 Hero animations loaded!');
});

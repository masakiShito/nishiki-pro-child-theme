/**
 * Header Enhancement - ヘッダーの動的エフェクト
 */

document.addEventListener('DOMContentLoaded', function() {
    const header = document.getElementById('masthead');
    let lastScrollTop = 0;
    let scrollTimeout;

    if (!header) return;

    // スクロール時のヘッダー変化
    window.addEventListener('scroll', function() {
        clearTimeout(scrollTimeout);
        
        scrollTimeout = setTimeout(() => {
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            
            // スクロールダウン（50px以上）
            if (scrollTop > 50) {
                document.body.classList.add('scrolled');
            } else {
                document.body.classList.remove('scrolled');
            }
            
            lastScrollTop = scrollTop;
        }, 10);
    });

    // 検索オーバーレイ
    const searchToggle = document.querySelector('.search-toggle');
    const searchOverlay = document.getElementById('search-overlay');
    
    if (searchToggle && searchOverlay) {
        searchToggle.addEventListener('click', () => {
            searchOverlay.classList.add('is-open');
            document.body.style.overflow = 'hidden';
            
            // 検索フォームにフォーカス
            const searchInput = searchOverlay.querySelector('input[type="search"]');
            if (searchInput) {
                setTimeout(() => searchInput.focus(), 100);
            }
        });
        
        const searchClose = searchOverlay.querySelector('.close');
        if (searchClose) {
            searchClose.addEventListener('click', () => {
                searchOverlay.classList.remove('is-open');
                document.body.style.overflow = '';
            });
        }
        
        // オーバーレイ外をクリックで閉じる
        searchOverlay.addEventListener('click', (e) => {
            if (e.target === searchOverlay) {
                searchOverlay.classList.remove('is-open');
                document.body.style.overflow = '';
            }
        });
    }

    // メニューオーバーレイ
    const menuToggle = document.querySelector('.menu-toggle');
    const menuOverlay = document.getElementById('menu-overlay');
    
    if (menuToggle && menuOverlay) {
        menuToggle.addEventListener('click', () => {
            menuOverlay.classList.add('is-open');
            document.body.style.overflow = 'hidden';
        });
        
        const menuClose = menuOverlay.querySelector('.close');
        if (menuClose) {
            menuClose.addEventListener('click', () => {
                menuOverlay.classList.remove('is-open');
                document.body.style.overflow = '';
            });
        }
        
        // オーバーレイ外をクリックで閉じる
        menuOverlay.addEventListener('click', (e) => {
            if (e.target === menuOverlay) {
                menuOverlay.classList.remove('is-open');
                document.body.style.overflow = '';
            }
        });
    }

    // ESCキーで閉じる
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            if (searchOverlay && searchOverlay.classList.contains('is-open')) {
                searchOverlay.classList.remove('is-open');
                document.body.style.overflow = '';
            }
            if (menuOverlay && menuOverlay.classList.contains('is-open')) {
                menuOverlay.classList.remove('is-open');
                document.body.style.overflow = '';
            }
        }
    });

    // メニューアイテムにリップルエフェクト
    const menuLinks = header.querySelectorAll('.menu-items a, ul.menu a, .category-link');
    
    menuLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            const ripple = document.createElement('span');
            ripple.classList.add('ripple');
            
            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = e.clientX - rect.left - size / 2;
            const y = e.clientY - rect.top - size / 2;
            
            ripple.style.width = ripple.style.height = size + 'px';
            ripple.style.left = x + 'px';
            ripple.style.top = y + 'px';
            
            this.appendChild(ripple);
            
            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
    });

    // ロゴ/タイトルにパララックス効果
    const siteInfo = header.querySelector('.site-info');
    
    if (siteInfo) {
        header.addEventListener('mousemove', (e) => {
            const rect = header.getBoundingClientRect();
            const x = (e.clientX - rect.left) / rect.width - 0.5;
            const y = (e.clientY - rect.top) / rect.height - 0.5;
            
            siteInfo.style.transform = `translate(${x * 10}px, ${y * 5}px)`;
        });
        
        header.addEventListener('mouseleave', () => {
            siteInfo.style.transform = '';
        });
    }

    // スクロール位置のインジケーター
    const progressBar = document.createElement('div');
    progressBar.classList.add('scroll-progress');
    header.appendChild(progressBar);
    
    window.addEventListener('scroll', () => {
        const windowHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        const scrolled = (window.pageYOffset / windowHeight) * 100;
        progressBar.style.width = scrolled + '%';
    });

    // カテゴリーナビのスムーズスクロール
    const categoryList = document.querySelector('.category-list');
    if (categoryList) {
        let isDown = false;
        let startX;
        let scrollLeft;

        categoryList.addEventListener('mousedown', (e) => {
            isDown = true;
            categoryList.style.cursor = 'grabbing';
            startX = e.pageX - categoryList.offsetLeft;
            scrollLeft = categoryList.scrollLeft;
        });

        categoryList.addEventListener('mouseleave', () => {
            isDown = false;
            categoryList.style.cursor = 'grab';
        });

        categoryList.addEventListener('mouseup', () => {
            isDown = false;
            categoryList.style.cursor = 'grab';
        });

        categoryList.addEventListener('mousemove', (e) => {
            if (!isDown) return;
            e.preventDefault();
            const x = e.pageX - categoryList.offsetLeft;
            const walk = (x - startX) * 2;
            categoryList.scrollLeft = scrollLeft - walk;
        });
    }
});

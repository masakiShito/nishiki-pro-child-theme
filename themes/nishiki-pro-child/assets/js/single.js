/**
 * Single Article - 記事ページ用JavaScript
 * Enhanced with animations and smooth interactions
 */

(function() {
    'use strict';

    document.addEventListener('DOMContentLoaded', init);

    function init() {
        initTableOfContents();
        initScrollSpy();
        initCopyButton();
        initHeadingAnchors();
        initExternalLinks();
        initImageLightbox();
        initScrollAnimations();
        initProgressBar();
        initSmoothScroll();
    }

    // ===========================================
    // Table of Contents (目次) 自動生成
    // ===========================================

    function initTableOfContents() {
        const articleContent = document.querySelector('.article-content');
        const tocList = document.querySelector('.article-toc__list');
        const tocWidget = tocList?.closest('.sidebar-widget');

        if (!articleContent || !tocList) return;

        const headings = articleContent.querySelectorAll('h2, h3');

        if (headings.length === 0) {
            if (tocWidget) tocWidget.style.display = 'none';
            return;
        }

        headings.forEach((heading, index) => {
            // IDを付与
            const id = `section-${index + 1}`;
            heading.id = id;

            // 目次項目を作成
            const li = document.createElement('li');
            li.className = heading.tagName === 'H3' ? 'toc-item--sub' : '';

            const a = document.createElement('a');
            a.href = `#${id}`;
            a.textContent = heading.textContent;
            a.dataset.target = id;

            li.appendChild(a);
            tocList.appendChild(li);
        });
    }

    // ===========================================
    // Scroll Spy - 現在位置の目次をハイライト
    // ===========================================

    function initScrollSpy() {
        const tocLinks = document.querySelectorAll('.article-toc__list a');
        const headings = document.querySelectorAll('.article-content h2, .article-content h3');

        if (!tocLinks.length || !headings.length) return;

        const headerHeight = document.querySelector('.site-header')?.offsetHeight || 80;

        const observerOptions = {
            root: null,
            rootMargin: `-${headerHeight + 50}px 0px -60% 0px`,
            threshold: 0
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                const id = entry.target.id;
                const tocLink = document.querySelector(`.article-toc__list a[href="#${id}"]`);

                if (entry.isIntersecting) {
                    // すべてのアクティブクラスを削除
                    tocLinks.forEach(link => link.classList.remove('is-active'));
                    // 現在の項目をアクティブに
                    if (tocLink) tocLink.classList.add('is-active');
                }
            });
        }, observerOptions);

        headings.forEach(heading => observer.observe(heading));
    }

    // ===========================================
    // スムーススクロール
    // ===========================================

    function initSmoothScroll() {
        const tocLinks = document.querySelectorAll('.article-toc__list a');
        const headerHeight = document.querySelector('.site-header')?.offsetHeight || 80;

        tocLinks.forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                const targetId = link.getAttribute('href').slice(1);
                const target = document.getElementById(targetId);

                if (target) {
                    const targetPosition = target.getBoundingClientRect().top + window.pageYOffset - headerHeight - 30;

                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });

                    // URLを更新（履歴に残す）
                    history.pushState(null, '', `#${targetId}`);
                }
            });
        });
    }

    // ===========================================
    // コピーボタン（トースト通知付き）
    // ===========================================

    function initCopyButton() {
        const copyButton = document.querySelector('.article-share__button--copy');

        if (!copyButton) return;

        copyButton.addEventListener('click', async () => {
            const url = copyButton.dataset.url;

            try {
                await navigator.clipboard.writeText(url);

                // ボタンのフィードバック
                copyButton.classList.add('copied');
                const originalHTML = copyButton.innerHTML;
                copyButton.innerHTML = `
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="20 6 9 17 4 12"/>
                    </svg>
                `;

                // トースト通知を表示
                showToast('URLをコピーしました');

                setTimeout(() => {
                    copyButton.classList.remove('copied');
                    copyButton.innerHTML = originalHTML;
                }, 2500);

            } catch (err) {
                showToast('コピーに失敗しました', 'error');
                console.error('Failed to copy:', err);
            }
        });
    }

    function showToast(message, type = 'success') {
        // 既存のトーストを削除
        const existingToast = document.querySelector('.copy-toast');
        if (existingToast) existingToast.remove();

        const toast = document.createElement('div');
        toast.className = 'copy-toast';
        toast.textContent = message;

        if (type === 'error') {
            toast.style.background = '#ef4444';
        }

        document.body.appendChild(toast);

        // アニメーション
        requestAnimationFrame(() => {
            toast.classList.add('show');
        });

        setTimeout(() => {
            toast.classList.remove('show');
            setTimeout(() => toast.remove(), 400);
        }, 2500);
    }

    // ===========================================
    // 見出しへのアンカーリンク追加
    // ===========================================

    function initHeadingAnchors() {
        const articleContent = document.querySelector('.article-content');
        if (!articleContent) return;

        const headings = articleContent.querySelectorAll('h2, h3, h4');

        headings.forEach(heading => {
            if (!heading.id) return;

            const anchor = document.createElement('a');
            anchor.href = `#${heading.id}`;
            anchor.className = 'heading-anchor';
            anchor.innerHTML = `
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/>
                    <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/>
                </svg>
            `;
            anchor.setAttribute('aria-label', 'この見出しへのリンク');

            heading.appendChild(anchor);

            // ホバー時にアンカーを表示
            heading.addEventListener('mouseenter', () => {
                anchor.style.opacity = '1';
            });
            heading.addEventListener('mouseleave', () => {
                anchor.style.opacity = '0';
            });
        });

        // スタイルを追加
        const style = document.createElement('style');
        style.textContent = `
            .heading-anchor {
                position: absolute;
                left: -28px;
                top: 50%;
                transform: translateY(-50%);
                opacity: 0;
                color: var(--accent);
                transition: opacity 0.2s ease;
                padding: 4px;
            }
            .heading-anchor:hover {
                color: var(--accent-dark);
            }
            .article-content h2,
            .article-content h3,
            .article-content h4 {
                position: relative;
            }
        `;
        document.head.appendChild(style);
    }

    // ===========================================
    // 外部リンクの処理
    // ===========================================

    function initExternalLinks() {
        const articleContent = document.querySelector('.article-content');
        if (!articleContent) return;

        const links = articleContent.querySelectorAll('a');

        links.forEach(link => {
            const href = link.getAttribute('href');
            if (!href) return;

            // 外部リンクの判定
            if (href.startsWith('http') && !href.includes(window.location.hostname)) {
                link.setAttribute('target', '_blank');
                link.setAttribute('rel', 'noopener noreferrer');

                // 外部リンクアイコンを追加
                if (!link.querySelector('.external-icon')) {
                    const icon = document.createElement('span');
                    icon.className = 'external-icon';
                    icon.innerHTML = `
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display: inline; vertical-align: middle; margin-left: 2px;">
                            <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/>
                            <polyline points="15 3 21 3 21 9"/>
                            <line x1="10" y1="14" x2="21" y2="3"/>
                        </svg>
                    `;
                    link.appendChild(icon);
                }
            }
        });
    }

    // ===========================================
    // 画像のLightbox風表示
    // ===========================================

    function initImageLightbox() {
        const articleContent = document.querySelector('.article-content');
        if (!articleContent) return;

        const images = articleContent.querySelectorAll('img');

        images.forEach(img => {
            img.addEventListener('click', () => {
                openImageModal(img.src, img.alt);
            });
        });
    }

    function openImageModal(src, alt) {
        const existingModal = document.getElementById('image-modal');
        if (existingModal) existingModal.remove();

        const modal = document.createElement('div');
        modal.id = 'image-modal';
        modal.innerHTML = `
            <div class="image-modal__overlay"></div>
            <div class="image-modal__content">
                <img src="${src}" alt="${alt || ''}" class="image-modal__img">
                <button type="button" class="image-modal__close" aria-label="閉じる">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M18 6L6 18M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        `;

        // スタイル
        const style = document.createElement('style');
        style.id = 'image-modal-style';
        style.textContent = `
            #image-modal {
                position: fixed;
                inset: 0;
                z-index: 10000;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 20px;
            }
            .image-modal__overlay {
                position: absolute;
                inset: 0;
                background: rgba(0, 0, 0, 0.9);
                opacity: 0;
                transition: opacity 0.4s ease;
            }
            #image-modal.is-open .image-modal__overlay {
                opacity: 1;
            }
            .image-modal__content {
                position: relative;
                max-width: 95vw;
                max-height: 95vh;
                opacity: 0;
                transform: scale(0.9);
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            }
            #image-modal.is-open .image-modal__content {
                opacity: 1;
                transform: scale(1);
            }
            .image-modal__img {
                max-width: 100%;
                max-height: 90vh;
                object-fit: contain;
                border-radius: 8px;
                box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
            }
            .image-modal__close {
                position: absolute;
                top: -50px;
                right: 0;
                background: rgba(255, 255, 255, 0.1);
                border: none;
                color: #fff;
                width: 44px;
                height: 44px;
                border-radius: 50%;
                cursor: pointer;
                display: flex;
                align-items: center;
                justify-content: center;
                transition: all 0.3s ease;
            }
            .image-modal__close:hover {
                background: rgba(255, 255, 255, 0.2);
                transform: rotate(90deg);
            }
        `;

        if (!document.getElementById('image-modal-style')) {
            document.head.appendChild(style);
        }

        document.body.appendChild(modal);
        document.body.style.overflow = 'hidden';

        requestAnimationFrame(() => {
            modal.classList.add('is-open');
        });

        const closeModal = () => {
            modal.classList.remove('is-open');
            setTimeout(() => {
                modal.remove();
                document.body.style.overflow = '';
            }, 400);
        };

        modal.querySelector('.image-modal__overlay').addEventListener('click', closeModal);
        modal.querySelector('.image-modal__close').addEventListener('click', closeModal);
        document.addEventListener('keydown', function escHandler(e) {
            if (e.key === 'Escape') {
                closeModal();
                document.removeEventListener('keydown', escHandler);
            }
        });
    }

    // ===========================================
    // スクロールアニメーション
    // ===========================================

    function initScrollAnimations() {
        const observerOptions = {
            root: null,
            rootMargin: '0px 0px -100px 0px',
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

        // アニメーション対象の要素を監視
        const animatedElements = document.querySelectorAll(
            '.related-card, .post-navigation__item'
        );
        animatedElements.forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(30px)';
            el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(el);
        });

        // is-visibleクラスが追加されたときのスタイル
        const style = document.createElement('style');
        style.textContent = `
            .related-card.is-visible,
            .post-navigation__item.is-visible {
                opacity: 1 !important;
                transform: translateY(0) !important;
            }
        `;
        document.head.appendChild(style);
    }

    // ===========================================
    // 読書プログレス（左下フローティングバッジ）
    // ===========================================

    function initProgressBar() {
        const articleBody = document.querySelector('.article-body');
        if (!articleBody) return;

        // フローティングバッジを作成
        const progressBadge = document.createElement('div');
        progressBadge.className = 'reading-progress-badge';
        progressBadge.innerHTML = `
            <div class="reading-progress-badge__inner">
                <svg class="reading-progress-badge__circle" viewBox="0 0 36 36">
                    <path class="reading-progress-badge__bg"
                        d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
                        fill="none"
                        stroke-width="3"
                    />
                    <path class="reading-progress-badge__fill"
                        d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
                        fill="none"
                        stroke-width="3"
                        stroke-dasharray="0, 100"
                    />
                </svg>
                <span class="reading-progress-badge__percent">0%</span>
            </div>
            <span class="reading-progress-badge__label">読破まで</span>
        `;
        document.body.appendChild(progressBadge);

        const circleFill = progressBadge.querySelector('.reading-progress-badge__fill');
        const percentEl = progressBadge.querySelector('.reading-progress-badge__percent');
        const labelEl = progressBadge.querySelector('.reading-progress-badge__label');

        // スタイル追加
        const style = document.createElement('style');
        style.textContent = `
            .reading-progress-badge {
                position: fixed;
                bottom: 30px;
                left: 30px;
                display: flex;
                align-items: center;
                gap: 12px;
                background: #ffffff;
                padding: 10px 18px 10px 10px;
                border-radius: 40px;
                box-shadow: 0 4px 24px rgba(0, 0, 0, 0.12);
                z-index: 999;
                opacity: 0;
                transform: translateY(20px);
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                cursor: default;
            }
            .reading-progress-badge.is-visible {
                opacity: 1;
                transform: translateY(0);
            }
            .reading-progress-badge:hover {
                transform: translateY(-4px);
                box-shadow: 0 8px 32px rgba(0, 0, 0, 0.16);
            }
            .reading-progress-badge__inner {
                position: relative;
                width: 44px;
                height: 44px;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .reading-progress-badge__circle {
                position: absolute;
                width: 100%;
                height: 100%;
                transform: rotate(-90deg);
            }
            .reading-progress-badge__bg {
                stroke: rgba(16, 185, 129, 0.15);
            }
            .reading-progress-badge__fill {
                stroke: var(--accent, #10b981);
                stroke-linecap: round;
                transition: stroke-dasharray 0.3s ease;
            }
            .reading-progress-badge__percent {
                font-size: 11px;
                font-weight: 800;
                color: var(--accent, #10b981);
                z-index: 1;
            }
            .reading-progress-badge__label {
                font-size: 13px;
                font-weight: 600;
                color: var(--text-secondary, #666);
                white-space: nowrap;
                min-width: 58px;
            }
            .reading-progress-badge.is-complete {
                background: linear-gradient(135deg, var(--accent, #10b981), #059669);
                padding-right: 20px;
            }
            .reading-progress-badge.is-complete .reading-progress-badge__percent {
                color: #ffffff;
            }
            .reading-progress-badge.is-complete .reading-progress-badge__label {
                color: #ffffff;
                min-width: auto;
            }
            .reading-progress-badge.is-complete .reading-progress-badge__bg {
                stroke: rgba(255, 255, 255, 0.3);
            }
            .reading-progress-badge.is-complete .reading-progress-badge__fill {
                stroke: #ffffff;
            }
            @media (max-width: 768px) {
                .reading-progress-badge {
                    bottom: 20px;
                    left: 20px;
                    padding: 8px 14px 8px 8px;
                    gap: 10px;
                }
                .reading-progress-badge__inner {
                    width: 38px;
                    height: 38px;
                }
                .reading-progress-badge__percent {
                    font-size: 10px;
                }
                .reading-progress-badge__label {
                    font-size: 12px;
                }
            }
        `;
        document.head.appendChild(style);

        // スクロール監視
        let ticking = false;
        let isVisible = false;

        window.addEventListener('scroll', () => {
            if (!ticking) {
                requestAnimationFrame(() => {
                    const articleTop = articleBody.offsetTop;
                    const articleHeight = articleBody.offsetHeight;
                    const scrollTop = window.scrollY;
                    const windowHeight = window.innerHeight;

                    // 記事エリアに入ったら表示
                    const shouldShow = scrollTop > articleTop - windowHeight * 0.5;

                    if (shouldShow && !isVisible) {
                        progressBadge.classList.add('is-visible');
                        isVisible = true;
                    } else if (!shouldShow && isVisible) {
                        progressBadge.classList.remove('is-visible');
                        isVisible = false;
                    }

                    // 進捗計算
                    const progress = Math.max(0, Math.min(100,
                        ((scrollTop - articleTop + windowHeight * 0.5) / articleHeight) * 100
                    ));

                    const roundedProgress = Math.round(progress);

                    // 円グラフ更新
                    circleFill.setAttribute('stroke-dasharray', `${progress}, 100`);
                    percentEl.textContent = `${roundedProgress}%`;

                    // 100%達成時の特別表示
                    if (roundedProgress >= 100) {
                        progressBadge.classList.add('is-complete');
                        labelEl.textContent = '読破！';
                    } else {
                        progressBadge.classList.remove('is-complete');
                        labelEl.textContent = '読破まで';
                    }

                    ticking = false;
                });
                ticking = true;
            }
        });
    }

})();

/**
 * Single Article - 記事ページ用JavaScript
 */

(function() {
    'use strict';

    // ===========================================
    // Table of Contents (目次) 自動生成
    // ===========================================

    const articleContent = document.querySelector('.article-content');
    const tocContainer = document.getElementById('toc');
    const tocList = document.querySelector('.article-toc__list');
    const tocToggle = document.querySelector('.article-toc__toggle');
    const tocNav = document.querySelector('.article-toc__nav');

    if (articleContent && tocList) {
        const headings = articleContent.querySelectorAll('h2');

        if (headings.length > 0) {
            headings.forEach((heading, index) => {
                // IDを付与
                const id = `heading-${index + 1}`;
                heading.id = id;

                // 目次項目を作成
                const li = document.createElement('li');
                const a = document.createElement('a');
                a.href = `#${id}`;
                a.textContent = heading.textContent;

                // スムーススクロール
                a.addEventListener('click', (e) => {
                    e.preventDefault();
                    const target = document.getElementById(id);
                    if (target) {
                        const headerHeight = document.getElementById('masthead')?.offsetHeight || 0;
                        const targetPosition = target.getBoundingClientRect().top + window.pageYOffset - headerHeight - 20;
                        window.scrollTo({
                            top: targetPosition,
                            behavior: 'smooth'
                        });
                    }
                });

                li.appendChild(a);
                tocList.appendChild(li);
            });
        } else {
            // h2がない場合は目次を非表示
            if (tocContainer) {
                tocContainer.style.display = 'none';
            }
        }
    }

    // 目次の開閉
    if (tocToggle && tocNav) {
        tocToggle.addEventListener('click', () => {
            const isExpanded = tocToggle.getAttribute('aria-expanded') === 'true';

            if (isExpanded) {
                tocNav.style.maxHeight = '0';
                tocToggle.setAttribute('aria-expanded', 'false');
            } else {
                tocNav.style.maxHeight = tocNav.scrollHeight + 'px';
                tocToggle.setAttribute('aria-expanded', 'true');
            }
        });

        // 初期状態を設定
        tocNav.style.maxHeight = tocNav.scrollHeight + 'px';
    }

    // ===========================================
    // コピーボタン
    // ===========================================

    const copyButton = document.querySelector('.article-share__button--copy');

    if (copyButton) {
        copyButton.addEventListener('click', async () => {
            const url = copyButton.dataset.url;

            try {
                await navigator.clipboard.writeText(url);

                // フィードバック表示
                const originalHTML = copyButton.innerHTML;
                copyButton.innerHTML = `
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="20 6 9 17 4 12"/>
                    </svg>
                `;
                copyButton.style.borderColor = '#10b981';
                copyButton.style.color = '#10b981';

                setTimeout(() => {
                    copyButton.innerHTML = originalHTML;
                    copyButton.style.borderColor = '';
                    copyButton.style.color = '';
                }, 2000);
            } catch (err) {
                console.error('Failed to copy:', err);
            }
        });
    }

    // ===========================================
    // 見出しへのアンカーリンク追加
    // ===========================================

    if (articleContent) {
        const headings = articleContent.querySelectorAll('h2, h3, h4');

        headings.forEach(heading => {
            if (heading.id) {
                const anchor = document.createElement('a');
                anchor.href = `#${heading.id}`;
                anchor.className = 'heading-anchor';
                anchor.innerHTML = '#';
                anchor.setAttribute('aria-label', 'この見出しへのリンク');

                heading.style.position = 'relative';
                heading.appendChild(anchor);
            }
        });
    }

    // ===========================================
    // 外部リンクの処理
    // ===========================================

    if (articleContent) {
        const links = articleContent.querySelectorAll('a');

        links.forEach(link => {
            const href = link.getAttribute('href');

            // 外部リンクの判定
            if (href && href.startsWith('http') && !href.includes(window.location.hostname)) {
                link.setAttribute('target', '_blank');
                link.setAttribute('rel', 'noopener noreferrer');
            }
        });
    }

    // ===========================================
    // 画像のLightbox風表示
    // ===========================================

    if (articleContent) {
        const images = articleContent.querySelectorAll('img');

        images.forEach(img => {
            // figureの中にない画像のみ対象
            if (!img.closest('figure')) {
                img.style.cursor = 'zoom-in';

                img.addEventListener('click', () => {
                    openImageModal(img.src, img.alt);
                });
            }
        });

        // figure内の画像も対象
        const figures = articleContent.querySelectorAll('figure img');
        figures.forEach(img => {
            img.style.cursor = 'zoom-in';
            img.addEventListener('click', () => {
                openImageModal(img.src, img.alt);
            });
        });
    }

    function openImageModal(src, alt) {
        // 既存のモーダルを削除
        const existingModal = document.getElementById('image-modal');
        if (existingModal) existingModal.remove();

        // モーダルを作成
        const modal = document.createElement('div');
        modal.id = 'image-modal';
        modal.className = 'image-modal';
        modal.innerHTML = `
            <div class="image-modal__overlay"></div>
            <div class="image-modal__content">
                <img src="${src}" alt="${alt || ''}">
                <button type="button" class="image-modal__close" aria-label="閉じる">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M18 6L6 18M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        `;

        document.body.appendChild(modal);
        document.body.style.overflow = 'hidden';

        // アニメーション
        requestAnimationFrame(() => {
            modal.classList.add('is-open');
        });

        // 閉じる処理
        const closeModal = () => {
            modal.classList.remove('is-open');
            setTimeout(() => {
                modal.remove();
                document.body.style.overflow = '';
            }, 300);
        };

        modal.querySelector('.image-modal__overlay').addEventListener('click', closeModal);
        modal.querySelector('.image-modal__close').addEventListener('click', closeModal);
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') closeModal();
        }, { once: true });
    }

})();

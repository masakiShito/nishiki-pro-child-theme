<?php
/**
 * Template Name: About Page
 * Description: 自己紹介ページのテンプレート
 */

get_header();
?>

<main class="about-page">
    <div class="about-hero">
        <div class="about-hero__container">
            <h1 class="about-hero__title">About</h1>
            <p class="about-hero__lead">このブログについて</p>
        </div>
    </div>

    <div class="about-content">
        <div class="about-content__container">
            <!-- プロフィールセクション -->
            <section class="about-section">
                <div class="about-profile">
                    <div class="about-profile__avatar">
                        <svg width="120" height="120" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </div>
                    <div class="about-profile__info">
                        <h2 class="about-profile__name">ブログ管理者</h2>
                        <p class="about-profile__bio">
                            エンジニア。試して、失敗して、それでも前に進む。<br>
                            わかったことだけを、正直に書いていきます。
                        </p>
                    </div>
                </div>
            </section>

            <!-- このブログについて -->
            <section class="about-section">
                <h2 class="about-section__title">
                    <span class="about-section__title-en">About This Blog</span>
                    <span class="about-section__title-ja">このブログについて</span>
                </h2>
                <div class="about-section__content">
                    <p>
                        このブログは、学んだことや試したことを記録していく場所です。<br>
                        完璧な答えではなく、試行錯誤の過程を大切にしています。
                    </p>
                    <p>
                        技術的な発見、小さな気づき、失敗から学んだこと。<br>
                        等身大の言葉で、わかったことだけを書いていきます。
                    </p>
                </div>
            </section>

            <!-- 編集ポリシー -->
            <section class="about-section">
                <h2 class="about-section__title">
                    <span class="about-section__title-en">Editorial Policy</span>
                    <span class="about-section__title-ja">編集ポリシー</span>
                </h2>
                <div class="about-section__content">
                    <ul class="about-list">
                        <li class="about-list__item">
                            <div class="about-list__icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                            </div>
                            <div class="about-list__text">
                                <strong>実体験ベース</strong><br>
                                実際に試したこと、経験したことだけを書きます。
                            </div>
                        </li>
                        <li class="about-list__item">
                            <div class="about-list__icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                            </div>
                            <div class="about-list__text">
                                <strong>正直に書く</strong><br>
                                わからないことは「わからない」と書きます。
                            </div>
                        </li>
                        <li class="about-list__item">
                            <div class="about-list__icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                            </div>
                            <div class="about-list__text">
                                <strong>継続的な更新</strong><br>
                                新しい発見があれば、記事を更新していきます。
                            </div>
                        </li>
                        <li class="about-list__item">
                            <div class="about-list__icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                            </div>
                            <div class="about-list__text">
                                <strong>読みやすさ重視</strong><br>
                                専門用語は噛み砕いて、わかりやすく説明します。
                            </div>
                        </li>
                    </ul>
                </div>
            </section>

            <!-- 技術スタック -->
            <section class="about-section">
                <h2 class="about-section__title">
                    <span class="about-section__title-en">Tech Stack</span>
                    <span class="about-section__title-ja">よく使う技術</span>
                </h2>
                <div class="about-section__content">
                    <div class="about-tech">
                        <div class="about-tech__item">
                            <h3 class="about-tech__category">Frontend</h3>
                            <p class="about-tech__list">HTML, CSS, JavaScript, React, Next.js</p>
                        </div>
                        <div class="about-tech__item">
                            <h3 class="about-tech__category">Backend</h3>
                            <p class="about-tech__list">Node.js, PHP, WordPress</p>
                        </div>
                        <div class="about-tech__item">
                            <h3 class="about-tech__category">Other</h3>
                            <p class="about-tech__list">Docker, Git, VS Code</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- お問い合わせ -->
            <section class="about-section about-section--contact">
                <h2 class="about-section__title">
                    <span class="about-section__title-en">Contact</span>
                    <span class="about-section__title-ja">お問い合わせ</span>
                </h2>
                <div class="about-section__content">
                    <p class="about-contact__text">
                        記事の内容についてのご質問や、ご指摘などがありましたら<br>
                        お気軽にお問い合わせください。
                    </p>
                    <a href="<?php echo esc_url(home_url('/contact')); ?>" class="about-contact__button">
                        お問い合わせページへ
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </a>
                </div>
            </section>
        </div>
    </div>
</main>

<?php
get_footer();
?>

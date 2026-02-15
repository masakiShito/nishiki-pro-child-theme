<?php
/**
 * Template Name: About Me
 * About Meページテンプレート - モダンデザイン
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<div class="about-page">
    <!-- ヒーローセクション - 大胆なスプリットデザイン -->
    <section class="about-hero">
        <div class="about-hero__bg">
            <div class="about-hero__shapes">
                <div class="shape shape--1"></div>
                <div class="shape shape--2"></div>
                <div class="shape shape--3"></div>
            </div>
        </div>
        <div class="about-hero__container">
            <div class="about-hero__content">
                <span class="about-hero__label">About Me</span>
                <h1 class="about-hero__title">
                    <span class="title-line">運用され続ける</span>
                    <span class="title-line">システムを、</span>
                    <span class="title-line title-line--accent">設計する。</span>
                </h1>
                <p class="about-hero__lead">
                    作って終わりではなく、<br>
                    使われ続けるプロダクトを目指して。
                </p>
            </div>
            <div class="about-hero__visual">
                <div class="about-hero__card">
                    <div class="about-hero__avatar">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </div>
                    <div class="about-hero__info">
                        <span class="about-hero__role">Web Application Engineer</span>
                        <span class="about-hero__exp">7+ years experience</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="about-hero__scroll">
            <span>Scroll</span>
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M12 5v14M19 12l-7 7-7-7"/>
            </svg>
        </div>
    </section>

    <!-- プロフィールセクション -->
    <section class="about-profile">
        <div class="about-profile__container">
            <div class="about-profile__header">
                <span class="section-label">01</span>
                <h2 class="section-title">Profile</h2>
            </div>
            <div class="about-profile__content">
                <div class="about-profile__text">
                    <p class="lead-text">Webアプリケーションエンジニアとして約7年間、業務系・EC・予約・管理系システムを中心に開発に携わってきました。</p>
                    <p>要件整理・仕様検討から、設計、実装、テスト、運用までを一貫して担当。React / Vue を用いたフロントエンド開発と、Python（FastAPI）・Javaによるバックエンド開発の両方を経験しています。</p>
                    <p>特に、<strong>業務フローや権限管理を意識した設計</strong>を得意としており、将来的な機能追加や運用変更にも耐えられる構成を常に意識しています。</p>
                    <p>小〜中規模チーム（5〜8名）のリーダー・PLとして、進捗管理や設計・成果物レビューを行い、品質と納期の両立を重視したプロジェクト推進を行ってきました。</p>
                </div>
                <div class="about-profile__quote">
                    <blockquote>
                        <p>「作って終わり」ではなく、<br><strong>運用され続けるシステム</strong>を<br>設計・実装することを大切にしています。</p>
                    </blockquote>
                </div>
            </div>
        </div>
    </section>

    <!-- キャリアサマリー - Bento Grid -->
    <section class="about-career">
        <div class="about-career__container">
            <div class="about-career__header">
                <span class="section-label">02</span>
                <h2 class="section-title">Career</h2>
            </div>
            <div class="bento-grid">
                <div class="bento-card bento-card--role">
                    <div class="bento-card__icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <rect x="2" y="7" width="20" height="14" rx="2" ry="2"/>
                            <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/>
                        </svg>
                    </div>
                    <span class="bento-card__label">Position</span>
                    <h3 class="bento-card__title">Web Application Engineer</h3>
                    <p class="bento-card__sub">SE / PL</p>
                </div>

                <div class="bento-card bento-card--experience">
                    <div class="bento-card__number">7</div>
                    <span class="bento-card__label">Years</span>
                    <p class="bento-card__text">2019年〜現在</p>
                </div>

                <div class="bento-card bento-card--domains">
                    <span class="bento-card__label">Development Domains</span>
                    <ul class="bento-card__list">
                        <li><span class="tag">業務系Web</span></li>
                        <li><span class="tag">EC・販売</span></li>
                        <li><span class="tag">予約システム</span></li>
                        <li><span class="tag">設備管理</span></li>
                    </ul>
                </div>

                <div class="bento-card bento-card--timeline">
                    <span class="bento-card__label">Career Journey</span>
                    <div class="mini-timeline">
                        <div class="mini-timeline__item">
                            <span class="mini-timeline__year">2019-20</span>
                            <span class="mini-timeline__role">保守・テスト</span>
                        </div>
                        <div class="mini-timeline__item">
                            <span class="mini-timeline__year">2021-22</span>
                            <span class="mini-timeline__role">実装＋設計</span>
                        </div>
                        <div class="mini-timeline__item mini-timeline__item--current">
                            <span class="mini-timeline__year">2023〜</span>
                            <span class="mini-timeline__role">設計・PL</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 開発フェーズ経験 -->
    <section class="about-phases">
        <div class="about-phases__container">
            <div class="about-phases__header">
                <span class="section-label">03</span>
                <h2 class="section-title">Experience</h2>
                <p class="section-lead">設計からテストまで一気通貫で対応</p>
            </div>
            <div class="phases-visual">
                <div class="phase-bar">
                    <div class="phase-bar__item" data-years="2">
                        <span class="phase-bar__name">要件定義</span>
                        <span class="phase-bar__years">約2年</span>
                        <div class="phase-bar__fill" style="--width: 28%"></div>
                    </div>
                    <div class="phase-bar__item" data-years="4">
                        <span class="phase-bar__name">基本設計</span>
                        <span class="phase-bar__years">約4年</span>
                        <div class="phase-bar__fill" style="--width: 57%"></div>
                    </div>
                    <div class="phase-bar__item" data-years="5">
                        <span class="phase-bar__name">詳細設計</span>
                        <span class="phase-bar__years">約5年</span>
                        <div class="phase-bar__fill" style="--width: 71%"></div>
                    </div>
                    <div class="phase-bar__item" data-years="6">
                        <span class="phase-bar__name">実装</span>
                        <span class="phase-bar__years">約6年</span>
                        <div class="phase-bar__fill" style="--width: 85%"></div>
                    </div>
                    <div class="phase-bar__item" data-years="6">
                        <span class="phase-bar__name">テスト</span>
                        <span class="phase-bar__years">約6年</span>
                        <div class="phase-bar__fill" style="--width: 85%"></div>
                    </div>
                    <div class="phase-bar__item" data-years="5">
                        <span class="phase-bar__name">運用・保守</span>
                        <span class="phase-bar__years">約5年</span>
                        <div class="phase-bar__fill" style="--width: 71%"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 技術スタック -->
    <section class="about-skills">
        <div class="about-skills__container">
            <div class="about-skills__header">
                <span class="section-label">04</span>
                <h2 class="section-title">Tech Stack</h2>
            </div>
            <div class="skills-showcase">
                <div class="skill-group">
                    <div class="skill-group__header">
                        <div class="skill-group__icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="16 18 22 12 16 6"/>
                                <polyline points="8 6 2 12 8 18"/>
                            </svg>
                        </div>
                        <h3 class="skill-group__title">Frontend</h3>
                    </div>
                    <div class="skill-tags">
                        <span class="skill-tag skill-tag--primary">React <em>3年</em></span>
                        <span class="skill-tag skill-tag--primary">Vue.js <em>1年</em></span>
                        <span class="skill-tag">JavaScript <em>5年+</em></span>
                        <span class="skill-tag">HTML / CSS <em>5年+</em></span>
                        <span class="skill-tag">jQuery</span>
                        <span class="skill-tag">Knockout.js</span>
                    </div>
                </div>

                <div class="skill-group">
                    <div class="skill-group__header">
                        <div class="skill-group__icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="2" y="2" width="20" height="8" rx="2" ry="2"/>
                                <rect x="2" y="14" width="20" height="8" rx="2" ry="2"/>
                                <line x1="6" y1="6" x2="6.01" y2="6"/>
                                <line x1="6" y1="18" x2="6.01" y2="18"/>
                            </svg>
                        </div>
                        <h3 class="skill-group__title">Backend</h3>
                    </div>
                    <div class="skill-tags">
                        <span class="skill-tag skill-tag--primary">Python / FastAPI <em>3年</em></span>
                        <span class="skill-tag skill-tag--primary">Java <em>5年</em></span>
                        <span class="skill-tag">C# / ASP.NET</span>
                        <span class="skill-tag">AWS Lambda</span>
                    </div>
                </div>

                <div class="skill-group">
                    <div class="skill-group__header">
                        <div class="skill-group__icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <ellipse cx="12" cy="5" rx="9" ry="3"/>
                                <path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"/>
                                <path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"/>
                            </svg>
                        </div>
                        <h3 class="skill-group__title">Database</h3>
                    </div>
                    <div class="skill-tags">
                        <span class="skill-tag skill-tag--primary">PostgreSQL <em>2年</em></span>
                        <span class="skill-tag">Oracle <em>1年</em></span>
                        <span class="skill-tag">MySQL</span>
                    </div>
                </div>

                <div class="skill-group">
                    <div class="skill-group__header">
                        <div class="skill-group__icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                                <polyline points="22 4 12 14.01 9 11.01"/>
                            </svg>
                        </div>
                        <h3 class="skill-group__title">Infrastructure & Tools</h3>
                    </div>
                    <div class="skill-tags">
                        <span class="skill-tag">AWS</span>
                        <span class="skill-tag">Docker</span>
                        <span class="skill-tag">Jenkins</span>
                        <span class="skill-tag">Git / SVN</span>
                        <span class="skill-tag">WordPress</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 強み -->
    <section class="about-strengths">
        <div class="about-strengths__container">
            <div class="about-strengths__header">
                <span class="section-label">05</span>
                <h2 class="section-title">Strengths</h2>
            </div>
            <div class="strengths-grid">
                <article class="strength-card">
                    <div class="strength-card__number">01</div>
                    <h3 class="strength-card__title">設計力 × 業務理解</h3>
                    <ul class="strength-card__points">
                        <li>業務フロー・権限・運用を前提にした設計</li>
                        <li>将来の機能追加を見据えた構成</li>
                    </ul>
                </article>

                <article class="strength-card">
                    <div class="strength-card__number">02</div>
                    <h3 class="strength-card__title">主体的な改善力</h3>
                    <ul class="strength-card__points">
                        <li>VBAによる業務自動化（1人日削減）</li>
                        <li>テスト・設計の効率化ツール作成</li>
                        <li>外部API仕様変更への自走対応</li>
                    </ul>
                </article>

                <article class="strength-card">
                    <div class="strength-card__number">03</div>
                    <h3 class="strength-card__title">キャッチアップ力</h3>
                    <ul class="strength-card__points">
                        <li>未経験言語・FWでも短期間で実務投入</li>
                        <li>業務後の自己学習 → 設計に反映</li>
                    </ul>
                </article>

                <article class="strength-card strength-card--featured">
                    <div class="strength-card__number">04</div>
                    <h3 class="strength-card__title">品質へのこだわり</h3>
                    <ul class="strength-card__points">
                        <li>テスト仕様書・レビュー重視</li>
                        <li>リリース後不具合ゼロの案件実績あり</li>
                    </ul>
                    <div class="strength-card__badge">Zero Bug Release</div>
                </article>
            </div>
        </div>
    </section>

    <!-- マネジメント経験 -->
    <section class="about-management">
        <div class="about-management__container">
            <div class="about-management__header">
                <span class="section-label">06</span>
                <h2 class="section-title">Management</h2>
            </div>
            <div class="management-layout">
                <div class="management-overview">
                    <h3 class="management-overview__title">リーダー / PL経験</h3>
                    <div class="management-stats">
                        <div class="management-stat">
                            <span class="management-stat__number">5-8</span>
                            <span class="management-stat__label">名規模チーム</span>
                        </div>
                        <div class="management-stat">
                            <span class="management-stat__number">複数</span>
                            <span class="management-stat__label">プロジェクト</span>
                        </div>
                    </div>
                    <ul class="management-list">
                        <li>作業分担、進捗管理、設計レビュー</li>
                        <li>品質と納期の両立を重視した推進</li>
                    </ul>
                </div>
                <div class="management-highlights">
                    <h3 class="management-highlights__title">Achievements</h3>
                    <div class="highlight-stack">
                        <div class="highlight-item">
                            <span class="highlight-item__marker">✦</span>
                            <p>初リーダー案件でも「全成果物レビュー」を実施</p>
                        </div>
                        <div class="highlight-item">
                            <span class="highlight-item__marker">✦</span>
                            <p>設計書未整備案件を再構築・最新化</p>
                        </div>
                        <div class="highlight-item">
                            <span class="highlight-item__marker">✦</span>
                            <p>権限管理・業務ロジックの整理が得意</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA セクション -->
    <section class="about-cta">
        <div class="about-cta__container">
            <div class="about-cta__content">
                <h2 class="about-cta__title">ブログ記事を見る</h2>
                <p class="about-cta__text">技術的なメモや学習記録を残しています</p>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="about-cta__button">
                    <span>トップページへ</span>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </a>
            </div>
        </div>
    </section>
</div>

<?php
get_footer();
?>

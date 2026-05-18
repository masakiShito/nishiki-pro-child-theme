<?php
/**
 * Template Name: About Me
 * About Meページテンプレート
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

$admin_users = get_users([
    'role'   => 'administrator',
    'number' => 1,
]);
$admin_id = !empty($admin_users) ? $admin_users[0]->ID : 1;
?>

<div class="about-page">
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
                    <span class="title-line">要件整理から</span>
                    <span class="title-line">実装と改善まで、</span>
                    <span class="title-line title-line--accent">一貫して進める。</span>
                </h1>
                <p class="about-hero__lead">
                    業務系Webシステムを中心に、要件定義・設計・実装・テスト・保守運用まで対応。<br>
                    現場で運用され続けるシステムを、実務目線で組み立てることを大切にしています。
                </p>
            </div>
            <div class="about-hero__visual">
                <div class="about-hero__card">
                    <div class="about-hero__avatar">
                        <?php echo get_avatar($admin_id, 120); ?>
                    </div>
                    <div class="about-hero__info">
                        <span class="about-hero__role">System Engineer / Full-stack Web Engineer</span>
                        <span class="about-hero__exp">2019 - Present</span>
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

    <section class="about-profile">
        <div class="about-profile__container">
            <div class="about-profile__header">
                <span class="section-label">01</span>
                <h2 class="section-title">Profile</h2>
            </div>
            <div class="about-profile__content">
                <div class="about-profile__text">
                    <p class="lead-text">システムエンジニア / フルスタック寄りのWebアプリケーションエンジニアとして、業務システム開発を中心に実務経験を積んできました。</p>
                    <p>Java / Spring Boot を軸に、TypeScript / Next.js / Vue、Python / FastAPI、C# / ASP.NET、AWS環境での開発に対応しています。バックエンド実装だけでなく、画面仕様書、API仕様書、DB設計書、業務フローなどの設計成果物を整理して形にすることも得意です。</p>
                    <p>近年は、PLとしての進捗管理、タスク整理、レビュー、メンバー支援にも取り組んでいます。単に実装を進めるのではなく、<strong>曖昧な要件を実装可能な仕様に落とし込み、チーム全体で前に進める</strong>ことを強みとしています。</p>
                    <p>要件定義から設計、実装、テスト、保守運用まで一貫して見られる実務型のエンジニアとして、使いやすさ・保守性・現場運用のしやすさを意識したシステム開発を大切にしています。</p>
                </div>
                <div class="about-profile__quote">
                    <blockquote>
                        <p>ただ動くものではなく、<br><strong>現場で任せられる設計と実装</strong>を。<br>その視点でシステムを作り続けています。</p>
                    </blockquote>
                </div>
            </div>
        </div>
    </section>

    <section class="about-career">
        <div class="about-career__container">
            <div class="about-career__header">
                <span class="section-label">02</span>
                <h2 class="section-title">Snapshot</h2>
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
                    <h3 class="bento-card__title">System Engineer / PL</h3>
                    <p class="bento-card__sub">上流から実装まで一貫対応</p>
                </div>

                <div class="bento-card bento-card--experience">
                    <div class="bento-card__number">6+</div>
                    <span class="bento-card__label">Years</span>
                    <p class="bento-card__text">2019年頃から継続して開発に従事</p>
                </div>

                <div class="bento-card bento-card--domains">
                    <span class="bento-card__label">Development Domains</span>
                    <ul class="bento-card__list">
                        <li><span class="tag">業務系Webシステム</span></li>
                        <li><span class="tag">予約・在庫管理</span></li>
                        <li><span class="tag">EC・販売サイト</span></li>
                        <li><span class="tag">設備・申請・管理画面</span></li>
                        <li><span class="tag">保守・リプレイス</span></li>
                        <li><span class="tag">バッチ / ジョブ運用</span></li>
                    </ul>
                </div>

                <div class="bento-card bento-card--timeline">
                    <span class="bento-card__label">Career Journey</span>
                    <div class="mini-timeline">
                        <div class="mini-timeline__item">
                            <span class="mini-timeline__year">2019-2020</span>
                            <span class="mini-timeline__role">テスト / 保守 / 調査</span>
                        </div>
                        <div class="mini-timeline__item">
                            <span class="mini-timeline__year">2021-2023</span>
                            <span class="mini-timeline__role">設計 / 実装 / リプレイス</span>
                        </div>
                        <div class="mini-timeline__item mini-timeline__item--current">
                            <span class="mini-timeline__year">2024-Now</span>
                            <span class="mini-timeline__role">PL / API / フルスタック</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="about-history">
        <div class="about-history__container">
            <div class="about-history__header">
                <span class="section-label">03</span>
                <h2 class="section-title">Career Timeline</h2>
                <p class="section-lead">保守・テストから始まり、設計・実装・PLまで担当範囲を広げてきました。</p>
            </div>
            <div class="career-timeline">
                <article class="career-entry">
                    <span class="career-entry__period">2019-2020</span>
                    <div class="career-entry__body">
                        <h3 class="career-entry__title">人材管理・物流管理システムでキャリアを開始</h3>
                        <ul class="career-entry__points">
                            <li>Java / Spring MVC を中心に、テスト、改修、運用マニュアル作成を担当。</li>
                            <li>人材管理システム、物流管理システムの保守運用を通じて、既存仕様を読み解く力を習得。</li>
                            <li>VBAによる業務効率化ツール作成にも取り組み、日々の運用改善を経験。</li>
                        </ul>
                    </div>
                </article>

                <article class="career-entry">
                    <span class="career-entry__period">2021-2022</span>
                    <div class="career-entry__body">
                        <h3 class="career-entry__title">複数の業務系システムで設計からリリースまで対応</h3>
                        <ul class="career-entry__points">
                            <li>電気系管理システム、支出管理システム、工事申請管理システムなどの開発に参画。</li>
                            <li>設計書作成、画面開発、DB変更、テスト、本番リリースまで幅広く担当。</li>
                            <li>チームリーダーとしてタスク管理、進捗管理、レビューも経験。</li>
                        </ul>
                    </div>
                </article>

                <article class="career-entry">
                    <span class="career-entry__period">2022-2023</span>
                    <div class="career-entry__body">
                        <h3 class="career-entry__title">製品管理システム刷新でバッチ処理開発を担当</h3>
                        <ul class="career-entry__points">
                            <li>Java / Spring Batch / Oracle を用いたバッチ処理の設計・実装を担当。</li>
                            <li>データ処理やジョブ運用を意識した実装に従事し、バッチ開発の実務経験を深めた。</li>
                            <li>Pythonによる作業効率化ツール作成にも取り組み、周辺業務の改善も実施。</li>
                        </ul>
                    </div>
                </article>

                <article class="career-entry">
                    <span class="career-entry__period">2023-2025</span>
                    <div class="career-entry__body">
                        <h3 class="career-entry__title">予約システムの新規開発で API と画面の両面を担当</h3>
                        <ul class="career-entry__points">
                            <li>クルーズ予約システムおよびアクティビティ予約システムの新規開発に参画。</li>
                            <li>Python、AWS Lambda、TypeScript、Next.js、Reactを用いてバックエンドAPIと予約画面を開発。</li>
                            <li>約20本のAPI実装と、予約登録・予約確認などの業務ロジック実装を担当。</li>
                        </ul>
                    </div>
                </article>

                <article class="career-entry">
                    <span class="career-entry__period">2025</span>
                    <div class="career-entry__body">
                        <h3 class="career-entry__title">エアコン管理システムのリプレイスを PL として推進</h3>
                        <ul class="career-entry__points">
                            <li>FastAPI、Vue.js、PostgreSQL、AWS環境で、約15本のAPIと約7画面の開発を推進。</li>
                            <li>PLとして、レビュー、メンバー支援、タスク管理、進捗管理まで担当。</li>
                            <li>CASLを用いた権限管理や UI / UX 改善にも対応。</li>
                        </ul>
                    </div>
                </article>

                <article class="career-entry">
                    <span class="career-entry__period">2025-2026</span>
                    <div class="career-entry__body">
                        <h3 class="career-entry__title">大規模EC販売サイトのリプレイス・機能拡張</h3>
                        <ul class="career-entry__points">
                            <li>商品一覧、商品詳細、カート、注文関連機能などの基本設計を担当。</li>
                            <li>画面仕様書、API仕様、DB設計、ER図、業務フロー整理、設計レビューを実施。</li>
                            <li>複数関係者との調整を通じて、仕様と設計の整合を取りながら進行。</li>
                        </ul>
                    </div>
                </article>

                <article class="career-entry">
                    <span class="career-entry__period">2026-Now</span>
                    <div class="career-entry__body">
                        <h3 class="career-entry__title">自治体向けデジタル決済アプリの保守・改善</h3>
                        <ul class="career-entry__points">
                            <li>既存システムの課題整理、レガシー改善、セキュリティ課題調査を担当。</li>
                            <li>外部ベンダーによる修正内容のレビューも行い、品質面の確認に関与。</li>
                        </ul>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <section class="about-phases">
        <div class="about-phases__container">
            <div class="about-phases__header">
                <span class="section-label">04</span>
                <h2 class="section-title">What I Cover</h2>
                <p class="section-lead">上流工程だけでも、実装だけでもなく、プロジェクトを通して責任を持てるのが強みです。</p>
            </div>
            <div class="phases-visual">
                <div class="phase-bar">
                    <div class="phase-bar__item">
                        <span class="phase-bar__name">要件整理 / 仕様整理</span>
                        <span class="phase-bar__years">Strong</span>
                        <div class="phase-bar__fill" style="--width: 88%"></div>
                    </div>
                    <div class="phase-bar__item">
                        <span class="phase-bar__name">基本設計 / 詳細設計</span>
                        <span class="phase-bar__years">Strong</span>
                        <div class="phase-bar__fill" style="--width: 92%"></div>
                    </div>
                    <div class="phase-bar__item">
                        <span class="phase-bar__name">実装 / API / DB</span>
                        <span class="phase-bar__years">Strong</span>
                        <div class="phase-bar__fill" style="--width: 95%"></div>
                    </div>
                    <div class="phase-bar__item">
                        <span class="phase-bar__name">テスト / 保守運用</span>
                        <span class="phase-bar__years">Strong</span>
                        <div class="phase-bar__fill" style="--width: 90%"></div>
                    </div>
                    <div class="phase-bar__item">
                        <span class="phase-bar__name">PL / レビュー / 進捗管理</span>
                        <span class="phase-bar__years">Expanding</span>
                        <div class="phase-bar__fill" style="--width: 78%"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="about-skills">
        <div class="about-skills__container">
            <div class="about-skills__header">
                <span class="section-label">05</span>
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
                        <span class="skill-tag skill-tag--primary">TypeScript</span>
                        <span class="skill-tag skill-tag--primary">Next.js</span>
                        <span class="skill-tag skill-tag--primary">Vue</span>
                        <span class="skill-tag">React</span>
                        <span class="skill-tag">JavaScript</span>
                        <span class="skill-tag">HTML / CSS</span>
                        <span class="skill-tag">jQuery</span>
                        <span class="skill-tag">Vuetify</span>
                        <span class="skill-tag">Tailwind CSS</span>
                        <span class="skill-tag">SSR / SPA</span>
                        <span class="skill-tag">画面権限制御</span>
                    </div>
                </div>

                <div class="skill-group">
                    <div class="skill-group__header">
                        <div class="skill-group__icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="2" y="2" width="20" height="8" rx="2" ry="2"/>
                                <rect x="2" y="14" width="20" height="8" rx="2" ry="2"/>
                            </svg>
                        </div>
                        <h3 class="skill-group__title">Backend</h3>
                    </div>
                    <div class="skill-tags">
                        <span class="skill-tag skill-tag--primary">Java / Spring Boot</span>
                        <span class="skill-tag">Spring MVC</span>
                        <span class="skill-tag">Spring Batch</span>
                        <span class="skill-tag skill-tag--primary">Python / FastAPI</span>
                        <span class="skill-tag">C# / ASP.NET</span>
                        <span class="skill-tag">Next.js API Routes</span>
                        <span class="skill-tag">REST API設計</span>
                        <span class="skill-tag">認証 / 認可設計</span>
                        <span class="skill-tag">排他制御</span>
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
                        <h3 class="skill-group__title">Database / Design</h3>
                    </div>
                    <div class="skill-tags">
                        <span class="skill-tag skill-tag--primary">PostgreSQL</span>
                        <span class="skill-tag">MySQL</span>
                        <span class="skill-tag">Oracle</span>
                        <span class="skill-tag">DB設計</span>
                        <span class="skill-tag">ER図</span>
                        <span class="skill-tag">データ移行SQL</span>
                        <span class="skill-tag">API仕様書</span>
                        <span class="skill-tag">画面仕様書</span>
                        <span class="skill-tag">業務フロー</span>
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
                        <h3 class="skill-group__title">Infra / Tools</h3>
                    </div>
                    <div class="skill-tags">
                        <span class="skill-tag skill-tag--primary">AWS</span>
                        <span class="skill-tag">EC2</span>
                        <span class="skill-tag">Lambda</span>
                        <span class="skill-tag">Docker</span>
                        <span class="skill-tag">Windows Server</span>
                        <span class="skill-tag">Linux</span>
                        <span class="skill-tag">JP1</span>
                        <span class="skill-tag">Jenkins</span>
                        <span class="skill-tag">Git / GitHub / SVN</span>
                        <span class="skill-tag">Postman</span>
                        <span class="skill-tag">Obsidian / Notion</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="about-strengths">
        <div class="about-strengths__container">
            <div class="about-strengths__header">
                <span class="section-label">06</span>
                <h2 class="section-title">Strengths</h2>
            </div>
            <div class="strengths-grid">
                <article class="strength-card">
                    <div class="strength-card__number">01</div>
                    <h3 class="strength-card__title">仕様を整理して形にする力</h3>
                    <ul class="strength-card__points">
                        <li>曖昧な要件を、画面仕様・API仕様・DB設計へ落とし込めます。</li>
                        <li>不足している設計情報を補完しながら、実装可能な形に整理できます。</li>
                    </ul>
                </article>

                <article class="strength-card">
                    <div class="strength-card__number">02</div>
                    <h3 class="strength-card__title">既存システムを読み解く力</h3>
                    <ul class="strength-card__points">
                        <li>保守・調査・レガシー改修の中で、制約を踏まえた現実的な改善案を出せます。</li>
                        <li>IE前提画面のモダンブラウザ移行や、設計書不足案件の再整理を経験しています。</li>
                    </ul>
                </article>

                <article class="strength-card">
                    <div class="strength-card__number">03</div>
                    <h3 class="strength-card__title">フルスタック寄りの対応力</h3>
                    <ul class="strength-card__points">
                        <li>フロントエンド、バックエンド、DB、インフラまで横断して対応できます。</li>
                        <li>未経験技術でもキャッチアップして実務に適用してきた経験があります。</li>
                    </ul>
                </article>

                <article class="strength-card strength-card--featured">
                    <div class="strength-card__number">04</div>
                    <h3 class="strength-card__title">チームを前に進める推進力</h3>
                    <ul class="strength-card__points">
                        <li>PLとしてタスク管理、進捗確認、技術相談、レビューに対応。</li>
                        <li>自分だけで抱え込まず、関係者と調整しながら前に進めることを大切にしています。</li>
                    </ul>
                    <div class="strength-card__badge">Practical Engineer</div>
                </article>
            </div>
        </div>
    </section>

    <section class="about-management">
        <div class="about-management__container">
            <div class="about-management__header">
                <span class="section-label">07</span>
                <h2 class="section-title">Achievements</h2>
            </div>
            <div class="management-layout">
                <div class="management-overview">
                    <h3 class="management-overview__title">実務で積み上げてきたこと</h3>
                    <div class="management-stats">
                        <div class="management-stat">
                            <span class="management-stat__number">100+</span>
                            <span class="management-stat__label">画面設計・改修に関与</span>
                        </div>
                        <div class="management-stat">
                            <span class="management-stat__number">10</span>
                            <span class="management-stat__label">名規模チーム推進経験</span>
                        </div>
                        <div class="management-stat">
                            <span class="management-stat__number">100+</span>
                            <span class="management-stat__label">API設計・実装に関与</span>
                        </div>
                    </div>
                    <ul class="management-list">
                        <li>複数案件を通じて、画面設計、改修、仕様整理、実装に通算100画面以上関与。</li>
                        <li>予約、管理、EC、申請、設備系システムで、APIの設計・実装・改修に通算100本以上関与。</li>
                        <li>支出管理システムでは約30画面分の仕様整理・設計書作成を担当。</li>
                        <li>空調管理システムでは約7画面・約15APIを対象に、PLとしてレビューや進行管理まで担当。</li>
                        <li>人材管理システムでは約20画面分の単体テスト仕様書作成・テスト実施を経験。</li>
                        <li>設計レビュー、コードレビュー、技術相談、進捗確認を継続的に実施。</li>
                    </ul>
                </div>
                <div class="management-highlights">
                    <h3 class="management-highlights__title">Best Fit Projects</h3>
                    <div class="highlight-stack">
                        <div class="highlight-item">
                            <span class="highlight-item__marker">✦</span>
                            <p>業務系Webシステムの新規開発・機能追加・リプレイス</p>
                        </div>
                        <div class="highlight-item">
                            <span class="highlight-item__marker">✦</span>
                            <p>仕様書不足の状態から、画面・API・DB設計を整理していく案件</p>
                        </div>
                        <div class="highlight-item">
                            <span class="highlight-item__marker">✦</span>
                            <p>予約、在庫、申請、管理画面など、業務ロジックが重要なシステム</p>
                        </div>
                        <div class="highlight-item">
                            <span class="highlight-item__marker">✦</span>
                            <p>PLとしてメンバー支援をしながら進める中規模の開発案件</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="about-cta">
        <div class="about-cta__container">
            <div class="about-cta__content">
                <h2 class="about-cta__title">Blog & Notes</h2>
                <p class="about-cta__text">技術学習、設計の考え方、実務で得た知見を少しずつ言語化していきます。</p>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="about-cta__button">
                    <span>記事を見る</span>
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

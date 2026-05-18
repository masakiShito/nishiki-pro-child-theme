<?php
/**
 * Template Name: Specforge
 * specforge紹介ページテンプレート
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<div class="specforge-page">
    <section class="specforge-hero">
        <div class="specforge-hero__backdrop">
            <div class="specforge-hero__grid"></div>
            <div class="specforge-hero__glow specforge-hero__glow--1"></div>
            <div class="specforge-hero__glow specforge-hero__glow--2"></div>
        </div>
        <div class="specforge-hero__container">
            <div class="specforge-hero__content">
                <span class="specforge-hero__eyebrow">Product / Internal System</span>
                <h1 class="specforge-hero__title">specforge</h1>
                <p class="specforge-hero__lead">
                    設計書を、わかりやすく、正確に、管理しやすく作るためのシステム。
                </p>
                <p class="specforge-hero__description">
                    従来の Markdown や Excel、スプレッドシートで設計書を作成すると、表崩れ、項目の抜け漏れ、検索しづらさ、修正漏れが起こりやすくなります。
                    specforge は、設計書を文章ではなく構造化された情報として管理することで、読みやすく、更新しやすく、AIにも扱いやすい設計書作成を目指すドキュメント作成支援システムです。
                </p>
                <div class="specforge-hero__actions">
                    <a href="<?php echo esc_url(home_url('/blog/')); ?>" class="specforge-hero__button">
                        <span>関連記事を見る</span>
                    </a>
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="specforge-hero__button specforge-hero__button--secondary">
                        <span>トップへ戻る</span>
                    </a>
                </div>
            </div>
            <div class="specforge-hero__panel">
                <div class="specforge-hero__panel-header">
                    <span class="specforge-hero__panel-label">specforge / flow</span>
                    <span class="specforge-hero__panel-status">active</span>
                </div>
                <div class="specforge-hero__steps">
                    <div class="specforge-hero__step">
                        <span class="specforge-hero__step-index">01</span>
                        <div>
                            <h2>Project</h2>
                            <p>プロジェクト単位で複数の設計書を管理する</p>
                        </div>
                    </div>
                    <div class="specforge-hero__step">
                        <span class="specforge-hero__step-index">02</span>
                        <div>
                            <h2>Structure</h2>
                            <p>セクション、入力項目、テーブルで整理する</p>
                        </div>
                    </div>
                    <div class="specforge-hero__step">
                        <span class="specforge-hero__step-index">03</span>
                        <div>
                            <h2>Validate</h2>
                            <p>必須項目や入力内容をチェックする</p>
                        </div>
                    </div>
                    <div class="specforge-hero__step">
                        <span class="specforge-hero__step-index">04</span>
                        <div>
                            <h2>Review</h2>
                            <p>品質確認と将来の AI 活用につなげる</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="specforge-section specforge-section--summary">
        <div class="specforge-wrap">
            <div class="specforge-section__header">
                <span class="specforge-section__label">Why</span>
                <h2 class="specforge-section__title">設計書作成で起きやすい悩みを減らすために作りました</h2>
                <p class="specforge-section__lead">
                    システム開発では、画面仕様書、API仕様書、DB設計書、項目定義書など、多くの設計書を扱います。
                    その一方で、フォーマットのばらつき、必要項目の抜け漏れ、レイアウト崩れ、仕様変更時の修正漏れ、AIで扱いにくい構造といった課題が起こりやすくなります。
                    specforge は、こうした悩みを減らすためのツールです。
                </p>
            </div>
            <div class="specforge-pillars">
                <article class="specforge-pillar">
                    <span class="specforge-pillar__code">01</span>
                    <h3>フォーマットのばらつきを減らす</h3>
                    <p>人によって設計書の書き方が変わりすぎないよう、構造化された形で管理します。</p>
                </article>
                <article class="specforge-pillar">
                    <span class="specforge-pillar__code">02</span>
                    <h3>入力漏れと手戻りを減らす</h3>
                    <p>必要な項目を定義しやすくすることで、レビュー前の確認精度を上げます。</p>
                </article>
                <article class="specforge-pillar">
                    <span class="specforge-pillar__code">03</span>
                    <h3>AIでも扱いやすい形を目指す</h3>
                    <p>意味と関係性が分かる構造を前提にして、将来的なレビュー支援や要約にもつなげやすくします。</p>
                </article>
            </div>
        </div>
    </section>

    <section class="specforge-section">
        <div class="specforge-wrap">
            <div class="specforge-section__header">
                <span class="specforge-section__label">Core</span>
                <h2 class="specforge-section__title">SpecForgeでできること</h2>
            </div>
            <div class="specforge-grid">
                <article class="specforge-card">
                    <span class="specforge-card__eyebrow">Projects</span>
                    <h3 class="specforge-card__title">プロジェクト単位で設計書を管理</h3>
                    <p class="specforge-card__description">1つのプロジェクトの中で、画面仕様書、API仕様書、DB設計書などをまとめて扱えます。</p>
                </article>
                <article class="specforge-card">
                    <span class="specforge-card__eyebrow">Sections</span>
                    <h3 class="specforge-card__title">セクションごとに内容を整理</h3>
                    <p class="specforge-card__description">設計書をセクションや入力項目、テーブル、参照情報ごとに分けて整理できます。</p>
                </article>
                <article class="specforge-card">
                    <span class="specforge-card__eyebrow">Validation</span>
                    <h3 class="specforge-card__title">必須項目や内容のチェック</h3>
                    <p class="specforge-card__description">記載漏れや不足を確認しやすくし、設計書の品質確認を支援します。</p>
                </article>
                <article class="specforge-card">
                    <span class="specforge-card__eyebrow">Relations</span>
                    <h3 class="specforge-card__title">設計書同士の関連を扱いやすくする</h3>
                    <p class="specforge-card__description">仕様変更時の影響範囲や関連情報を追いやすい構造を意識しています。</p>
                </article>
            </div>
        </div>
    </section>

    <section class="specforge-section specforge-section--workflow">
        <div class="specforge-wrap">
            <div class="specforge-section__header">
                <span class="specforge-section__label">Editor</span>
                <h2 class="specforge-section__title">編集画面は3つのエリアで構成しています</h2>
            </div>
            <div class="specforge-flow">
                <div class="specforge-flow__item">
                    <span class="specforge-flow__label">Left</span>
                    <h3>一覧エリア</h3>
                    <p>左側には、設計書やセクションの一覧を表示し、現在どこを編集しているかを把握しやすくします。</p>
                </div>
                <div class="specforge-flow__item">
                    <span class="specforge-flow__label">Center</span>
                    <h3>入力フォーム</h3>
                    <p>中央には、実際に設計内容を入力するフォームを表示し、構造化しながら記載できます。</p>
                </div>
                <div class="specforge-flow__item">
                    <span class="specforge-flow__label">Right</span>
                    <h3>プレビュー / 品質確認</h3>
                    <p>右側には、プレビューや品質チェック、補足情報を表示し、レビューしやすくします。</p>
                </div>
                <div class="specforge-flow__item">
                    <span class="specforge-flow__label">Result</span>
                    <h3>迷いにくい編集体験</h3>
                    <p>どの設計書を編集していて、どの項目を埋めるべきかが分かりやすい構成を目指しています。</p>
                </div>
            </div>
        </div>
    </section>

    <section class="specforge-section">
        <div class="specforge-wrap">
            <div class="specforge-section__header">
                <span class="specforge-section__label">Value</span>
                <h2 class="specforge-section__title">SpecForgeの特徴</h2>
            </div>
            <div class="specforge-fit">
                <article class="specforge-fit__item">
                    <h3>設計書を構造化して管理できる</h3>
                    <p>タイトル、説明、入力項目、テーブル、参照情報などを明確に分けて扱うことで、整理や再利用がしやすくなります。</p>
                </article>
                <article class="specforge-fit__item">
                    <h3>抜け漏れを防ぎやすい</h3>
                    <p>必要項目を定義しやすく、不足している情報をレビュー前に確認しやすくします。</p>
                </article>
                <article class="specforge-fit__item">
                    <h3>AIと相性が良い</h3>
                    <p>構造化データとして扱う前提のため、将来的な AI レビューや要約、関連設計書チェックにもつなげやすくなります。</p>
                </article>
                <article class="specforge-fit__item">
                    <h3>複数の設計書をまとめて管理できる</h3>
                    <p>画面仕様書、API仕様書、DB設計書などを横断して扱えるため、関連性や影響範囲を追いやすくなります。</p>
                </article>
            </div>
        </div>
    </section>

    <section class="specforge-section specforge-section--workflow">
        <div class="specforge-wrap">
            <div class="specforge-section__header">
                <span class="specforge-section__label">Use Cases</span>
                <h2 class="specforge-section__title">想定している利用シーン</h2>
            </div>
            <div class="specforge-fit">
                <article class="specforge-fit__item">
                    <h3>新規システム開発の設計書作成</h3>
                    <p>複数の設計書を同時に整理しながら進めたいケースを想定しています。</p>
                </article>
                <article class="specforge-fit__item">
                    <h3>既存システムの仕様整理</h3>
                    <p>読み解いた内容を構造化して残し、属人化を減らしたい場面に向いています。</p>
                </article>
                <article class="specforge-fit__item">
                    <h3>チーム内レビューと品質標準化</h3>
                    <p>フォーマットを統一し、複数人で設計書を作成する現場での運用を想定しています。</p>
                </article>
            </div>
        </div>
    </section>

    <section class="specforge-section">
        <div class="specforge-wrap">
            <div class="specforge-section__header">
                <span class="specforge-section__label">Stack</span>
                <h2 class="specforge-section__title">技術構成</h2>
                <p class="specforge-section__lead">
                    SpecForge は、モダンな Web アプリケーションとして開発しています。フロントエンドには Next.js を採用し、TypeScript で設計書のデータ構造を扱いやすく定義しています。
                </p>
            </div>
            <div class="specforge-grid">
                <article class="specforge-card">
                    <span class="specforge-card__eyebrow">Frontend</span>
                    <h3 class="specforge-card__title">Next.js / React</h3>
                    <p class="specforge-card__description">画面操作がしやすい設計書エディタを構築するためのベースとして採用しています。</p>
                </article>
                <article class="specforge-card">
                    <span class="specforge-card__eyebrow">Type System</span>
                    <h3 class="specforge-card__title">TypeScript</h3>
                    <p class="specforge-card__description">画面側とデータ管理側で共通して扱いやすい形を意識して、設計書の構造を定義しています。</p>
                </article>
                <article class="specforge-card">
                    <span class="specforge-card__eyebrow">Workspace</span>
                    <h3 class="specforge-card__title">Monorepo</h3>
                    <p class="specforge-card__description">機能を整理しやすくし、拡張しやすい開発構成を目指しています。</p>
                </article>
                <article class="specforge-card">
                    <span class="specforge-card__eyebrow">Schema</span>
                    <h3 class="specforge-card__title">独自ドキュメントスキーマ</h3>
                    <p class="specforge-card__description">構造化データとして設計書を管理するための基盤として設計しています。</p>
                </article>
            </div>
        </div>
    </section>

    <section class="specforge-cta">
        <div class="specforge-wrap">
            <div class="specforge-cta__panel">
                <span class="specforge-cta__eyebrow">Next</span>
                <h2 class="specforge-cta__title">今後は、設計書の品質をさらに高める方向へ広げていきます</h2>
                <p class="specforge-cta__text">
                    品質スコア表示、入力不足や矛盾のチェック、参照関係の可視化、AIによるレビュー支援、Markdown / HTML 出力、各種テンプレート拡充などを通じて、設計書作成を単なる作業ではなく開発品質を支える仕組みにしていくことを目指しています。
                </p>
                <div class="specforge-cta__actions">
                    <a href="<?php echo esc_url(home_url('/blog/')); ?>" class="specforge-cta__button">記事一覧へ</a>
                    <a href="<?php echo esc_url(home_url('/about/')); ?>" class="specforge-cta__button specforge-cta__button--secondary">About も見る</a>
                </div>
            </div>
        </div>
    </section>
</div>

<?php
get_footer();

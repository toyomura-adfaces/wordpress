<!---------------------------- ★★echoが必要な関数★★ ---------------------------->

<?php echo get_the_date(); ?>

<?php echo esc_url(home_url()); ?>

<?php echo esc_url(get_template_directory_uri()); ?>

<?php echo get_month_link(); ?>

<?php echo paginate_links('パラメータ'); ?>

<!---------------------------- ★★汎用内容★★ ---------------------------->

<?php wp_head(); ?>

<?php wp_footer(); ?>
<!-- 言語の取得 -->
<?php language_attributes(); ?>

<!-- 文字コードの取得 -->
<?php bloginfo('charset'); ?>

<!-- descriptionの取得 -->
<?php bloginfo('description'); ?>

<!-- esc_urlはタグのエスケープ php文が、htmlタグに囲まれいるときに使用する-->
<?php echo esc_url(); ?>

<!-- テーマファイルまでのパス -->
<?php echo esc_url(get_template_directory_uri()); ?>

<!-- bodyにクラスを自動で付与 -->
<?php body_class(); ?>

<?php get_header(); ?>

<?php get_footer(); ?>

<?php get_sidebar(); ?>

<?php get_template_part('', '') ?>
<!-- 汎用的に作られたファイルを読み込む 第一引数にフォルダ名とファイルの前半 第二引数にファイルの後半 ハイフンは省略できる-->

<!-- topページまでのパスを取得 -->
<?php echo esc_url(home_url()); ?>

<!-- サイトのタイトルを取得 -->
<?php bloginfo('name'); ?>

<!-- 投稿のリンクを表示 ループの中で使用-->
<?php the_permalink(); ?>

<!-- ページのタイトルを表示 ループの中で使用-->
<?php the_title(); ?>

<!-- 管理画面にメニューを追加-->
<?php register_nav_menu('sample', 'サンプル'); ?>

<!-- 連想配列で複数登録も可能-->
<?php register_nav_menus(['sample' => 'サンプル', 'sample2' => 'サンプル2']); ?>

<!-- function.phpで設定したメニューを表示 連想配列で、theme_locationを指定したmenuにする-->
<?php wp_nav_menu(['theme_location' => 'main-menu',]); ?>

<!-- wpで用意した検索フォームを表示 -->
<?php get_search_form(); ?>

<!-- 検索したタイトルを表示 -->
<?php the_search_query(); ?>

<!-- ウィジェットの定義 -->
<?php if (is_active_sidebar('sidebar-widget-area')) : ?><!-- ウィジェットが作成されていれば (複数作成した場合は、2つ目から引数の末尾に-2や-3を追加)-->
    <aside class="sidebar">
        <?php dynamic_sidebar('sidebar-widget-area'); ?><!-- 作成したウィジェットを発火 -->
    </aside>
<?php endif; ?>

<!---------------------------- ★★投稿・固定ページ★★ ---------------------------->

<!-- IDを自動で付与 -->
<?php the_ID(); ?>

<!-- 投稿・記事にクラスを自動で付与 必ずループの中で使用 ループ外でも使えるがその場合は第二引数に投稿のIDを記載(第一引数は独自のクラスを指定できる)-->
<?php post_class(); ?>

<!-- 投稿記事の日付を取得 (datetime属性にも同様の記述をする 引数に書式を設定) the_dateの場合は同じ日付を一回しか出力できないため使わない-->
<?php echo get_the_date() ?>

<!-- 年、月の月別アーカイブのURLを返す アーカイブページへ移動 引数にget_the_dateで取得した値を代入-->
<?php echo get_month_link() ?>

<!-- ページが属するカテゴリーへのリンクを表示  アーカイブページへ移動　ループの中で使用-->
<?php the_category(','); ?>

<!-- カテゴリーの情報を配列として取得 デフォルト投稿のみ カスタム投稿は不可-->
<?php get_the_category() ?>

<!-- ページが属するタグを表示、アーカイブページへ移動 ループの中で使用　引数はリストで表示する場合-->
<?php the_tags('<ul><li>', '</li><li>', '</li></ul>'); ?>

<!-- ページ間リンクの追加 -->
<?php previous_post_link('&lt; %link'); ?>
<?php next_post_link('%link &lt;'); ?>

<!-- テンプレートの追加 -->
/*
Template Name:サイドバー無し 管理画面に追加
Template Post Type:post,page,hairstyles 投稿、カスタム投稿にも追加
*/

<!---------------------------- ★★カスタム投稿★★ ---------------------------->

<!-- カスタム投稿のアーカイブタイトルを表示 -->
<?php post_type_archive_title(); ?>

<!-- 投稿につけられたタームのリストを表示 -->
<?php the_terms(get_the_ID(), 'hairstyletype'); ?>

<!-- CPT UIの設定 -->

投稿タイプはアーカイブあり　抜粋ありに設定

タクソノミーは階層有に設定

<!-- ターム毎の一覧の作り方 new WP_Queryの引数にいれるもの-->

<?php
$args = [
    'post_type' => 'custom',//投稿タイプを設定
    'posts_per_page' => 6,
    'tax_query' => [
        [
            'taxonomy' => 'customs',//タクソノミーの種類を指定
            'field' => 'slug',//指定方法をスラッグにする
            'terms' => 'blog',//タームを指定 複数タームを指定する場合は配列にしてカンマで区切る
        ],
    ]
];
?>

<!---------------------------- ★★アーカイブ★★ ---------------------------->

<!--  現在のページのタグ、カテゴリーのタイトルを表示または取得する ループ外で使用可能-->
<?php single_term_title(); ?>

<!--  本文を抜粋して表示 <p>タグが強制的に入るので独自のクラスが付けられない-->
<?php the_excerpt(); ?>

<!--  <p>タグは入らず、本文のみ抜粋され、任意のクラスを付けれる echoとesc_htmlが必要 -->
<?php get_the_excerpt(); ?> ↓
<?php echo ecs_html(get_the_excerpt()); ?>

<!-- ページネーションを表示 引数指定で先頭、末尾に記号を指指定可能(連想配列) 固定ページでは使用不可-->
<?php the_posts_pagination() ?>

<!-- 固定ページで投稿一覧を作成 -->
<!-- 現在のページ番号を取得 1は初期の場合の数値-->
<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; ?>

<?php
$the_query = new WP_Query(array(
    'post_type' => 'post',
    'paged' => $paged,
    'posts_per_page' => 6,
));
?>

<!-- 固定ページでページネーションを取得 -->
<?php
if ($the_query->max_num_pages > 1) {
    echo paginate_links(array(
        'base' => get_pagenum_link(1) . '%_%',
        'format' => 'page/%#%/',
        'current' => max(1, $paged),
        'mid_size' => 1,
        'total' => $the_query->max_num_pages
    ));
}
wp_reset_postdata(); ?>


<!---------------------------- ★★条件分岐・ループ処理★★---------------------------->

<!-- 月別ページだった場合に表示 -->
<?php if (is_month()) : ?>
    <!-- 内容の表示 -->
<?php endif; ?>
<!-- メインクエリ Topページにメインで出す内容は管理画面の表示設定で替えれる-->
<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
        <!-- 内容の表示 -->
        <?php the_content(); ?>
    <?php endwhile ?>
<?php endif ?>

<!-- 条件を指定したループ(サブクエリ) -->

<?php
$neko_args = ['post_type' => 'post', 'posts_per_page' => 3, 'category_name' => '任意'];
//category_nameの設定で、カテゴリー毎に記事を抽出できる(スラッグを記述)
$neko_news_query = new WP_Query($neko_args);
if ($neko_news_query->have_posts()) :
    while ($neko_news_query->have_posts()) :
        $neko_news_query->the_post();
        get_template_part('template-parts/loop', 'post');
    endwhile;
    wp_reset_postdata();
endif; ?>


<!-- サムネイルが登録されていればアイキャッチ画像を表示 -->
<?php if (has_post_thumbnail()) : ?>
    <?php the_post_thumbnail('functions.phpで指定したものを入れる'); ?>
<?php endif; ?>



<!---------------------------- ★★functions★★ ---------------------------->

<?php
function neko_theme_setup() //neko_theme_setupは任意の関数
{
    add_theme_support('title-tag'); //特定の機能をテーマで使えるようにするための関数 この場合はタイトルを表示
    add_theme_support('post-thumbnails'); //アイキャッチ画像パネルを表示
    add_theme_support('html5', ['search-form']); //get_search_formを最新バージョンにする
    add_image_size('page_eyecatch', 1100, 600, true); //アイキャッチ画像のサイズを指定
    register_nav_menus(['main-menu' => 'メインメニュー', 'footer-menu' => 'フッターメニュー']); //管理画面にメニューを追加 連想配列で管理画面に出す名前を決める
}
add_action('after_setup_theme', 'neko_theme_setup'); //add_actionはの特定のタイミングで関数を実行するためのもの
//after_setup_themeはテーマを読み込んだあとに実行 '第二引数は実行する関数名


function neko_enqueue_scripts() //js,cssの読み込み
{
    wp_enqueue_script('jquery');
    wp_enqueue_script( //jsを定義する関数引数にそれぞれを指定する
        'kuroneko-theme-common', //第一引数 ハンドル名の指定
        get_template_directory_uri() . '/assets/js/theme-common.js', //パスを指定
        array(), //指定ファイルより前に読み込むファイルがあればそのハンドル名を指定する。今回は無いので初期値のarray()
        '1.0.0', //バージョン
        true //出力場所をwp_footer()にするならtrue 指定が無ければfalseとなる
    );
    wp_enqueue_style( //cssを定義する関数引数にそれぞれを指定する 引数は上記jsと同一
        'kuroneko-theme-styles',
        get_template_directory_uri() . '/assets/css/theme-styles.css',
        array(),
        '1.0'
    );
}
add_action('wp_enqueue_scripts', 'neko_enqueue_scripts'); //wp_enqueue_script()は指定したCSSやJavaScriptを読み込む
//第二引数は実行する関数名

function neko_widgets_init() //ウィジェットの関数を定義
{
    register_sidebar( //ウィジェットの内容を定義
        array(
            'name'          => 'サイドバー',
            'id'            => 'sidebar-widget-area',
            'description'   => '投稿・固定ページのサイドバー',
            'before_widget' => '<div id="%1$s" class="%2$s">', //コンテナの作成でIDとクラスを定義　クラスは作成した内容で変わる
            'after_widget'  => '</div>',
        )
    );
    register_sidebars( //ウィジェットの内容を一括で複数定義
        3, //footerを3つ作成
        [
            'name' => 'フッター%d', //%dで連番の定義
            'id' => 'footer-widget-area', //idは繰り上がる
            'description' => 'フッターのサイドバー',
            'before_widget' => '<div id="%1$s" class="%2$s">',
            'after_widget' => '</div>',
        ]
    );
};

add_action('widgets_init', 'neko_widgets_init'); //widgets_initのタイミングで関数を発火


//アーカイブページに全投稿を表示
function post_has_archive($args, $post_type)
{

    if ('post' == $post_type) {
        $args['rewrite'] = true;
        $args['has_archive'] = 'all';
    }
    return $args;
}
add_filter('register_post_type_args', 'post_has_archive', 10, 2);

?>

<!---------------------------- ★★プラグイン★★ ---------------------------->

<!-- Bureadcrumb パンくずリスト -->
<?php if (!is_home()) : ?>
    <!-- TOPページでは表示されない -->
    <?php if (function_exists('bcn_display')) : ?>
        <!-- 管理画面でプラグインが有効になっている場合 -->
        <nav class="breadCrumb" typeof="BreadcrumbList" vocab="http://schema.org/" aria-label="現在のページ">
            <?php bcn_display(); ?>
            <!-- 内容を表示 -->
        </nav>
    <?php endif; ?>
<?php endif; ?>
<!-- 設定画面でホームページテンプレートの%htitleをHomeに変更(適宜)% -->
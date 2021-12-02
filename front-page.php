<?php 
/*
Template Name:Front Page
*/
?>
<?php get_header("top"); ?>
<?php
    $themes = get_categories(array('parent' => 0));
    // var_dump($themes[1]);
    $themes_img = ["",
        "web-programming.png",
        "web-programming.png",
        "web-programming.png",
        "web-programming.png"
    ];
    // var_dump($themes[1]);
?>

<main class="front-page">
    <section class="firstview-container">
        <div class="blog-name">僕、コードで生きていく</div>
        <div class="blog-desc">
            <div>IT・プログラミング初心者</div>
            <div>パソコンを使い始めた人に</div>
            <div>わかりやすく</div>
        </div>
        <div class="pc-imgs">
            <img src="<?php echo $img_uri; ?>hpspectre.png"> 
            <img src="<?php echo $img_uri; ?>macair.png"> 
        </div>
    </section>
    <div class="black-desk"></div>
    <section class="top-container">
        <div class="side-left">
            <div class="side-wrap">
                <div class="table-name">目次</div>
                <ul>
                    <li><a href="">テーマ</a></li>
                    <li><a href="">プロフィール</a></li>
                    <li><a href="">テーマ別最新記事</a></li>
                    <li><a href="">テーマ別カテゴリー</a></li>
                    <li><a href="">最新記事</a></li>
                </ul>
                <div class="keyword-search-name">キーワード検索</div>
                <div class="keyword-search-wrap">
                    <div class="keyword-name">テーマ別</div>
                    <div class="keyword-wrap">
                        <div class="keyword">アプリ</div>
                        <div class="keyword">情報系学問</div>
                        <div class="keyword">プログラミング</div>
                        <div class="keyword">数学</div>
                    </div>
                    <div class="keyword-name">カテゴリー別</div>
                    <div class="keyword-wrap">
                        <div class="keyword">Slack</div>
                        <div class="keyword">Notion</div>
                        <div class="keyword">Google Spread Sheet</div>
                        <di class="keyword">数学</di>
                    </div>
                </div>
            </div>
        </div>
        <div class="theme-wrap">
            <div class="theme-title">
                テーマ
            </div>
            <div class="theme-boxes">
                <?php for ($i = 1; $i <=4 ; $i+=1) { 
                    $descriptions = explode("\n", $themes[$i]->category_description);
                    echo '<div class="theme-' . $i . '">';
                        echo '<div class="theme-box">';
                            echo '<div class="theme-content">';
                                echo '<span class="theme-name">' . $themes[$i]->name . '</span>';
                                echo '<img src="' . $img_uri . $themes_img[$i] . '" class="theme-prog-img">';
                                echo '<div class="theme-desc">';
                                    foreach ($descriptions as $description) {
                                        echo '<div>' . $description . '</div>';
                                    }
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                } ?>
            </div>
        </div> 
        <div class="side-right">
            <div class="side-wrap">

            </div>
        </div>
    </section>
    <section class="search-container">
        <?php get_search_form(); ?>
    </section>
    <section class="profile-container">
        <div class="section-name">プロフィール</div>
        <div class="profile-desc">
            <div>僕は、京都在住の理系大学生</div>
            <div>ポートフォリオ兼アウトプットのために開設</div>
            <div>便利なアプリ、サイト、プログラミング</div>
            <div>情報系学問、情報に必要な数学などを投稿する</div>
            <div>
                <form action="<?php echo get_template_directory_uri();?>/page.php" method="get">
                    <button>VIEW MORE</button>
                </form>
            </div>
        </div>
    </section>
    <section class="latest-article-theme-container">
        <div class="section-name">テーマ別最新記事</div>
        <div class="theme-wrap">
            <?php 
                $args = array(
                    "post_type" => "post",
                    "orderby" => "date",
                    "order" => "DESC",
                    "posts_per_page" => 2
                );
                global $post;
                for ($i=1; $i<=4; $i++) {
                    echo '<div class="theme-content">';
                        echo '<div class="theme-name-wrap">';
                            echo '<span class="theme-name theme-' . $themes[$i]->slug . '">' . $themes[$i]->name . '</span>';
                        echo '</div>';
                        // var_dump($theme);
                        $args += array("category" => (string)$themes[$i]->cat_ID);
                        $article_posts = get_posts($args);
                        // var_dump($args);
                        // var_dump($article_posts);
                        echo '<div class="theme-box">';
                        foreach ($article_posts as $post):
                            // var_dump($post);
                            setup_postdata($post);
                                echo '<div class="article-content">';
                                    echo '<div class="article-title">' . get_the_title() . '</div>';
                                    echo '<div class="img-box"></div>';
                                    echo '<div class="article-detail">';
                                        echo '<div class="article-date">' . get_the_date() . '</div>';
                                        $categories = get_the_category();
                                        foreach ($categories as $cat) :
                                            echo '<div class="article-categories">' . $cat->cat_name . '</div>';
                                        endforeach;
                                    echo '</div>';
                                echo '</div>';
                        endforeach;
                        echo '</div>';
                    echo '</div>';
                    wp_reset_postdata();
                    unset($args["category"]);
                }
            ?>
    </section>
    <section class="categories-theme-container">
        <div class="section-name">テーマ別カテゴリー</div>
        <div class="categories-wrap">
            <?php
                for ($i = 1; $i <= 4; $i++) {
                    echo '<div class="categories-box">';
                        echo '<div class="theme-name-wrap">';
                            echo '<div class="theme-name">' . $themes[$i]->name . '</div>';
                        echo '</div>';
                        echo '<div class="categories">';
                            echo '<ul>';
                            $app_cats = get_categories( array('parent' => ($themes[$i]->term_id)) );
                            foreach ($app_cats as $cat) {
                                echo '<li>';
                                echo '<a href="' . get_category_link($cat->cat_ID) . '">';
                                // echo '<a href="">';
                                echo $cat->name;
                                echo '</a>';
                                echo '</li>';
                            }
                            echo '</ul>';
                        echo '</div>';
                    echo '</div>';
                }
            ?>
        </div>
    </section>
</main>
<?php get_footer(); ?>
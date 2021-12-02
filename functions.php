<?php
    // 変数
    $page_uri = get_template_directory_uri() . "/page-";
    $img_uri = get_template_directory_uri() . "/assets/img/";
    // 関数
    define('WP_SCSS_ALWAYS_RECOMPILE', true);
    function add_my_scripts() {
        //WordPress 本体の jQuery を登録解除
        wp_deregister_script( 'jquery');  
        //jQuery を CDN から読み込む
        wp_enqueue_script( 'jquery', 
            '//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js', 
            array(), 
            '3.3.1', 
            true //</body> 終了タグの前で読み込み
        );
        wp_enqueue_script("top-header-script",
            get_theme_file_uri("assets/js/main.js"),
            array("jquery"),
            "20210428",
            false
        );
        if (is_single()) {
            wp_enqueue_script("single-script",
                get_theme_file_uri("assets/js/single.js"),
                array("jquery"),
                "20210428",
                false
            );
        }
    }
    add_action("wp_enqueue_scripts", "add_my_scripts");

    function add_my_styles() {
        wp_enqueue_style("main-style",
            get_theme_file_uri("/assets/css/style.css"),
            array(),
            filemtime(get_theme_file_path("/assets/css/style.css"))
        );
    }
    add_action("wp_enqueue_scripts", "add_my_styles");
    
    // prism
    // prism.jsを有効化
    // function my_prism() {
    //     wp_enqueue_style( 'prism-style', get_stylesheet_directory_uri() . 'assets/prism/prism.css' ); // 第2引数には自身がファイルをアップロードしたパスを指定
    //     wp_enqueue_script( 'prism-script', get_stylesheet_directory_uri() . 'assets/prism/prism.js', array('jquery'), '1.9.0', true ); // 第2引数には自身がファイルをアップロードしたパスを指定
    // }
    // add_action( 'wp_enqueue_scripts', 'my_prism' );

    /* ----- WP以外の関数 ----- */
    // get_the_content()の戻り値を配列に変換
    function get_content_array($str) {
        // 前後のwp:paragraphで区切る
        $word1 = "<!-- wp:paragraph -->";
        $word2 = "<!-- /wp:paragraph -->";
        $explode1_array = explode($word1, $str);
        $explode2_array = array();
        $return = array();
        // ２次元配列を１次元に
        foreach ($explode1_array as $value) {
            $explode2_array = array_merge($explode2_array, explode($word2, $value));
        }
        foreach ($explode2_array as $value) {
            $value = str_replace(array("　"), "", $value);
            if ( !empty($value) ) {
                array_push($return, $value);
            }
        }
        return $return;
    }
    // contents(配列)をHTML出力
    function echo_contents($contents) {
        foreach ($contents as $tag) {
            echo $tag;
        }
    }
    // contents(配列)のpタグのみHTML出力
    function echo_contents_ptag($contents) {
        foreach ($contents as $tag) {
            if ( strpos($tag, "<p>") === false ) continue;
            echo $tag;
        }
    }
    // contents(配列から)imgタグのuriを配列にして取得
    function get_img_uris_contents($contents) {
        $content_img_uris = array();
        $matchs = array();
        foreach ($contents as $tag) {
            if ( strpos($tag, "<img") === false ) continue;
            $output = preg_match_all('/<img.*?src\s*=\s*[\"|\'](.*?)[\"|\'].*?>/i', $tag, $matchs);
            $content_img_uris[] = $matchs[1][0];
            // echo $matchs[1][0];
        }
        return $content_img_uris;
    }
?>
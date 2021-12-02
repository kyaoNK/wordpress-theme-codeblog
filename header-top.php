<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title><?php wp_title('|', true, 'right'); ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-width=1.0, minimum-width=1.0">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css">
        <?php $img_uri = get_template_directory_uri() . "/assets/img/"; ?>
        <link rel="apple-touch-icon" sizes="180x180" href="<?php echo $img_uri;?>/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $img_uri;?>/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $img_uri;?>/favicon-16x16.png">
        <link rel="manifest" href="/site.webmanifest">
        <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#00a99d">
        <meta name="msapplication-TileColor" content="#00aba9">
        <meta name="theme-color" content="#00a99d">
        <?php wp_head(); ?>
    </head>
    <body>
        <header class="main-header">
            <a class="menu">
                <span class="menu_line menu_line_top"></span>
                <span class="menu_line menu_line_center"></span>
                <span class="menu_line menu_line_bottom"></span>
            </a>
            <nav class="full-nav">
                    <div class="full-nav-wrap">
                        <ul>
                            <li><a class="blog-name" href="">僕、コードで生きていく</a></li>
                            <li><a href="">プロフィール</a></li>
                            <li><a href="">お問い合わせ</a></li>
                            <li><?php get_search_form(); ?></li>
                        </ul>
                    </div>
                </nav>
        </header>
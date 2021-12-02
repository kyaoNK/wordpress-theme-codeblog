<?php
    $thisCat = get_category( $cat );
    $catName = $thisCat->name;
?>

<?php get_header(); ?>

<main class="category-categories">
    <section class="category-container">
        <div class="category-desc-wrap">
            <div class="wrap-column">
                <div class="category-title"><?php single_cat_title(); ?></div>
                <img src="<?php echo $img_uri; ?>web-programming.png"/>
            </div>
            <div class="category-desc">
                <?php echo category_description(); ?>
            </div>
        </div>
        </div>
    </section>
    <section class="single-category-wrap">
        <div class="single-wrap">
            <?php 
                $arg = array(
                    "orderby" => "date",
                    "order" => "DESC",
                    "category_name" => $catName
                );
                $posts = get_posts($arg);
                if ($posts) :
                    foreach ($posts as $post) :
                        setup_postdata($post);
            ?>
            <div class="single-box">
                <?php 
                    the_time("Y.m.d");
                    the_title();
                ?>
            </div>
            <?php 
                endforeach;
                endif;
                wp_reset_postdata();
            ?>
        </div>
    </section>
    <section class="search-container">
        <?php get_search_form(); ?>
    </section>
</main>

<?php get_footer(); ?>
<?php
    $thisCat = get_category( $cat );
    $childCats = get_categories(array("child_of" => $thisCat -> cat_ID));
?>

<?php get_header(); ?>

<main class="category-theme">
    <section class="theme-container">
        <div class="theme-desc-wrap">
            <div class="wrap-column">
                <div class="theme-title"><?php single_cat_title() ?></div>
                <div class="theme-desc"><?php echo category_description(); ?></div>
            </div>
            <img src="<?php echo $img_uri; ?>web-programming.png"/>
        </div>
        <div class="theme-categories-wrap">
            <ul class="theme-categories">
                <?php 
                    foreach ($childCats as $childCat){
                        echo "<li>" . $childCat->name . "</li>";
                    };
                ?>
            </ul>
        </div>
    </section>
    <section class="search-container">
        <?php get_search_form(); ?>
    </section>
    <section class="categories-theme-wrap">
        <div class="categories-wrap">
            <?php 
                foreach ($childCats as $childCat) : 
                $catName = $childCat->name;
            ?>
            <div class="category-name"><?php echo $childCat->name; ?></div>            
            <div class="category-single-wrap">
                <?php 
                    $arg = array(
                        "posts_per_page" => 3,
                        "orderby" => "date",
                        "order" => "DESC",
                        "category_name" => $catName
                    );
                    $posts = get_posts($arg);
                    if ($posts) :
                        foreach ($posts as $post) :
                            setup_postdata( $post );
                ?>
                <div class="category-single-box">
                    <?php 
                            the_time("Y.m.d");
                            echo "<br>";
                            the_title();
                    ?>
                </div>
                <?php 
                    endforeach;
                    endif;
                    wp_reset_postdata();
                ?>
            </div>
            
            <?php endforeach; ?>
        </div>
    </section>
</main>

<?php get_footer(); ?>
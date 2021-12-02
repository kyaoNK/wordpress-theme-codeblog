<?php get_header(); ?>
<section class="single">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <div id="left-container">
        <div id="single-title-container">
            <?php 
                $categories = get_the_category();
                $category = $categories[0];
                $theme = $categories[1];
            ?>
            <div id="detail-wrap">
                <div id="theme-category">
                    <div id="theme" class="box"><?php echo $theme->name; ?></div>
                    <div id="category" class="box"><?php echo $category->name; ?></div>
                </div>
                <div id="date"><?php the_time("Y/m/d"); ?></div>
            </div>
            <div id="title"><?php the_title(); ?></div>
        </div>
        <div id="img-container">
            <img src="" id="single-img">
        </div>
    </div>
    <div id="right-container">
        <div id="single-text"></div>
    </div>
    <?php 
        $content = get_the_content(); 
        $contents = get_content_array($content);
        $json_array = json_encode($contents);
    ?>
    <?php endwhile; endif; ?>
    <script>
        const contents = <?php echo $json_array; ?>;
    </script>
</section>

<?php
// Check if this is the English page
if (is_page('en') || get_query_var('pagename') == 'en') {
    include 'page-en.php';
} else {
    // Default page template
    get_header(); ?>
    
    <main>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1><?php the_title(); ?></h1>
                    <div class="content">
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
    <?php get_footer();
}
?>

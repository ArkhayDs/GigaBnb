<?php get_header()?>


<?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>

<!--            <img src="--><?php //the_post_thumbnail_url();?><!--" style="...">-->

            <div class="card mb-3 bg-light bg-opacity-50 position-absolute top-50 start-50 translate-middle text-center">
                <div class="card-body">
                    <h5 class="card-title"><?php the_title()?></h5>
                    <p class="card-text"><?php the_content()?></p>
                    <a href="<?= get_post_type_archive_link( 'post' ); ?>" class="btn btn-primary">Les articles</a>
                </div>
            </div>

        <?php endwhile; endif; ?>

<?php get_footer()?>

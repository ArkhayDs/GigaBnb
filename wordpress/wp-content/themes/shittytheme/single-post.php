<?php get_header()?>

<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>

        <div class="card mb-3">
<!--            <img src="--><?php //the_post_thumbnail_url();?><!--" class="card-img-top" alt="...">-->
            <div class="card-body">
                <h5 class="card-title"><?php the_title()?></h5>

                <?php if(get_post_type() === 'product') : ?>
                <p><small>Detail(s) : <?php the_terms(get_the_ID(),'type'); the_terms(get_the_ID(),'modalite',', '); ?></small></p>
                <?php endif; ?>

                <p class="card-text"><?php the_content();?></p>
                <p class="card-text"><?php the_excerpt();?></p>

                <?php if(get_post_type() === 'product') : ?>
                    <p class="card-text">
                    <?php if (get_post_meta(get_the_ID(),'product-price',true)) : ?>
                        <p class="card-text">Prix : <?php echo get_post_meta(get_the_ID(),'product-price',true);?>€
                    <?php endif; ?>

                    <?php if (get_post_meta(get_the_ID(),'product-availability',true)) : ?>
                        <br/>Disponible à partir du : <?php echo date_format(new DateTime(get_post_meta(get_the_ID(),'product-availability',true)),"d/m/Y");?>
                    <?php endif; ?>

                    <?php if (get_post_meta(get_the_ID(),'product-area',true)) : ?>
                        <br/>Surface : <?php echo get_post_meta(get_the_ID(),'product-area',true);?>m²
                    <?php endif; ?>
                    </p>
                <?php endif; ?>

                <p class="card-text"><small class="text-muted">Publié le : <?php the_date(); ?></small></p>
            </div>
        </div>

    <?php endwhile; ?>
<?php else : ?>
    <h2>Pas de posts</h2>
<?php endif; ?>

<?php get_footer(); ?>

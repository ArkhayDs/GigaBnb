<?php get_header()?>

<h1>Hello World !</h1>

<?php if (have_posts()) : ?>
<div class="row row-cols-1 row-cols-md-3 g-4">
    <?php while (have_posts()) : the_post(); ?>

    <div class="col">
        <div class="card">
            <img src="<?php the_post_thumbnail_url();?>" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title"><?php the_title()?></h5>
                <p><small>Detail(s) : <?php the_terms(get_the_ID(),'type'); the_terms(get_the_ID(),'modalite'); ?></small></p>
                <p class="card-text"><?php the_excerpt()?></p>
                <a href="<?php the_permalink()?>" class="btn btn-primary">Lire plus</a>
            </div>
        </div>
    </div>

    <?php endwhile; ?>
</div>
<?php else : ?>
    <h2>Pas de posts</h2>
<?php endif; ?>

<?php get_footer()?>

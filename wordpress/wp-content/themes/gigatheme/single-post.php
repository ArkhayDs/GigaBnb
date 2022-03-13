<?php get_header()?>

<main>
    <section class="detail_bien">

        <h1><?php the_title()?></h1>
        <br>
        <img src="<?php the_post_thumbnail_url();?>" class="main-image">
        <div class="thumbnails">
            <img class="thumbnail">
            <img class="thumbnail">
            <img class="thumbnail">
        </div>
        <br>
        <div class="location_and_price">
            <h2><?php echo the_terms(get_the_ID(),'localisation');?></h2>
            <h2 class="yellow">Prix : <?php echo get_post_meta(get_the_ID(),'product-price',true);?>€</h2>
        </div>

        <p class="description"><?php the_excerpt();?></p>

        <p class="card-text"><small class="text-muted">Publié le : <?php the_date(); ?></small></p>

        <br>
        <hr>
        <div class="detail_footer">
            <div class="seller">
                <img class="seller_portrait">
                <div class="seller_infos">
                    <h2>[nom de l'agent]</h2>
                    <h3>[type d'agent]</h3>
                </div>
            </div>

            <div class="buy_button_container">
                <img class="hand_gif" src="./assets/Page_bien/main.gif" alt="">
                <a href="/">
                    <img class="buy_button" src="./assets/Page_bien/bouton_acheter.png" alt="">
                </a>
            </div>
        </div>
        <div>
            <?php if (comments_open()) : ?>

                <?php comments_template('/template-parts/comments.php'); ?>

            <?php endif ?>
        </div>
    </section>
</main>

<?php get_footer(); ?>

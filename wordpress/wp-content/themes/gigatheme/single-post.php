<?php get_header() ?>
<main>
    <section class="detail_bien">
        <h1><?php the_title() ?></h1>
        <br>
        <figure class="offer_thumbnail_detail">
            <img class="main-image" src="<?php the_post_thumbnail_url(); ?>">
        </figure>
        <br>
        <div class="location_and_price">
            <h2> <?php echo get_post_meta(get_the_ID(), 'product-area', true); ?>m², <?php the_terms(get_the_ID(), 'type');
                the_terms(get_the_ID(), 'modalite', ' - '); ?></h2>
            <h2 class="yellow"><?php echo get_post_meta(get_the_ID(), 'product-price', true); ?> €</h2>
        </div>
        <p class="description"><?php the_excerpt(); ?></p>
        <p class="description"><?php echo get_post_meta(get_the_ID(), 'product-area', true); ?>m2
        <br /><?php echo get_post_meta(get_the_ID(), 'product-bedrooms', true); ?> chambres.
        <br /><?php echo get_post_meta(get_the_ID(), 'product-rooms', true); ?> pièces.</p>
        <br>
        <hr>
        <div class="detail_footer">
            <div class="seller">
                <img class="seller_portrait">
                <div class="seller_infos">
                    <h2><?php the_author(); ?></h2>
                </div>
            </div>
            <div class="buy_button_container">
                <img class="hand_gif" src="./assets/Page_bien/main.gif" alt="">
                <a href="/">
                    <img class="buy_button" src="./assets/Page_bien/bouton_acheter.png" alt="">
                </a>
            </div>
        </div>
    </section>
</main>

<hr>
<?php if (comments_open()) : ?>
    <?php comments_template('/template-parts/comments.php'); ?>
<?php endif ?>

<?php get_footer(); ?>
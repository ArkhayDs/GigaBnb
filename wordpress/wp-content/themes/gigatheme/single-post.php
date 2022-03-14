<?php get_header() ?>

    <!-- <?php // if (have_posts()) :
    ?>
    <?php // while (have_posts()) : the_post();
    ?>

        <div class="card mb-3">
            à supprimer à tout prix merci beaucoup. Remplacer par un slider des images liées au produit
            <img src="<?php // the_post_thumbnail_url();
    ?>" class="card-img-top" alt="..." width="200" height="200">
            <div class="card-body">
                <h5 class="card-title"><?php // the_title()
    ?></h5>

                <? // php //  if (get_post_type() === 'product') :
    ?>
                    <p><small>Detail(s) : <?php // the_terms(get_the_ID(), 'type');
    // the_terms(get_the_ID(), 'modalite', ', ');
    ?></small></p>
                <? // php //  endif;
    ?>

                <p class="card-text"><?php // the_content();
    ?></p>
                <p class="card-text"><?php // the_excerpt();
    ?></p>

                <?php // if (get_post_type() === 'product') :
    ?>
                    <p class="card-text">
                        <? // php //  if (get_post_meta(get_the_ID(), 'product-price', true)) :
    ?>
                    <p class="card-text">Prix : <?php // echo get_post_meta(get_the_ID(), 'product-price', true);
    ?>€
                    <? // php //  endif;
    ?>

                    <?php // if (get_post_meta(get_the_ID(), 'product-availability', true)) :
    ?>
                        <br />Disponible à partir du : <?php // echo date_format(new DateTime(get_post_meta(get_the_ID(), 'product-availability', true)), "d/m/Y");
    ?>
                    <?php // endif;
    ?>

                    <?php // if (get_post_meta(get_the_ID(), 'product-area', true)) :
    ?>
                        <br />Surface : <?php // echo get_post_meta(get_the_ID(), 'product-area', true);
    ?>m²
                    <?php // endif;
    ?>
                    </p>
                <?php // endif;
    ?>

                <p class="card-text"><small class="text-muted">Publié le : <?php // the_date();
    ?></small></p>
            </div>

            <?php // if (comments_open()) :
    ?>

                <?php // comments_template('/template-parts/comments.php');
    ?>

            <? // php //  endif
    ?>

        </div>

    <?php // endwhile;
    ?>
<?php // else :
    ?>
    <h2>Pas de posts</h2>
<?php // endif
    ?> -->

<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>

        <main>
            <section class="detail_bien">
                <h1><?php the_title() ?></h1>
                <br>
                <figure class="offer_thumbnail_detail">
                    <img class="main-image" src="<?php the_post_thumbnail_url(); ?>">
                </figure>
                <!-- <div class="thumbnails">
            <img class="thumbnail">
            <img class="thumbnail">
            <img class="thumbnail">
        </div> -->
                <br>
                <div class="location_and_price">
                    <h2> <?php echo get_post_meta(get_the_ID(), 'product-area', true); ?>m², <?php the_terms(get_the_ID(), 'type');
                        the_terms(get_the_ID(), 'modalite', ' - '); ?></h2>
                    <h2 class="yellow"><?php echo get_post_meta(get_the_ID(), 'product-price', true); ?> €</h2>
                </div>
                <p class="description"><?php the_excerpt(); ?>
                </p>
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
            </section>
        </main>

    <?php endwhile; ?>
    <hr>
    <?php if (comments_open()) : ?>
        <?php comments_template('/template-parts/comments.php'); ?>
    <?php endif ?>
<?php else : ?>
    <h2>Pas de posts</h2>
<?php endif; ?>

<?php get_footer(); ?>
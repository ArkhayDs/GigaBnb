<?php get_header() ?>

<!--ON CREE UNE SECONDE QUERY CUSTOM AFIN DE STOCKER NOS CPT PRODUCTS-->
<?php $args = array( 'post_type' => 'product' ); ?>
<?php $products_query = new WP_Query($args); ?>

<main>
    <section class="contain_all">
        <img class="top_banner" src="<?= get_template_directory_uri() ?>/assets/images/Homepage/banner.png" alt="Publicité">
        <div>
            <h1 class="title">Cherchez un bien</h1>

            <div class="contain_searchbar">
                <div class="search_container">
                    <?php get_search_form(); ?>
                </div>
            </div>
        </div>

        <section class="content">
            <aside class="container_filters">
                <h2 class="title_filters">Filtres</h2>
                <div class="container_list">
                    <h3>Types de logement</h3>
                    <ul class="logement">
                        <li><input type="checkbox"> Maison</li>
                        <li><input type="checkbox"> Appartement</li>
                        <li><input type="checkbox"> Manoir</li>
                        <li><input type="checkbox"> Château</li>
                        <li><input type="checkbox"> Autre</li>
                    </ul>
                </div>
                <div class="container_list">
                    <h3>Types d'acquisition</h3>
                    <ul class="acquisition">
                        <li><input type="checkbox"> Achat</li>
                        <li><input type="checkbox"> Viager</li>
                    </ul>
                </div>
                <div class="container_list">
                    <h3>Fourchette de prix</h3>
                    <ul class="price">
                        <li><input type="checkbox">
                            < 100€</li>
                        <li><input type="checkbox"> 100€ - 100k€</li>
                        <li><input type="checkbox"> 100k - 1m€</li>
                        <li><input type="checkbox"> 1m€ - 100m€</li>
                        <li><input type="checkbox"> > 1M€</li>
                    </ul>
                </div>

                <div class="validation">
                    <input type="submit" value="Appliquer">
                </div>
            </aside>

            <?php if ($products_query->have_posts()) : ?>
                <section class="container_offers">

                    <?php while ($products_query->have_posts()) : $products_query->the_post(); ?>

                        <div class="offer">
                            <div class="offer_infos">
                                <figure class="offer_thumbnail">
                                    <img src="<?php the_post_thumbnail_url(); ?>">
                                </figure>
                                <div class="container_details">
                                    <p class="title_offer"><?php the_title() ?></p>
                                    <p class="location"></p>
                                    <p class="price_offer"><?php echo get_post_meta(get_the_ID(), 'product-price', true); ?> €</p>
                                    <p><?php echo the_terms(get_the_ID(), 'type');
                                        the_terms(get_the_ID(), 'modalite', ' - ') ?></p>
                                </div>
                            </div>
                            <a class="see_more" href="<?= the_permalink(); ?>">
                                <img src="<?= get_template_directory_uri() ?>/assets/images/Homepage/see_more_button.png" alt="En savoir plus">
                            </a>
                        </div>

                    <?php endwhile; ?>
                </section>
<!--                    --><?php //gigaPagination($query) ?>
            <?php else : ?>
                <h2>Pas de posts</h2>
            <?php endif; ?>

        </section>
        <img src="<?= get_template_directory_uri() ?>/assets/images/Homepage/congrats_popup.png" alt="pop-up publicitaire" class="bottom_banner">
    </section>
</main>

<?php get_footer() ?>
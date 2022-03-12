<?php get_header()?>

<main>
    <section class="contain_all">
        <img class="top_banner" src="<?= get_template_directory_uri() ?>/assets/images/Homepage/banner.png" alt="Publicité">
        <div>
            <h1 class="title">Cherchez un bien</h1>

            <div class="contain_searchbar">
                <div class="search_container">
                    <h3> Recherche</h3>
                    <input type="search" name="Rechercher" placeholder="Recherchez">
                </div>
                <button type="submit"> Trier </button>
                <button type="submit"> Reinitialiser</button>
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
                        <li><input type="checkbox">  < 100€</li>
                        <li><input type="checkbox"> 100€ - 100k€</li>
                        <li><input type="checkbox"> 100k - 1m€</li>
                        <li><input type="checkbox"> 1m€ - 100m€</li>
                        <li><input type="checkbox">  > 1M€</li>
                    </ul>
                </div>

                <div class="validation">
                    <input type="submit" value="Appliquer">
                </div>
            </aside>

            <section class="container_offers">
                <div class="offer">
                    <div class="offer_infos">
                        <img class="offer_thumbnail">
                        <div class="container_details">
                            <p class="title_offer">[Nom du bien]</p>
                            <p class="location">[ville - pays]</p>
                            <p class="price_offer">Prix</p>
                            <p>[type de logement - type d'acquisition]</p>
                        </div>
                    </div>
                    <a class="see_more">
                        <img src="<?= get_template_directory_uri() ?>/assets/images/Homepage/see_more_button.png" alt="En savoir plus">
                    </a>
                </div>
            </section>
        </section>
        <img src="<?= get_template_directory_uri() ?>/assets/images/Homepage/congrats_popup.png" alt="pop-up publicitaire" class="bottom_banner">
    </section>
</main>

<?php get_footer()?>

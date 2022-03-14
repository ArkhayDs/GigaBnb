<?php

/**
 * Template Name: Account menu - Giga Theme
 * Description: Giga Theme Account menu.
 */

get_header();

$args = array(
    'post_type' => 'product',
    'author' => $current_user->ID,
);

$user_products_query = new WP_Query($args);

?>
<?php
/**
 * Template Name: Edit Account Form - Giga Theme
 * Description: Giga Theme edit Account Form.
 */
get_header();

?>

    <main>
        <div class="compte">
            <h1>Mon compte</h1>
            <figure>
                <img src="" alt="">
            </figure>
            <button>Modifier photo de profil</button>
            <form action="Modifier_nom">
            <span>
                <label>Modifier nom :</label>
                <input type="text" placeholder="Modifier mon nom" name="log">
            </span>
                <input type="submit" id='submit' value='modifier mon nom' name="wp-submit">
            </form>
            <form action="Modifier_mdp">
            <span>
                <label>Modifier mot de passe :</label>
                <input type="password" placeholder="Modifier mon mot de passe" name="pwd">
            </span>
                <input type="submit" id='submit' value='modifier mon mot de passe' name="wp-submit">
            </form>
        </div>
    </main>

    <main>
        <div class="compte">
            <h1>Mon compte</h1>
            <section class="info_profil">
                <figure>
                    <img src="<?= get_avatar_url($current_user->ID) ?>" alt="">
                </figure>
                <div>
                    <div class="infos">
                        <h3><?= $current_user->nickname ?></h3>
                        <h3><?= $current_user->user_email ?></h3>
                        <h3>Propriétés :</h3>
                    </div>
                    <div class="modif_infos">
                        <a href="#"><img src="./assets/images/Page-compte/edit.svg" alt=""></a>
                    </div>
                </div>
            </section>
            <section>
                <table>
                    <thead>
                    <tr>
                        <th scope="col">Nom du bien</th>
                        <th scope="col">Prix</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <?php if ($user_products_query->have_posts()) : ?>
                        <tbody>
                        <?php while ($user_products_query->have_posts()) : $user_products_query->the_post(); ?>
                            <tr>
                                <th scope="row"><?= the_title(); ?></th>
                                <td><?php echo get_post_meta(get_the_ID(), 'product-price', true); ?> €</td>
                                <td><a href="">Voir +</a></td>
                            </tr>
                        <?php endwhile; ?>
                        </tbody>
                    <?php endif; ?>
                </table>

            </section>
                <a href="<?= wp_logout_url(home_url()); ?>">Déconnexion</a>
        </div>
    </main>

<?php
get_footer(); ?>
<?php
/**
 * Template Name: Vendor Form - Giga Theme
 * Description: Giga Theme vendor form.
 */
get_header();

if( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['newpost'] )) { // has the form been submitted ?

    $post_title = $_POST["name"];
    $post_location = $_POST["localisation"];
    $post_price = $_POST["price"];
    $post_desc = $_POST["description"];
    $post_author = get_current_user_id();

    $post_type = $_POST["type"];
    $post_modalite = $_POST["modalite"];

    $newpost = array(
        'post_title' => $post_title,
        'post_excerpt' => $post_desc,
        'post_author' => $post_author,
        'post_status' => 'pending',
        'post_type' => 'product'
    );

    $post_id = wp_insert_post($newpost);

    if ($post_id) {
        // insert custom meta
        add_post_meta($post_id, 'product-price', $post_price); // to do - add for other metas
        // problème, si on passe des strings il peut y avoir des conflits de hiérarchie entre les terms (e.g. : 6e arr Paris / 6e arr Lyon)
        // il faut fetch la liste des terms pour chaque type (et dans l'idéal pousser l'id à chaque fois des parents & enfants à ajouter)
        wp_set_post_terms($post_id, $post_type, 'type');
        wp_set_post_terms($post_id, $post_location, 'location');
        wp_set_post_terms($post_id, $post_modalite, 'modalite');
    }
    wp_redirect( get_permalink($post_id) );

} else {

if (is_user_logged_in()) { // is user logged in before presenting form ?

    $current_user = wp_get_current_user();

?>

<main>
    <div class="vente">
        <form action="" id="new_post" name="new_post" method="POST">
            <h1>Proposer un bien</h1>

            <span>
                <label>Nom du bien :</label>
                <input type="text" placeholder="Entrez le nom du bien" name="name" required>
            </span>
            <span>
                <label>Localisation :</label>
                <input type="text" placeholder="Entrez la localisation du bien" name="localisation" required>
            </span>
            <span>
                <label>Prix (€) :</label>
                <input type="number" placeholder="Entrez le prix de vitre bien" name="price" required>
            </span>
            <div>
                <label>Description :</label>
                <textarea cols="50" rows="10" placeholder="Décrivez votre bien" name="description" required></textarea>
            </div>
            <div class="checkboxes_container">
                <div class="type">
                    <h3>Type de logement</h3>
                    <span>
                        <input class="checkbox" type="radio"  name="type" required>
                        <label class="checkbox-label">Maison</a></label>
                    </span>
                    <span>
                        <input class="checkbox" type="radio"  name="type" required>
                        <label class="checkbox-label">Appartement</label>
                    </span>
                    <span>
                        <input class="checkbox" type="radio"  name="type" required>
                        <label class="checkbox-label">Domaine</label>
                    </span>
                    <span>
                        <input class="checkbox" type="radio"  name="type" required>
                        <label class="checkbox-label">Viager</label>
                    </span>
                    <span>
                        <input class="checkbox" type="radio"  name="type" required>
                        <label class="checkbox-label">Chalet</label>
                    </span>
                </div>
                <div class="type">
                    <h3>type de logement</h3>
                    <span>
                        <input class="checkbox" type="radio"  name="modalite" required>
                        <label class="checkbox-label">Achat</label>
                    </span>
                    <span>
                        <input class="checkbox" type="radio"  name="modalite" required>
                        <label class="checkbox-label">Viager</a></label>
                    </span>
                </div>
            </div>

            <div class="pic_section">
                <h2>↓ Postez vos photos ici ↓</h2>
                <button>
                    <img src="../assets/images/Page_vendre_bien/photo_camera.png" alt="">
                </button>
                <div class="preview">
                    <!-- Choisir a integrer ou pas -->
                    <span><p>photo_de_ma_magnifique_maison(6).jpg</p><button><img src="../assets/images/Page_vendre_bien/x.svg" alt=""></button></span>
                </div>
            </div>

<!--            TO DELETE -->
            <input type="hidden" name="newpost" value="post" />

            <button type="submit" id='submit' value='' name="submit">
                <img src="../assets/images/Page_vendre_bien/bouton_vente.png" alt="">
            </button>

            <?php wp_nonce_field( 'new_post' ); ?>
        </form>
    </div>
</main>

<?php
    } else {
        echo 'please login';
    }
}
get_footer();?>
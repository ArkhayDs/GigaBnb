<?php
/**
 * Template Name: Vendor Form - Giga Theme
 * Description: Giga Theme vendor form.
 */
if( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) &&  $_POST['action'] == "new_post" ) { // has the form been submitted ?

    $post_title = $_POST["postname"];
    $post_price = $_POST["price"];
    $post_area = $_POST["area"];
    $post_bedrooms = $_POST["bedrooms"];
    $post_rooms = $_POST["rooms"];
    $post_desc = $_POST["description"];
    $post_author = get_current_user_id();

    $post_type = get_term_by('name',$_POST["type"],'type')->term_id; // -> is a hierarchical taxo
    $post_location = get_term_by('name',$_POST["localisation"],'localisation')->term_id; // -> is a hierarchical taxo
    $post_modalite = $_POST["modalite"]; // -> is a tag

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
        add_post_meta($post_id, 'product-area', $post_area); // to do - add for other metas
        add_post_meta($post_id, 'product-bedrooms', $post_bedrooms); // to do - add for other metas
        add_post_meta($post_id, 'product-rooms', $post_rooms); // to do - add for other metas
        wp_set_post_terms($post_id, $post_type, 'type');
        wp_set_post_terms($post_id, $post_location, 'localisation');
        wp_set_post_terms($post_id, $post_modalite, 'modalite');
    }

    wp_redirect( "/" );

    get_header();

} else {

    if (is_user_logged_in()) { // is user logged in before presenting form ?

        $current_user = wp_get_current_user();

get_header();

?>

<main>
    <div class="vente">

        <form id="new_post" name="new_post" method="POST">

            <h1>Proposer un bien</h1>

            <span>
                <label>Nom du bien :</label>
                <input type="text" placeholder="Entrez le nom du bien" name="postname" required>
            </span>
            <span>
                <label>Localisation :</label>
                <input type="text" placeholder="Entrez la localisation du bien" name="localisation" required>
            </span>
            <span>
                <label>Prix (€) :</label>
                <input type="number" placeholder="Entrez le prix de vitre bien" name="price" required>
            </span>
            <span>
                <label>Surface (m2) :</label>
                <input type="number" placeholder="Entrez la surface de votre bien" name="area" required>
            </span>
            <span>
                <label>Nombre de chambres :</label>
                <input type="number" placeholder="Entrez le nombre de chambres de votre bien" name="bedrooms" required>
            </span>
            <span>
                <label>Nombre de pièces :</label>
                <input type="number" placeholder="Entrez le nombre de pièces de votre bien" name="rooms" required>
            </span>
            <div>
                <label>Description :</label>
                <textarea cols="50" rows="10" placeholder="Décrivez votre bien" name="description" required></textarea>
            </div>
            <div class="checkboxes_container">
                <div class="type">
                    <h3>Type de logement</h3>
                    <span>
                        <input class="checkbox" type="radio"  name="type" value="Maison" required>Maison
                    </span>
                    <span>
                        <input class="checkbox" type="radio"  name="type" value="Appartement" required>Appartement
                    </span>
                    <span>
                        <input class="checkbox" type="radio"  name="type" value="Duplex" required>Duplex
                    </span>
                    <span>
                        <input class="checkbox" type="radio"  name="type" value="Villa" required>Villa
                    </span>
                    <span>
                        <input class="checkbox" type="radio"  name="type" value="Domaine" required>Domaine
                    </span>
                    <span>
                        <input class="checkbox" type="radio"  name="type" value="Viager" required>Viager
                    </span>
                    <span>
                        <input class="checkbox" type="radio"  name="type" value="Chalet" required>Chalet
                    </span>
                </div>
                <div class="type">
                    <h3>Modalité de paiement</h3>
                    <span>
                        <input class="checkbox" type="radio"  name="modalite" value="Achat" required>Achat
                    </span>
                    <span>
                        <input class="checkbox" type="radio"  name="modalite" value="Location" required>Location
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

            <button type="submit" id='submit' value='' name="submit">
                <img src="../assets/images/Page_vendre_bien/bouton_vente.png" alt="">
            </button>

            <input type="hidden" name="action" value="new_post" />
            <?php wp_nonce_field( 'cpt_nonce_action','cpt_nonce_field' ); ?>
        </form>
    </div>
</main>

<?php
    } else {
        echo 'please login';
    }
}
get_footer();
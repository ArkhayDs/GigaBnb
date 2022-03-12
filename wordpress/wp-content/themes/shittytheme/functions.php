<?php
function shitty_theme_startup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');

    add_theme_support('menus');
    register_nav_menu('header','Navigation dans le header');
}

function shitty_stylesheets() {
    //wp_enqueue_style('shittytheme-css',get_stylesheet_uri());
    wp_enqueue_style('bootstrap_css','https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css');
    wp_enqueue_script('bootstrap_js','https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js');
}

add_action('after_setup_theme', 'shitty_theme_startup');
add_action('wp_enqueue_scripts', 'shitty_stylesheets');

add_filter('nav_menu_css_class', function ($classes): array {
    $classes[] = 'nav-item';
    return $classes;
});

add_filter('nav_menu_link_attributes', function ($attr) {
    $attr['class'] = 'nav-link';
    return $attr;
});

/*
 * Futur plugin - metakeys management
 * Les 2 features ci-dessous permettent d'ajouter :
 * 1/ un nouveau type de post 'événement' et
 * 2/ une gestion de taxonomie qui peut être DEDIEE (cf. l'$object_type référencé sur le register_taxonomy
 * Voilà qui représente donc notre base pour créer un plugin entier dédier à la gestion de vente de produit (cc Woocommerce)
 *
 * -> optimiser les champs présents, voir si on peut directement obliger l'entrée d'un prix et non pas le mettre en "custom fields"
 *
 */

// add custom taxonomie
add_action('init', 'shittybnb_register_type_taxonomy');
function shittybnb_register_type_taxonomy()
{
    $labels_type = [
        'name' => 'Types de biens',
        'singular_name' => 'Type de bien',
        'search_items' => 'Rechercher un type de bien',
        'all_items' => 'Tous les types de biens'
    ];

    $args_type = [
        'labels' => $labels_type,
        'public' => true,
        'hierarchical' => true,
        'show_in_rest' => true,
        'show_admin_column' => true
    ];

    register_taxonomy('type', ['product'], $args_type);

    $labels_modalite = [
        'name' => 'Modalités de financement',
        'singular_name' => 'Modalité de financement',
        'search_items' => 'Rechercher les types de modalités',
        'all_items' => 'Toutes les modalités de financement'
    ];

    $args_modalite = [
        'labels' => $labels_modalite,
        'public' => true,
        'hierarchical' => true,
        'show_in_rest' => true,
        'show_admin_column' => true
    ];

    register_taxonomy('modalite', ['product'], $args_modalite);

    $labels_localisation = [
        'name' => 'Localisations des biens',
        'singular_name' => 'Localisation du bien',
        'search_items' => 'Rechercher les localisations',
        'all_items' => 'Toutes les localisations'
    ];

    $args_localisation = [
        'labels' => $labels_localisation,
        'public' => true,
        'hierarchical' => true,
        'show_in_rest' => true,
        'show_admin_column' => true
    ];

    register_taxonomy('localisation', ['product'], $args_localisation);
}

// add custom post type (cpt) -> use this to manage products
add_action('init', 'shittybnb_register_event_cpt');
function shittybnb_register_event_cpt()
{
    $labels = [
        'name' => 'Produits',
        'singular_name' => 'Produit',
        'search_items' => 'Rechercher un produit',
        'all_items' => 'Tous les produits'
    ];

    $args = [
        'labels' => $labels,
        'public' => true,
        'show_in_rest' => true,
        'menu_icon' => 'dashicons-store',
        'supports' => ['title', 'excerpt', 'thumbnail', 'custom-fields'],
        'has_archive' => true,
        'taxonomies' => ['type','modalite']
    ];

    register_post_type('product',$args);
}

// add the custom box field for the product infos
add_action('add_meta_boxes','wphetic_add_meta_boxes');
function wphetic_add_meta_boxes() {
    add_meta_box(
        'product-infos',
        'Informations Produit',
        'wphetic_metabox_render',
        'product'
    );
}

add_action('save_post','wphetic_save_metabox');
function wphetic_save_metabox($post_id)
{

    // update price meta
    if ( !empty($_POST['hcf_price']) ) {
        update_post_meta($post_id,'product-price',$_POST['hcf_price']);
    } else {
        delete_post_meta($post_id,'product-price');
    }

    // update availability meta
    if ( !empty($_POST['hcf_date']) ) {
        update_post_meta($post_id,'product-availability',$_POST['hcf_date']);
    } else {
        delete_post_meta($post_id,'product-availability');
    }

    // update availability meta
    if ( !empty($_POST['hcf_area']) ) {
        update_post_meta($post_id,'product-area',$_POST['hcf_area']);
    } else {
        delete_post_meta($post_id,'product-area');
    }

    // update availability meta
    if ( !empty($_POST['hcf_area']) ) {
        update_post_meta($post_id,'product-area',$_POST['hcf_area']);
    } else {
        delete_post_meta($post_id,'product-area');
    }

    // update capicity meta
    if ( !empty($_POST['hcf_capicity']) ) {
        update_post_meta($post_id,'product-capicity',$_POST['hcf_capicity']);
    } else {
        delete_post_meta($post_id,'product-capicity');
    }

    // update bedrooms meta
    if ( !empty($_POST['hcf_bedrooms']) ) {
        update_post_meta($post_id,'product-bedrooms',$_POST['hcf_bedrooms']);
    } else {
        delete_post_meta($post_id,'product-bedrooms');
    }

    // update rooms meta
    if ( !empty($_POST['hcf_rooms']) ) {
        update_post_meta($post_id,'product-rooms',$_POST['hcf_rooms']);
    } else {
        delete_post_meta($post_id,'product-rooms');
    }
}


function wphetic_metabox_render()
{
    $price = get_post_meta($_GET['post'], 'product-price',true);
    $availability = get_post_meta($_GET['post'],'product-availability',true);
    $area = get_post_meta($_GET['post'],'product-area',true);
    $capacity = get_post_meta($_GET['post'], 'product-capacity',true);
    $bedrooms = get_post_meta($_GET['post'],'product-bedrooms',true);
    $rooms = get_post_meta($_GET['post'],'product-rooms',true);
    ?>
    <div class="hcf_box">
        <style scoped>
            .hcf_box{
                display: grid;
                grid-template-columns: max-content 1fr;
                grid-row-gap: 10px;
                grid-column-gap: 20px;
            }
            .hcf_field{
                display: contents;
            }
        </style>

        <p class="meta-options hcf_field">
            <label for="hcf_price">Price</label>
            <input id="hcf_price" type="number" name="hcf_price" value="<?= $price; ?>">
        </p>
        <p class="meta-options hcf_field">
            <label for="hcf_date">Available from</label>
            <input id="hcf_date" type="date" name="hcf_date" value="<?= $availability; ?>">
        </p>
        <p class="meta-options hcf_field">
            <label for="hcf_area">Surface Area</label>
            <input id="hcf_area" type="text" name="hcf_area" value="<?= $area; ?>">
        </p>
        <p class="meta-options hcf_field">
            <label for="hcf_capacity">Price</label>
            <input id="hcf_capacity" type="number" name="hcf_capacity" value="<?= $capacity; ?>">
        </p>
        <p class="meta-options hcf_field">
            <label for="hcf_bedrooms">Price</label>
            <input id="hcf_bedrooms" type="number" name="hcf_bedrooms" value="<?= $bedrooms; ?>">
        </p>
        <p class="meta-options hcf_field">
            <label for="hcf_rooms">Price</label>
            <input id="hcf_rooms" type="number" name="hcf_rooms" value="<?= $rooms; ?>">
        </p>
    </div>
    <?
}
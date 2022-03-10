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
    $labels = [
        'name' => 'Types de biens',
        'singular_name' => 'Type de bien',
        'search_items' => 'Rechercher un type de bien',
        'all_items' => 'Tous les types de biens'
    ];

    $args = [
        'labels' => $labels,
        'public' => true,
        'hierarchical' => true,
        'show_in_rest' => true,
        'show_admin_column' => true
    ];

    register_taxonomy('type', ['product'], $args);
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
        'taxonomies' => ['type']
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

function wphetic_metabox_render() {
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
            <input id="hcf_price" type="number" name="hcf_price">
        </p>
        <p class="meta-options hcf_field">
            <label for="hcf_date">Available from</label>
            <input id="hcf_date" type="date" name="hcf_date">
        </p>
        <p class="meta-options hcf_field">
            <label for="hcf_area">Surface Area</label>
            <input id="hcf_area" type="text" name="hcf_area">
        </p>
    </div>
    <?
}
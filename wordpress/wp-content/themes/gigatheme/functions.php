<?php
function gigabnb_theme_startup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');

    add_theme_support('menus');
    register_nav_menu('header','Navigation dans le header');
}

function gigabnb_stylesheets() {
    wp_enqueue_style('gigabnb-css-vente',get_template_directory_uri() .'/assets/css/vente.css');
    wp_enqueue_style('gigabnb-css-homepage',get_template_directory_uri() .'/assets/css/homepage.css');
    wp_enqueue_style('gigabnb-css-header',get_template_directory_uri() .'/assets/css/header.css');
    wp_enqueue_style('gigabnb-css-footer',get_template_directory_uri() .'/assets/css/footer.css');
    wp_enqueue_style('gigabnb-css-single-post',get_template_directory_uri() .'/assets/css/single-post.css');
    wp_enqueue_style('gigabnb-css-compte-settings',get_template_directory_uri() .'/assets/css/compte.css');
    wp_enqueue_style('gigabnb-css-loginsignup',get_template_directory_uri() .'/assets/css/connexion-inscription.css');
    wp_enqueue_style('gigabnb-css',get_stylesheet_uri());
    wp_enqueue_style('bootstrap_css','https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css');
    wp_enqueue_script('bootstrap_js','https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js');
}

add_action('after_setup_theme', 'gigabnb_theme_startup');
add_action('wp_enqueue_scripts', 'gigabnb_stylesheets');

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
add_action('init', 'gigabnb_register_type_taxonomy');
function gigabnb_register_type_taxonomy()
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
        'hierarchical' => false,
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

/*
 * Modifier les rôles de l'admin quand on active le thème
 * Raison : suite à l'ajout de 'capabilities', les admins n'ont plus accès aux produits !
 * il faut donc leur rajouter ce droit custom (manage_products) à l'activation du thème
 */
add_action('after_switch_theme', function () {
    $admin = get_role('administrator');
    $admin->add_cap('manage_products');
});

/*
 * add custom post type (cpt) -> use this to manage products
 * you need to pass $labels & $args
 * Please note that you don't have to add $labels to your $args as they will be added by the __construct
*/
require_once 'classes/Add_CPT.php';
$product_cpt = new Add_CPT('product',
    [
        'name' => 'Produits',
        'singular_name' => 'Produit',
        'search_items' => 'Rechercher un produit',
        'all_items' => 'Tous les produits'
    ], [
        'public' => true,
        'show_in_rest' => true,
        'menu_icon' => 'dashicons-store',
        'supports' => ['title', 'excerpt', 'thumbnail', 'comments'],
        'has_archive' => true,
        'taxonomies' => ['type','modalite','localisation'],
        'capabilities' => array(
            'edit_post' => 'manage_products',
            'read_post' => 'manage_products',
            'delete_post' => 'manage_products'
        )
]);

/*
 * Use Custom_metabox Class to create our custom metas for the products
 */
require_once 'classes/Custom_metabox.php';
$price = new Custom_metabox(
    array(
        'product-price',
        'product-area',
        'product-bedrooms',
        'product-rooms'
    )
);


/*
 * Ajout d'un rôle "Moderator" quand on active le thème
 */
require_once 'classes/Custom_role.php';
$moderator = new Custom_role('moderator', 'Modérateur / Modératrice', [
        'read' => true,
        'edit_posts' => true,
        'manage_products' => true,
        'moderate_comments' => true,
        'delete_posts' => true
    ]
);

/*
 * Prevent custom role to access admin pages that thy won't need
 */
add_action('admin_menu', 'moderator_remove_menu_pages');
function moderator_remove_menu_pages() {
    $user = wp_get_current_user();
    if ( in_array('moderator',$user->roles) ) {
        remove_menu_page('edit.php');
        remove_menu_page('tools.php');
    }
}

/*
 * ADJUST DISPLAY FOR USERS
*/
if ( in_array( 'subscriber', (array) wp_get_current_user()->roles ) ) {
    add_filter( 'show_admin_bar', '__return_false' );
}


// add_action('pre_get_posts', 'giga_homepage_query');
// function giga_homepage_query($query)
// {
//     if ($query->is_home() && $query->is_main_query()) {
//         $query = new WP_Query(array(
//             'post_type' => 'product',
//             'post_per_page' => 3
//         ));
//     }
// }


function gigaPagination($query)
{

    echo '<nav>';
    echo '<ul class="pagination">';
    $pages = paginate_links(['type' => 'array', "total" => $query->max_num_pages, "current" => max(1, get_query_var('paged'))]);
    foreach ($pages as $page) {
        echo '<li class="page">';
        echo str_replace('page-numbers', 'page-link', $page);
        echo '</li>';
    };
    echo '</ul>';
    echo '</nav>';
}

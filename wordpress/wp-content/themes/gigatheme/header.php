<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php wp_head() ?>
</head>
<body>
<header>
    <a onmouseenter="playshootingstars()" class="header_side_button_container" href="#">
        <img class="header_side_buttons" src="<?= get_template_directory_uri() ?>/assets/images/Header/vendre_un_bien.png">
    </a>
    <a href="/">
        <img class="header_central_button" src="<?= get_template_directory_uri() ?>/assets/images/Header/header_Albnb.png">
    </a>
    <a onmouseenter="playshootingstars()" class="header_side_button_container" href="#">
        <img class="header_side_buttons" src="<?= get_template_directory_uri() ?>/assets/images/Header/inscription_connexion.png">
    </a>
</header>

                <?php /*wp_nav_menu([
                    'theme_location' => 'header',
                    'container' => false,
                    'menu_class' => "navbar-nav me-auto mb-2 mb-lg-0"
                ]); */?><!--

                --><?php /*get_search_form() */?>

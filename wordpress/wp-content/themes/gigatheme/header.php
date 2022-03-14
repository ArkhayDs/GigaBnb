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
    <a onmouseenter="playshootingstars()" class="header_side_button_container" href="/vente/">
        <img class="header_side_buttons" src="<?= get_template_directory_uri() ?>/assets/images/Header/vendre_un_bien.png">
    </a>
    <a href="/">
        <img class="header_central_button" src="<?= get_template_directory_uri() ?>/assets/images/Header/header_Albnb.png">
    </a>
    <?php if (!is_user_logged_in()) :?>
        <a onmouseenter="playshootingstars()" class="header_side_button_container" href="/connexion/">
            <img class="header_side_buttons" src="<?= get_template_directory_uri() ?>/assets/images/Header/inscription_connexion.png">
        </a>
    <?php else :?>
        <a onmouseenter="playshootingstars()" class="header_side_button_container" href="/compte/">
            <img class="header_side_buttons" src="<?= get_template_directory_uri() ?>/assets/images/Header/compte-button.png">
        </a>
    <?php endif; ?>
</header>

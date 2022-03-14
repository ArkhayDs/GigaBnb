<?php

/**
 * Template Name: Signup Form - Giga Theme
 * Description: Giga Theme signup form.
 */
if( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) &&  $_POST['action'] == "new_user" ) { // has the form been submitted ?

    $user_name = $_POST['user_name'];
    $user_email = $_POST['user_email'];
    $user_pwd = $_POST['user_pwd'];

    $newuser = wp_create_user( $user_name, $user_pwd, $user_email);
    wp_redirect( "/" );

    get_header();

} else {

get_header();

?>

<!-- MAIN -->
<main>
    <div class="connexion">
        <form action="" method="POST">
            <h1>Inscription</h1>

            <span>
                <label>Pseudo</label>
                <input type="text" placeholder="Entrez le nom d'utilisateur" name="user_name" required>
            </span>
            <span>
                <label>eM@il</label>
                <input type="email" placeholder="Entrez votre email" name="user_email" required>
            </span>
            <span>
                <label>MDP</label>
                <input type="password" placeholder="Entrez le mot de passe" name="user_pwd" required>
            </span>
            <span>
                <input class="checkbox" type="checkbox"  name="contidion" required>
                <label class="checkbox-label">j’accepte les <a href="https://www.youtube.com/watch?v=X_8Nh5XfRw0">conditions d’utilisation</a></label>
            </span>

            <input type="submit" id='submit' value='' >
            <p class="entrez">↑ Entrez ↑</p>
            <p>J'ai déjà un compte : <a href="/connexion/">Connexion</a></p>

            <input type="hidden" name="action" value="new_user" />
        </form>
    </div>
</main>

<?php } get_footer()?>

<?php

/**
 * Template Name: Login Form - Giga Theme
 * Description: Giga Theme login form.
 */

get_header()?>

    <main>
        <div class="connexion">
            <form action="<?= home_url('wp-login.php'); ?>" method="post">
                <h1>Connexion</h1>

                <span>
                    <label>Pseudo</label>
                    <input type="text" placeholder="Entrez le nom d'utilisateur" name="log" required>
                </span>
                <span>
                    <label>MDP</label>
                    <input type="password" placeholder="Entrez le mot de passe" name="pwd" required>
                </span>
                <span>
                    <input type="checkbox" class="form-check-input" id="rememberme" name="rememberme">
                    <label class="form-check-label" for="rememberme">Ne m'oublie pas. :(</label>
                </span>

                <a class="mdp-oublie" href="https://www.youtube.com/watch?v=OZw9L-PkRKs&ab_channel=HMomentPalli">mot de passe oublié</a>

                <input type="submit" id='submit' value='' name="wp-submit">
                <p class="entrez">↑ Entrez ↑</p>
                <p>Je n’ai pas de compte : <a href="./inscription.html">Inscription</a></p>
                <input type="hidden" name="redirect_to" value="/" />
            </form>
        </div>
    </main>

<?php get_footer()?>
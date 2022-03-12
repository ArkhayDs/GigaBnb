<?php get_header()?>    

<!-- MAIN -->
<main>
    <div class="connexion"> 
        <form action="verification.php" method="POST">
            <h1>Inscription</h1>
            
            <span>
                <label>Pseudo</label>
                <input type="text" placeholder="Entrez le nom d'utilisateur" name="username" required>
            </span>
            <span>
                <label>eM@il</label>
                <input type="email" placeholder="Entrez votre email" name="email" required>
            </span>
            <span>
                <label>MDP</label>
                <input type="password" placeholder="Entrez le mot de passe" name="password" required>
            </span>
            <span>
                <input class="checkbox" type="checkbox"  name="contidion" required>
                <label class="checkbox-label">j’accepte les <a href="https://www.youtube.com/watch?v=X_8Nh5XfRw0">conditions d’utilisation</a></label>
            </span>
    
            <input type="submit" id='submit' value='' >
            <p class="entrez">↑ Entrez ↑</p>
            <p>J'ai déjà un compte : <a href="./connexion.html">Connexion</a></p>
        </form>
    </div>
</main>
<?php get_footer()?>

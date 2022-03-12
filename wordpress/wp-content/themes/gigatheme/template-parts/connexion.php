<?php get_header()?>    

<!-- MAIN -->
<main>
    <div class="connexion"> 
        <form action="verification.php" method="POST">
            <h1>Connexion</h1>
            
            <span>
                <label>Pseudo</label>
                <input type="text" placeholder="Entrez le nom d'utilisateur" name="username" required>
            </span>
            <span>
                <label>MDP</label>
                <input type="password" placeholder="Entrez le mot de passe" name="password" required>
            </span>
            <a class="mdp-oublie" href="https://www.youtube.com/watch?v=OZw9L-PkRKs&ab_channel=HMomentPalli">mot de passe oublié</a>
    
            <input type="submit" id='submit' value='' >
            <p class="entrez">↑ Entrez ↑</p>
            <p>Je n’ai pas de compte : <a href="./inscription.html">Inscription</a></p>
        </form>
    </div>
</main>
<?php get_footer()?>

<main>
    <div class="vente">
        <form action="#" method="POST">
            <h1>Proposer un bien</h1>

            <span>
                <label>Nom du bien :</label>
                <input type="text" placeholder="Entrez le nom du bien" name="username" required>
            </span>
            <span>
                <label>Localisation :</label>
                <input type="text" placeholder="Entrez la localisation du bien" name="text" required>
            </span>
            <span>
                <label>Prix (€) :</label>
                <input type="number" placeholder="Entrez le prix de vitre bien" name="password" required>
            </span>
            <div>
                <label>Description :</label>
                <textarea cols="50" rows="10" placeholder="Décrivez votre bien" name="description" required></textarea>
            </div>
            <div class="checkboxes_container">
                <div class="type">
                    <h3>type de logement</h3>
                    <span>
                        <input class="checkbox" type="radio"  name="contidion" required>
                        <label class="checkbox-label">Maison</a></label>
                    </span>
                    <span>
                        <input class="checkbox" type="radio"  name="contidion" required>
                        <label class="checkbox-label">Appartement</label>
                    </span>
                    <span>
                        <input class="checkbox" type="radio"  name="contidion" required>
                        <label class="checkbox-label">Manoir</label>
                    </span>
                    <span>
                        <input class="checkbox" type="radio"  name="contidion" required>
                        <label class="checkbox-label">Chateau</label>
                    </span>
                    <span>
                        <input class="checkbox" type="radio"  name="contidion" required>
                        <label class="checkbox-label">Autre</label>
                    </span>
                </div>
                <div class="type">
                    <h3>type de logement</h3>
                    <span>
                        <input class="checkbox" type="radio"  name="achat" required>
                        <label class="checkbox-label">Achat</label>
                    </span>
                    <span>
                        <input class="checkbox" type="radio"  name="achat" required>
                        <label class="checkbox-label">Viager</a></label>
                    </span>
                </div>
            </div>
            <div class="pic_section">
                <h2>↓ Postez vos photos ici ↓</h2>
                <button>
                    <img src="./assets/images/Page_vendre_bien/photo_camera.png" alt="">
                </button>
                <div class="preview">
                    <!-- Choisir a integrer ou pas -->
                    <span><p>photo_de_ma_magnifique_maison(6).jpg</p><button><img src="./assets/images/Page_vendre_bien/x.svg" alt=""></button></span>
                </div>
            </div>

            <button type="submit" id='submit' value='' >
                <img src="./assets/images/Page_vendre_bien/bouton_vente.png" alt="">
            </button>
        </form>
    </div>
</main>
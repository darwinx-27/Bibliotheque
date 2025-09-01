<!-- /****************************************************************
* Projet
: Gestion de la biliothèque
* Code PHP : afficher.php
****************************************************************
* Auteur 1 : KAMGA MUKAM CHARLES CYRILLE
<charles.kamga@facsciences-uy1.cm>
* Auteur 2 : KOULAI FANTIO NATHANAEL
<nathanael.koulai@facsciences-uy1.cm>
* Auteur 3 : Votre nom ici
<votre@adresse.email>
* ...
****************************************************************
* Date de création
: 04-07-2025 (04 Juillet 2025)
* Dernière modification : 05-07-2025 (05 Juillet 2025)
****************************************************************
* Description
Afficher un formulaire HTML qui permet à l’utilisateur de rechercher un ou plusieurs ouvrages

Critères : isbn, auteur, editeur, annee

L’envoi se fait par GET vers recherche.php

Inclure les liens de navigation (ajouter.php, retirer.php)
****************************************************************
* Historique des modifications
* 04-07-2025 : Création du fichier afficher.php pour la page
05-07-2025
*ajout du style
***************************************************************/ -->

<?php include 'includes/header.php'; ?>

<div class="card">
    <h1><i class="fas fa-search"></i> Recherche d'ouvrages</h1>
    <p class="lead">Utilisez les champs ci-dessous pour affiner votre recherche</p>
    
    <form action="recherche.php" method="get" class="search-form">
        <div class="form-row">
            <div class="form-group">
                <label for="isbn"><i class="fas fa-barcode"></i> ISBN</label>
                <input type="text" id="isbn" name="isbn" class="form-control" placeholder="Ex: 9780000000001">
            </div>
            
            <div class="form-group">
                <label for="auteur"><i class="fas fa-user-edit"></i> Auteur</label>
                <input type="text" id="auteur" name="auteur" class="form-control" placeholder="Nom de l'auteur">
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group">
                <label for="editeur"><i class="fas fa-building"></i> Éditeur</label>
                <input type="text" id="editeur" name="editeur" class="form-control" placeholder="Nom de l'éditeur">
            </div>
            
            <div class="form-group">
                <label for="annee"><i class="far fa-calendar-alt"></i> Année de parution</label>
                <input type="number" id="annee" name="annee" class="form-control" placeholder="Ex: 2023" min="1000" max="2100">
            </div>
        </div>
        
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-search"></i> Rechercher
            </button>
            <button type="reset" class="btn btn-secondary">
                <i class="fas fa-eraser"></i> Réinitialiser
            </button>
        </div>
    </form>
</div>

<style>
.search-form {
    margin-top: 2rem;
}

.form-row {
    display: flex;
    gap: 1.5rem;
    margin-bottom: 1.5rem;
}

.form-row .form-group {
    flex: 1;
}

.form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 1rem;
    margin-top: 2rem;
    padding-top: 1rem;
    border-top: 1px solid #eee;
}

.btn-secondary {
    background-color: #95a5a6;
    color: white;
}

.btn-secondary:hover {
    background-color: #7f8c8d;
}

@media (max-width: 768px) {
    .form-row {
        flex-direction: column;
        gap: 1rem;
    }
    
    .form-actions {
        flex-direction: column;
    }
    
    .btn {
        width: 100%;
    }
}
</style>

<?php include 'includes/footer.php'; ?>
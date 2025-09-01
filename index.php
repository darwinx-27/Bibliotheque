<!-- /****************************************************************
* Projet
: Gestion de la biliothèque
* Code PHP : index.php
****************************************************************
* Auteur 1 : KAMGA MUKAM CHARLES CYRILLE
<charles.kamga@facsciences-uy1.cm>
* Auteur 2 : MABA NGUEWO KENDRA SORELLE
<kendra.maba@facsciences-uy1.cm>
* Auteur 3 : 
<votre@adresse.email>
* ...
****************************************************************
* Date de création
: 04-07-2025 (04 Juillet 2025)
* Dernière modification : 04-07-2025 (04 Juillet 2025)
****************************************************************
* Description
* Le script index.php represente la page d'accueil de la
* bibliothèque. Il contient un menu de navigation vers les
* différentes pages du site. Il permet à l'utilisateur de
* naviguer facilement entre les différentes fonctionnalités
* du site, telles que la recherche de livres, l'affichage de
* tous les livres, et l'ajout de nouveaux livres.
****************************************************************
* Historique des modifications
* 04-07-2025 : Création du fichier index.php pour la page
*
***************************************************************/ -->

<?php include 'includes/header.php'; ?>

<div class="card text-center">
    <h1><i class="fas fa-book-open"></i> Bienvenue sur notre Bibliothèque</h1>
    <p class="lead">Gérez facilement votre collection de livres</p>
    
    <div class="quick-actions">
        <a href="ajouter.php" class="btn btn-primary">
            <i class="fas fa-plus-circle"></i> Ajouter un livre
        </a>
        <a href="afficher.php" class="btn btn-primary">
            <i class="fas fa-search"></i> Rechercher un livre
        </a>
    </div>
    
    <div class="stats mt-4">
        <?php
        // Connexion à la base de données
        $conn = mysqli_connect("localhost", "root", "", "ict108");
        if ($conn) {
            // Compter le nombre total de livres
            $result = mysqli_query($conn, "SELECT COUNT(*) as total FROM ouvrage");
            $row = mysqli_fetch_assoc($result);
            $total_books = $row['total'];
            
            // Compter le nombre d'auteurs uniques
            $result = mysqli_query($conn, "SELECT COUNT(DISTINCT auteur) as auteurs FROM ouvrage");
            $row = mysqli_fetch_assoc($result);
            $total_authors = $row['auteurs'];
            
            echo "<div class='stats-grid'>";
            echo "<div class='stat-item'><i class='fas fa-book'></i> $total_books Livres</div>";
            echo "<div class='stat-item'><i class='fas fa-user-edit'></i> $total_authors Auteurs</div>";
            echo "</div>";
            
            mysqli_close($conn);
        }
        ?>
    </div>
</div>

<style>
.quick-actions {
    margin: 2rem 0;
    display: flex;
    gap: 1rem;
    justify-content: center;
    flex-wrap: wrap;
}

.stats {
    margin-top: 2rem;
    padding: 1.5rem;
    background-color: rgba(52, 152, 219, 0.1);
    border-radius: 8px;
}

.stats-grid {
    display: flex;
    justify-content: center;
    gap: 2rem;
    margin-top: 1rem;
}

.stat-item {
    background: white;
    padding: 1rem 2rem;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    font-size: 1.2rem;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.stat-item i {
    color: #3498db;
    font-size: 1.5rem;
}

.text-center {
    text-align: center;
}

.lead {
    font-size: 1.25rem;
    margin-bottom: 1.5rem;
    color: #555;
}

.mt-4 {
    margin-top: 2rem;
}
</style>

<?php include 'includes/footer.php'; ?>
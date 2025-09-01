<!-- /****************************************************************
* Projet
: Gestion de la biliothèque
* Code PHP : suppression.php
****************************************************************
* Auteur 1 : KENGNE TSHIENEGHOM THERESE VIANNEY
<therese.kengne@facsciences-uy1.cm>
* Auteur 2 : KENGNE BEKAM FIDELE JORDAN
<fidele.kengne@facsciences-uy1.cm>
* Auteur 3 : KITIO EMMANUEL  
<emmanuel.kitio@facsciences-uy1.cm>
* ...
****************************************************************
* Date de création
: 04-07-2025 (04 Juillet 2025)
* Dernière modification : 05-07-2025 (05 Juillet 2025)
****************************************************************
* Description
* ce script sert à supprimer l'un champ selon son ISBN selectionné;

****************************************************************
* Historique des modifications
* 05-07-2025 : ajout du commentaire et du style
***************************************************************/ -->

<?php
// Inclure le header pour avoir la navigation
include 'includes/header.php';

if (isset($_GET['isbn'])) {
    $c = mysqli_connect("localhost", "root", "", "ict108");
    $isbn = $_GET['isbn'];
    
    if ($c != FALSE) {
        // Utiliser des requêtes préparées pour la sécurité
        $select_sql = "SELECT isbn, titre, auteur, editeur, annee, couverture FROM ouvrage WHERE isbn = ?";
        $stmt = mysqli_prepare($c, $select_sql);
        mysqli_stmt_bind_param($stmt, "s", $isbn);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
        if (mysqli_num_rows($result) > 0) {
            $ouvrage = mysqli_fetch_assoc($result);
            
            echo "<div class='card'>";
            echo "<h1><i class='fas fa-trash-alt'></i> Suppression d'ouvrage</h1>";
            
            echo "<div class='alert alert-success'>";
            echo "<i class='fas fa-check-circle'></i>";
            echo "<strong>Ouvrage supprimé avec succès !</strong>";
            echo "</div>";
            
            echo "<div class='deleted-book-info'>";
            echo "<h3><i class='fas fa-book'></i> Ouvrage supprimé :</h3>";
            
            echo "<div class='book-details'>";
            echo "<div class='book-cover-large'>";
            echo "<img src='uploads/" . htmlspecialchars($ouvrage['couverture']) . "' alt='Couverture' class='deleted-book-cover'>";
            echo "</div>";
            
            echo "<div class='book-info-details'>";
            echo "<div class='info-item'>";
            echo "<label><i class='fas fa-barcode'></i> ISBN :</label>";
            echo "<span><code>" . htmlspecialchars($ouvrage['isbn']) . "</code></span>";
            echo "</div>";
            
            echo "<div class='info-item'>";
            echo "<label><i class='fas fa-book'></i> Titre :</label>";
            echo "<span><strong>" . htmlspecialchars($ouvrage['titre']) . "</strong></span>";
            echo "</div>";
            
            echo "<div class='info-item'>";
            echo "<label><i class='fas fa-user-edit'></i> Auteur :</label>";
            echo "<span>" . htmlspecialchars($ouvrage['auteur']) . "</span>";
            echo "</div>";
            
            echo "<div class='info-item'>";
            echo "<label><i class='fas fa-building'></i> Éditeur :</label>";
            echo "<span>" . htmlspecialchars($ouvrage['editeur']) . "</span>";
            echo "</div>";
            
            echo "<div class='info-item'>";
            echo "<label><i class='far fa-calendar-alt'></i> Année :</label>";
            echo "<span><span class='badge'>" . htmlspecialchars($ouvrage['annee']) . "</span></span>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
            
            // Supprimer l'ouvrage après l'affichage
            $delete_sql = "DELETE FROM ouvrage WHERE isbn = ?";
            $delete_stmt = mysqli_prepare($c, $delete_sql);
            mysqli_stmt_bind_param($delete_stmt, "s", $isbn);
            mysqli_stmt_execute($delete_stmt);
            
            echo "<div class='action-buttons'>";
            echo "<a href='afficher.php' class='btn btn-primary'>";
            echo "<i class='fas fa-search'></i> Nouvelle recherche";
            echo "</a>";
            echo "<a href='ajouter.php' class='btn btn-success'>";
            echo "<i class='fas fa-plus'></i> Ajouter un ouvrage";
            echo "</a>";
            echo "<a href='index.php' class='btn btn-secondary'>";
            echo "<i class='fas fa-home'></i> Retour à l'accueil";
            echo "</a>";
            echo "</div>";
            
            echo "</div>";
            
        } else {
            echo "<div class='card'>";
            echo "<h1><i class='fas fa-exclamation-triangle'></i> Erreur</h1>";
            
            echo "<div class='alert alert-danger'>";
            echo "<i class='fas fa-times-circle'></i>";
            echo "<strong>Ouvrage non trouvé</strong> avec l'ISBN : <code>" . htmlspecialchars($isbn) . "</code>";
            echo "</div>";
            
            echo "<div class='error-actions'>";
            echo "<a href='retirer.php' class='btn btn-primary'>";
            echo "<i class='fas fa-arrow-left'></i> Retour à la suppression";
            echo "</a>";
            echo "<a href='afficher.php' class='btn btn-secondary'>";
            echo "<i class='fas fa-search'></i> Rechercher un ouvrage";
            echo "</a>";
            echo "</div>";
            
            echo "</div>";
        }
        
        mysqli_stmt_close($stmt);
        if (isset($delete_stmt)) {
            mysqli_stmt_close($delete_stmt);
        }
    } else {
        echo "<div class='card'>";
        echo "<h1><i class='fas fa-exclamation-triangle'></i> Erreur de connexion</h1>";
        
        echo "<div class='alert alert-danger'>";
        echo "<i class='fas fa-database'></i>";
        echo "<strong>Erreur de connexion à la base de données</strong>";
        echo "</div>";
        
        echo "<div class='error-actions'>";
        echo "<a href='index.php' class='btn btn-primary'>";
        echo "<i class='fas fa-home'></i> Retour à l'accueil";
        echo "</a>";
        echo "</div>";
        
        echo "</div>";
    }
    
    mysqli_close($c);
} else {
    echo "<div class='card'>";
    echo "<h1><i class='fas fa-exclamation-triangle'></i> Erreur</h1>";
    
    echo "<div class='alert alert-danger'>";
    echo "<i class='fas fa-times-circle'></i>";
    echo "<strong>Aucun ISBN fourni</strong> pour la suppression";
    echo "</div>";
    
    echo "<div class='error-actions'>";
    echo "<a href='retirer.php' class='btn btn-primary'>";
    echo "<i class='fas fa-arrow-left'></i> Retour à la suppression";
    echo "</a>";
    echo "<a href='index.php' class='btn btn-secondary'>";
    echo "<i class='fas fa-home'></i> Retour à l'accueil";
    echo "</a>";
    echo "</div>";
    
    echo "</div>";
}
?>

<style>
/* Styles spécifiques pour la page de suppression */
.deleted-book-info {
    margin: var(--space-lg) 0;
}

.book-details {
    display: flex;
    gap: var(--space-xl);
    align-items: flex-start;
    padding: var(--space-lg);
    background: var(--neutral-50);
    border-radius: var(--radius-lg);
    border: 2px solid var(--neutral-200);
}

.book-cover-large {
    flex-shrink: 0;
}

.deleted-book-cover {
    width: 150px;
    height: 200px;
    object-fit: cover;
    border-radius: var(--radius-md);
    box-shadow: var(--shadow-lg);
    border: 3px solid var(--neutral-200);
}

.book-info-details {
    flex: 1;
}

.info-item {
    display: flex;
    align-items: center;
    margin-bottom: var(--space-md);
    padding: var(--space-sm);
    background: white;
    border-radius: var(--radius-md);
    box-shadow: var(--shadow-sm);
    transition: var(--transition-normal);
}

.info-item:hover {
    transform: translateX(5px);
    box-shadow: var(--shadow-md);
}

.info-item label {
    display: flex;
    align-items: center;
    gap: var(--space-sm);
    min-width: 120px;
    font-weight: 600;
    color: var(--primary-color);
    margin: 0;
}

.info-item label i {
    width: 20px;
    text-align: center;
}

.info-item span {
    color: var(--neutral-700);
    font-weight: 500;
}

.action-buttons {
    display: flex;
    gap: var(--space-md);
    justify-content: center;
    margin-top: var(--space-xl);
    padding-top: var(--space-lg);
    border-top: 1px solid var(--neutral-200);
}

.error-actions {
    display: flex;
    gap: var(--space-md);
    justify-content: center;
    margin-top: var(--space-lg);
}

/* Badge styling */
.badge {
    display: inline-block;
    padding: 0.25rem 0.5rem;
    background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
    color: white;
    border-radius: var(--radius-sm);
    font-size: 0.875rem;
    font-weight: 600;
}

/* Code styling */
code {
    background: var(--neutral-100);
    padding: 0.25rem 0.5rem;
    border-radius: var(--radius-sm);
    font-family: 'Courier New', monospace;
    font-size: 0.875rem;
    color: var(--primary-color);
    border: 1px solid var(--neutral-200);
}

/* Responsive design */
@media (max-width: 768px) {
    .book-details {
        flex-direction: column;
        text-align: center;
    }
    
    .deleted-book-cover {
        width: 120px;
        height: 160px;
        margin: 0 auto;
    }
    
    .info-item {
        flex-direction: column;
        align-items: flex-start;
        text-align: left;
    }
    
    .info-item label {
        min-width: auto;
        margin-bottom: var(--space-xs);
    }
    
    .action-buttons,
    .error-actions {
        flex-direction: column;
        align-items: center;
    }
    
    .action-buttons .btn,
    .error-actions .btn {
        width: 100%;
        max-width: 300px;
    }
}

/* Animation pour l'affichage */
@keyframes slideInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.deleted-book-info {
    animation: slideInUp 0.6s ease-out;
}

/* Effet de suppression */
.deleted-book-cover {
    filter: grayscale(0.3);
    opacity: 0.8;
    transition: var(--transition-normal);
}

.deleted-book-cover:hover {
    filter: grayscale(0);
    opacity: 1;
    transform: scale(1.05);
}
</style>

<?php include 'includes/footer.php'; ?>